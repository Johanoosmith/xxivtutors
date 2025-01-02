<?php
namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use File;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\View;
use Session;
use App\Models\Page;
use App\Models\Pagetemplate;
use App\Models\Pagemeta;

class PageController extends Controller
{

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
		$this->middleware('admin');
    }

    public function index(Request $request){   
	  $input = $request->all();   
	  $getRecords     = new Page();
	  $search         = (object) null;
	  $arr['search']  = $search;
	  $showrecord     = trans('admin.ADMIN_PAGE_LIMIT_NO'); 
	  $search_text    = '';
	  if (isset($input['search_text']) && $input['search_text'] != '') {
		  $search_text            = $input['search_text'];
		  $getRecords             = $getRecords->where('title', 'LIKE', "%$search_text%");
		  $search->search_text    = $search_text;
	  }

	  if (isset($input['template']) && $input['template'] != '') {
		$template          =   $input['template'];
		$getRecords      =   $getRecords->where('template', '=', $template);
		$search->template  =   $template;
	  }

	  if (isset($input['status']) && $input['status'] != '') {
		  $status          =   $input['status'];
		  $getRecords      =   $getRecords->where('status', '=', $status);
		  $search->status  =   $status;
	  }

	  if (isset($input['showrecord']) && $input['showrecord'] != '') {
		  $showrecord         = $input['showrecord'];
		  $search->showrecord = $showrecord;
		  Session::put('showrecord', $showrecord);
	  }
	  $filters = $request->all();
	  unset($filters['_token']);
	  $arr['filters'] = $filters;
   
	  $pages = $getRecords->orderBy('id','asc')->paginate($showrecord);
	  return view('admin.pages.index', compact('pages', 'filters','search','search_text'))->with($arr)->with('i', ($request->input('page', 1) - 1) * $showrecord);
    }
    public function create(){   		
		$pagetemplates 	= $this->getPageTemplatesForNewPage();
        return View::make("admin.pages.add", compact('pagetemplates'));
    }
    public function store(Request $request)
    {
      	$this->validate($request, [
            'title' 	 => 'required',
        ]);
        $data =  $request->all();
		$data['user_id']=  auth('admin')->user()->id;
		$page_url = (!empty($request->page_url)) ? $request->page_url : $request->title;
		$data['page_url'] = $this->pageSlug($page_url);		
        $page = Page::create($data);  
		if(isset($data['pagemeta'])){
			$this->update_meta($data['pagemeta'],$page->id);
		}		
        return redirect()->route("admin.pages.edit",$page->id)->with('alert-success', 'Page has been added successfully.');
    }
    public function edit($id)
    { 
		
        $page = Page::find($id);
        if(empty($page)){
            return redirect()->route('admin.pages.index')->with('alert-error','page not found');
        }        
		if($page){			
			$pagedata = Pagemeta::where(["page_id" => $page->id,'page_type'=>'page'])->get();
			if($pagedata){
				foreach($pagedata as $row){
					$page->{$row->meta_key} = $row->meta_value;
				}
			}
		}
		$pagetemplates 	= $this->getPageTemplates();	
        return view('admin.pages.edit',compact('page','pagetemplates'));
    }

    public function update(Request $request, $id)
    {
	  	$data = $request->all();	
		$validatedData = $request->validate([
				'title' 	 => 'required',
				'page_url' 	  => 'required|unique:pages,page_url,'.$id.',id',
			],
		);
        $page 				= 	Page::find($id);
		$data['page_url']   =   (!empty($request->page_url))  ? $this->pageSlug($request->page_url,$id) : $this->pageSlug($request->title,$id);

		if(!empty($request->image)){            
            $image     =   $request->file('image');
            $fullName   =   $image->getClientOriginalName();
            $img_name   =   explode('.', $fullName)[0];
            $img_name   =   str_replace(' ','-',$img_name);
            $name       =   $img_name.'-'.rand().time().'.'.$image->extension();          
            $image->move('uploads/pages/', $name);
            $data['image'] = 'uploads/pages/'.$name;   
        }
        $page->update($data);		
		if(isset($data['pagemeta'])){
			$this->update_meta($data['pagemeta'],$id);
		}
        return redirect()->route('admin.pages.edit',$id)->with('alert-success', 'Page has been updated successfully');
    }
	function update_meta($customdata, $id){		
		if(count($customdata) > 0 ){
			foreach($customdata as $key => $val){				
				if($key == 'home_first_section_img1' || $key == 'home_sec_section_img2'|| $key == 'home_sec_section_img3' || $key == 'home_sec_section_img4' || $key == 'home_sec_section_img4' || $key == 'home_sec_section_img5'  || $key == 'home_sec_section_img6'  || $key == 'home_sec_section_img7'  || $key == 'home_sec_section_img8'  || $key == 'home_sec_section_img9' || $key == 'home_sec_section_img10' || $key == 'home_sec_section_img11' || $key == 'home_sec_section_img12' || $key == 'address_section_address_img13' || $key == 'address_section_address_img14' || $key == 'search_img14'|| $key == 'search_img15'){
					if (!empty($val)) {
						$imageName = rand(10, 100) . time() . '.' . $val->extension();
						$val->move(public_path() .config('constants.DS').config('constants.PAGES_URL'), $imageName);
						$path 	= config('constants.DS').config('constants.PAGES_URL').$imageName;
						$val 	= $path;
						Pagemeta::updateOrCreate(
							['page_id' => $id,'page_type' => 'page', 'meta_key' => $key],
							['page_id' => $id, 'page_type' => 'page','meta_key' => $key, 'meta_value' => $val]
						);
					}
				} else {					
					if (!empty($val)) {

						Pagemeta::updateOrCreate(
							['page_id' => $id, 'page_type' => 'page','meta_key' => $key],
							['page_id' => $id, 'page_type' => 'page','meta_key' => $key, 'meta_value' => $val]
						);
					}else{
						Pagemeta::updateOrCreate(
							['page_id' => $id, 'page_type' => 'page','meta_key' => $key],
							['page_id' => $id, 'page_type' => 'page','meta_key' => $key, 'meta_value' => '']
						);
					}
				}				
			}			
		}
	}
    public function destroy($id){
		$page = Page::find($id);
		@unlink(public_path().$page->image); 
		$page->delete();
		$page->pagemeta()->delete();
		return back()->with('alert-success', 'Page deleted successfully');
    }	
	public function getForm(Request $request){
		$page_template  = 	$request->page_template;        
        $edit           = 	$request->edit;
		$page 			= array();
        if($edit){
        	$page      	= Page::where(['template' => $page_template])->first();
			$pagedata 	= Pagemeta::where("page_id",$page->id)->get();
			if($pagedata){
				foreach($pagedata as $row){
					$page->{$row->meta_key} = $row->meta_value;
				}
			}
		}		
		$html  = view('includes.admin.ajax.pages.pages_form', compact('page', 'page_template'))->render();		
		return response()->json(['html' => $html]);
    }

	public function destroyPageImage($id) {
        $page = Page::find($id);      
        if(!empty($page->image)){
            @unlink(public_path() .'/'. $page->image);
            $page->image = null;
            $page->update();        
        }    
        return back()->with('alert-success', 'Page image has been deleted successfully');
    }

	//manage status
	public function changeStatus(Request $request){   
        $data  			=  $request->all();
        $id 			= 	$request->id;
        $status 		= 	$request->status;
        $pages 			= 	Page::find($id);
        $data['status']	= 	$status;
        $pages->update($data);
        return response()->json([
           'error'     =>  false,
           'message'   =>  'Status changed successfully.',           
        ]);
   }

   public function destroyImage($id,$imagename) {		
	$pagemeta = Pagemeta::where("meta_key",$imagename)->where("page_id",$id)->first();		
	$pagemeta_update = Pagemeta::find($pagemeta->id);	
	@unlink(public_path().$pagemeta_update->meta_value); 
	$pagemeta_update->meta_value = null;
	$pagemeta_update->update();
	return back()->with('alert-success', 'Image has been successfully deleted');
}


}
