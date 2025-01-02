<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Support\Facades\View;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Option;
use App\Models\EmailSetting;

class SettingController extends Controller {
      /**
       * Create a new controller instance.
       *
       * @return void
       */
      public function __construct() {
        $this->middleware('admin');
      }

      /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($slug)
    {
        $optiondata = Option::get();
		$options =  array();
		if($optiondata){
			foreach($optiondata as $option){
				$options[$option->option_key] = $option->option_value;
			}
		}
		$pages = array();
		$language_id = 1;
		$pagelist =  array();	
		
		return view('admin.settings.index',compact('slug','options','pages','pagelist'));
		
		
		
    }
	public function update_option(Request $request){
		$optiondata =  $request->all();
		foreach($optiondata as $key=>$val){
			$obj = new Option;
			if($key == ''){
				if (!empty($val)) {
					$imageName = rand(10, 100) . time() . '.' . $val->extension();
					$val->move(public_path() .config('constants.DS').config('constants.MEDIA_URL'), $imageName);
					$path 	= config('constants.DS').config('constants.MEDIA_URL').$imageName;
					$val 	= $path;
					$option = Option::where(['option_key'=>$key])->get();	
					if(count($option) == 0){
						$obj->option_key 	= $key;
						$obj->option_value 	= $val;
						$obj->save();	
					} else {
						Option::where(['option_key'=>$key])->update(array('option_value'=>$val)); 
					} 
				}
			}else{
				$obj->option_key 	= $key;
				$obj->option_value 	= $val;
				$option = Option::where(['option_key'=>$key])->get();	
				if(count($option) == 0){
					$obj->save();	
				} else {
					Option::where(['option_key'=>$key])->update(array('option_value'=>$val)); 
				}
			}
		}		
		return back()->with('alert-success','Successfully updated');		
	}

	
    public function emailSetting(Request $request)
    {
        $emailSetting = EmailSetting::first();
		if(!$emailSetting){
            $emailSetting = new EmailSetting;
        }

        if($request->isMethod('post')){
            $formData = $request->all();
            $validation = [
                'host'          => 'required',
                'username'      => 'required',
                'password'      => 'required',
                'port'          => 'required',
                'from_email'    => 'required',
                'from_name'     => 'required',
                'to_email' 		=> 'required',
            ];
            $this->validate($request,$validation);

            $emailSetting->host             = $formData['host'];
            $emailSetting->username         = $formData['username'];
            $emailSetting->password         = $formData['password'];
            $emailSetting->port             = $formData['port'];
            $emailSetting->encryption       = $formData['encryption'];
            $emailSetting->transport        = $formData['transport'];
            $emailSetting->from_email       = $formData['from_email'];
            $emailSetting->from_name        = $formData['from_name'];
            $emailSetting->to_email    		= $formData['to_email'];
            $emailSetting->save();

            return back()->with('alert-success','Email setting successfully updated.');
        }
		return view('admin.settings.email_setting',compact('emailSetting'));
    }

	public function destroySettingsImage($imagename) {		
		$optionmeta = Option::where("option_key",$imagename)->first();		
		$option_update = Option::find($optionmeta->id);
		@unlink(public_path().$option_update->option_value); 
		$option_update->option_value = null;		
		$option_update->update();
		return back()->with('alert-success', 'Image has been successfully deleted');
	}

}
