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
use App\Models\NotificationTemplate;
use Illuminate\Notifications\Notification;
use Illuminate\Support\Facades\Validator;

class NotificationController extends Controller
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
    
        $defaultLimit = config('settings.ADMIN_PAGE_LIMIT_NO', 10);
        $showrecord = $defaultLimit;
    
        $query = NotificationTemplate::query();
    
        $search = [];
    
        if (!empty($input['search_name'])) {
            $query->where('name', 'LIKE', '%' . $input['search_name'] . '%');
            $search['search_name'] = $input['search_name'];
        }

        if (!empty($input['search_subject'])) {
            $query->where('subject', 'LIKE', '%' . $input['search_subject'] . '%');
            $search['search_subject'] = $input['search_subject'];
        }
    
  
    
        if (!empty($input['status'])) {
            $query->where('status', $input['status']);
            $search['status'] = $input['status'];
        }
    
        if (!empty($input['per_page'])) {
            $showrecord = (int)$input['per_page'];
            $search['per_page'] = $showrecord;
            Session::put('showrecord', $showrecord);
        }
    
        $query->orderBy('created_at', 'DESC');
        $emailtemplates = $query->paginate($showrecord);
    
     return view('admin.notificationtemplates.index', compact('emailtemplates')) ->with([ 'search' => $search, 'i' => ($request->input('page', 1) - 1) * $showrecord ]);
    }
    
    public function create()
    {
        return View::make("admin.notificationtemplates.add");
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name'        => 'required',
            'subject'     => 'required',
            'email_body'  => 'required',
        ]);
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput()->with('alert-danger', 'Please correct the errors below.');
        }

        $slug = strtoupper(str_replace(' ', '_', $request->name));

        $data                    =  new NotificationTemplate();
        $data->slug              = $slug;
        $data->name              = $request->name;
        $data->subject           = $request->subject;
        $data->email_body        = $request->email_body;
        $data->save();
        return redirect()->route("admin.notification-templates.index")->with('alert-success', 'Notification Template has been created successfully');
    }

    public function edit($id)
    {
        $notificationTemplate = NotificationTemplate::find($id);

        if (empty($notificationTemplate)) {
            return redirect()->route('admin.notification-templates.index')
                ->with('alert-error', 'Notification template not found');
        }

        return view('admin.notificationtemplates.edit', compact('notificationTemplate'));
    }
    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'name'        => 'required',
            'subject'     => 'required',
            'email_body'  => 'required',
        ]);
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput()->with('alert-danger', 'Please correct the errors below.');
        }

        $emailtemplate = NotificationTemplate::find($id);

        if (!$emailtemplate) {
            return redirect()->route('admin.notification-templates.index')->with('alert-error', 'Notification Template not found.');
        }

        $slug = strtoupper(str_replace(' ', '_', $request->name));

        $emailtemplate->slug       = $slug;
        $emailtemplate->name       = $request->name;
        $emailtemplate->subject    = $request->subject;
        $emailtemplate->email_body = $request->email_body;
        $emailtemplate->save();

        return redirect()->route('admin.notification-templates.index')->with('alert-success', 'Notification Template has been updated successfully.');
    }


    public function destroy($id)
    {
        $emailtemplate = NotificationTemplate::find($id);
        if (!$emailtemplate) {
            return redirect()->route('admin.notification-templates.index')->with('alert-error', 'Notification Template not found.');
        }
        $emailtemplate->delete();
        return redirect()->route('admin.notification-templates.index')->with('alert-success', 'Notification Template has been deleted successfully.');
    }
}
