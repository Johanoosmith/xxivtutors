<?php
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use File;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\View;
use Input;
use Redirect;
use Session;
use Artisan;
use Auth;
use App\Models\Media;
use Illuminate\Http\JsonResponse;
class MediaController extends Controller
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
        return redirect()->route('admin.dashboard')->with('alert-info', 'Not found');
        $input = $request->all();   
        $getRecords      = new Media();
        $search         = (object) null;
        $arr['search']  = $search;
        $showrecord       =   trans('admin.ADMIN_PAGE_LIMIT_NO'); 
        $search_text = '';
        if (isset($input['search_text']) && $input['search_text'] != '') {
            $search_text       = $input['search_text'];
            $getRecords    = $getRecords->where('title', 'LIKE', "%$search_text%");
            $search->search_text  = $search_text;
        }

        if (isset($input['status']) && $input['status'] != '') {
            $status          =   $input['status'];
            $getRecords           =   $getRecords->where('status', 'LIKE', $status);
            $search->status  =   $status;
        }

        if (isset($input['showrecord']) && $input['showrecord'] != '') {
            $showrecord = $input['showrecord'];
            $search->showrecord = $showrecord;
            Session::put('showrecord', $showrecord);
        }
        $filters = $request->all();
        unset($filters['_token']);
        $arr['filters'] = $filters;
    
        $upload_files = $getRecords->orderBy('id','desc')->paginate($showrecord); 
        return view('admin.media.index', compact('upload_files', 'filters','search','search_text'))->with($arr)->with('i', ($request->input('page', 1) - 1) * $showrecord); 
    }

    public function create(){    
        return redirect()->route('admin.dashboard')->with('alert-info', 'Not found');   
        return View::make("admin.media.add");
    }

    public function store(Request $request){
        $this->validate($request, [
            'title' 	=> 'required',           
            'image'     => 'mimes:jpeg,png,bmp,tiff |max:4096',  
        ]);
        $data =  $request->all();		
        if(!empty($request->image)){
            $imageName 			= time().'.'.$request->image->extension();       
            $request->image->move('uploads/media/', $imageName);
            $data['image'] 		= $imageName;
			$data['image_path'] = 'uploads/media/'.$imageName;
            $data['image_type'] =  pathinfo('uploads/media/'.$imageName, PATHINFO_EXTENSION);				
			$file_size = filesize($data['image_path']); // Get file size in bytes
			$file_size = $file_size / 1024; // Get file size in KB			
			$data['image_size'] = $file_size;
        }  
		
        $data['user_id'] = Auth::guard('admin')->user()->id;		
        $media = Media::create($data);       
        return redirect()->route("admin.media.create")->with('alert-success', 'Image has been created successfully');
    }

    public function edit($id){       
        return redirect()->route('admin.dashboard')->with('alert-info', 'Not found');
        $media = Media::find($id);
        if(empty($media)){
            return redirect()->route('admin.media.index')->with('alert-error','Image not found');
        }        
        return view('admin.media.edit',compact('media'));
    }

    public function update(Request $request, $id){
	    $data = $request->all();	
        $this->validate($request, [
            'title'     =>  'required',           
            'image'     =>  'mimes:jpeg,png,bmp,tiff |max:4096',        
        ]);
        $media = Media::find($id);
        if(!empty($request->image)){
            @unlink(public_path().$media->image); 
            $imageName = time().'.'.$request->image->extension(); 
            $request->image->move('uploads/media/', $imageName);            
			$data['image'] 		    =   $imageName;
			$data['image_path']     =   'uploads/media/'.$imageName;
            $data['image_type']     =    pathinfo('uploads/media/'.$imageName, PATHINFO_EXTENSION);				
			$file_size = filesize($data['image_path']); // Get file size in bytes
			$file_size = $file_size / 1024; // Get file size in KB			
			$data['image_size'] = $file_size;
        }
        $media->update($data);
        return redirect()->route('admin.media.index')->with('alert-success', 'Image has been updated successfully');
    }

    public function destroy($id){
        $media = Media::find($id);   
		@unlink(public_path().$media->image);         
        $media->delete();
        return back()->with('alert-success', 'Image has been deleted successfully');
    }

     public function destroyImage($id) {
        $media = Media::find($id);
        @unlink(public_path().$media->image_path); 
        $media->image = null;
		$media->image_path = null;
		$media->image_type = null;
		$media->image_size = null;
        $media->update();
        return back()->with('alert-success', 'Image image has been deleted successfully');
    }


      /**
     * Write code on Method
     *
     * @return response()
     */

    public function Upload2(Request $request): JsonResponse
    {
       
        if ($request->hasFile('upload')) {
            
          
            $originName = $request->file('upload')->getClientOriginalName();
            $fileName = pathinfo($originName, PATHINFO_FILENAME);
           
            $extension = $request->file('upload')->getClientOriginalExtension();
            $fileName = $fileName . '_' . time() . '.' . $extension;
      
            $request->file('upload')->move(public_path('uploads/media'), $fileName);      
            $url = asset('uploads/media/' . $fileName);  
            return response()->json(['fileName' => $fileName, 'uploaded'=> 1, 'url' => $url]);
        }
    }
}
