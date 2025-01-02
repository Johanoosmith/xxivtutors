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

use App\Models\EmailLog;

class EmaillogController extends Controller
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

    public function index(Request $request)
    {
        $input = $request->all();
        $search         = (object) null;
        $arr['search']  = $search;
        $showrecord     = trans('admin.ADMIN_PAGE_LIMIT_NO');       
        $emaillogs      = new EmailLog();
        $search_text    = '';
        if (isset($input['search_text']) && $input['search_text'] != '') {
            $search_text       = $input['search_text'];
            $emaillogs    = $emaillogs->where('subject', 'LIKE', "%$search_text%")->orWhere('to_name', 'LIKE', "%$search_text%")->orWhere('to_email', 'LIKE', "%$search_text%");
            $search->search_text  = $search_text;
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

        $emaillogs = $emaillogs->orderBy('id' , 'DESC')->paginate($showrecord);

        return view('admin.emaillogs.index', compact('emaillogs','search_text'))->with($arr)
            ->with('i', ($request->input('page', 1) - 1) * $showrecord);
    }

    public function show($id){
        $emailLog        = EmailLog::find($id);
        if(empty($emailLog)){
           return redirect()->route('admin.emaillogs.index')->with('alert-error','Email Log not found');
        }
        return view('admin.emaillogs.view',compact('emailLog'));
    }  

    public function destroy($id)
    {
        $emailLog = EmailLog::find($id);
        $emailLog->delete();  
        return redirect()->route('admin.emaillogs.index')->with('alert-error', 'Email Log has been deleted successfully');
    }

}
