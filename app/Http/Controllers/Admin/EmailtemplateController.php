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

use App\Models\EmailTemplate;

class EmailtemplateController extends Controller
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
        $search         = (object) null;
        $arr['search']  = $search;
        $showrecord       =   trans('admin.ADMIN_PAGE_LIMIT_NO'); 
        $emailtemplates = new EmailTemplate();
        if (isset($input['search_text']) && $input['search_text'] != '') {
            $search_text       = $input['search_text'];
            $emailtemplates    = $emailtemplates->where('subject', 'LIKE', "%$search_text%");
            $search->search_text  = $search_text;
        }

        if (isset($input['lang_code']) && $input['lang_code'] != '') {
            $lang_code      = $input['lang_code'];
            $emailtemplates   = $emailtemplates->where("language_id", $lang_code);
            $search->lang_code = $lang_code;
        }
             
        if (isset($input['showrecord']) && $input['showrecord'] != '') {
            $showrecord = $input['showrecord'];
            $search->showrecord = $showrecord;
            Session::put('showrecord', $showrecord);
        }
        // filters
        $filters = $request->all();
        unset($filters['_token']);
        $arr['filters'] = $filters;

        $emailtemplates = $emailtemplates->paginate($showrecord);
        return view('admin.emailtemplates.index', compact('emailtemplates'))->with($arr)
            ->with('i', ($request->input('page', 1) - 1) * $showrecord);
    }

    public function create(){       
        return View::make("admin.emailtemplates.add");
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'subject' 	 => 'required',
            'message'    => 'required',
        ]);  

        $data =  $request->all();
        $emailtemplate = EmailTemplate::create($data);       
        return redirect()->route("admin.emailtemplates.create")->with('alert-success', 'Email template has been created successfully');
    }

    public function edit($id)
    {
       
        $emailtemplate = EmailTemplate::find($id);
        if(empty($emailtemplate)){
            return redirect()->route('admin.emailtemplates.index')->with('alert-error','email template not found');
        }        
        return view('admin.emailtemplates.edit',compact('emailtemplate'));
    }

    public function update(Request $request, $id)
    {
		
	  $data = $request->all();
	
        $this->validate($request, [
            'subject' 	 => 'required',
            'message'    => 'required',          
        ]);

        $emailtemplate = EmailTemplate::find($id);
        $emailtemplate->update($data);

        return redirect()->route('admin.emailtemplates.index')->with('alert-success', 'Email template has been updated successfully');
    }

    public function destroy($id)
    {
        return redirect()->route('admin.emailtemplates.index')->with('alert-error', 'Email template deleted permission not allowed');
    }

}
