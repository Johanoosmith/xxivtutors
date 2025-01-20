<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
use Mail;
use App\Models\EmailTemplate;
use App\Models\Country;
use App\Models\Media;
use App\Models\Pagetemplate;
use App\Models\Page;
use App\Models\EmailLog;
use App\Models\Transport;
use App\Models\TextCategory;
use App\Models\Language;
use App\Models\Course;
use File;
use Config;

class Controller extends BaseController
{
    use AuthorizesRequests, ValidatesRequests;
	
	 /**
     * sendMail.
     *
     * @return \Illuminate\Http\Response
    */
    public function sendMail($email_to, $email_subject, $emailcontent, $emailtemplate)
    {
        $mail_status = 0;
        if (request()->getHost() != '127.0.0.1' && !empty($email_to)) {
            $mail_status = Mail::send(
                'mail.'.$emailtemplate,
                ['emailcontent'=>$emailcontent],
                function ($message) use ($email_to, $email_subject) {                   
                    $message->to($email_to)->subject($email_subject); 
                }
            );
        }
        return $mail_status;
    }
    /**
    * callSendMail.
    *
    * @return \Illuminate\Http\Response
    */
    public function callSendMail($email_to, $email_action, $replace_array,$to_name)
    {
        $emailTemplate = EmailTemplate::where(['action'=>$email_action])->first();
        $mail_status = 0;
        if ($emailTemplate) {
            $email_subject      = $emailTemplate->subject;
            $email_body         = $emailTemplate->message;
            $constant           = explode(',', $emailTemplate->constants);
            $email_constants    = array_map(function ($str) {
                return '{'.$str.'}';
            }, $constant);
            $email_body= str_replace($email_constants, $replace_array, $email_body);      
            $mail_status= $this->sendMail($email_to, $email_subject, $email_body, 'order');  
        }
        return $mail_status;
    }
    public function uploadMedia($request, $user_id) {

        $data = $request->all();        
        if (!empty($request->image)) {
            $imageName = time() . '.' . $request->image->extension();
            $request->image->move('uploads/media/', $imageName);
            $data['image']      = $imageName;
            $data['image_path'] = 'uploads/media/' . $imageName;
            $data['image_type'] =  pathinfo('uploads/media/' . $imageName, PATHINFO_EXTENSION);
            $file_size = filesize($data['image_path']); // Get file size in bytes
            $file_size = $file_size / 1024; // Get file size in KB			
            $data['image_size'] = $file_size;
            $data['title'] = $request->title;
        }
        $data['user_id'] = $user_id;
        $media = Media::create($data);
        return $media->id;
    }
    public function removeMedia($post_id) {
        $post = Post::find($post_id);       
        if(!empty($post->media_id)){
            $media = Media::find($post->media_id);
            @unlink(public_path() . $media->image_path);
            $media->delete();
        }
        $post->media_id = null;
        $post->image = null;
        $post->save(); 
    }
    function getCourses(){
        $list_arr = Course::where(['status'=>'1'])->orderBy('title','asc')->pluck('title','id');
        return $list_arr;
    }
    function getCoursesLevel(){
    $list_arr = Course::where('status', '1')->orderBy('level', 'asc')->select('level')->distinct()->pluck('level');
    return $list_arr;
    }

    function getPageTemplates(){
        $list_arr = Pagetemplate::where(['status'=>'1'])->orderBy('name','asc')->pluck('full_name', 'name')->prepend("Please Select","");
        return $list_arr;
    }
    function getPageTemplatesForNewPage(){
        $list_arr = Pagetemplate::where(['status'=>'1','temp_status'=>'1'])->orderBy('name','asc')->pluck('full_name', 'name')->prepend("Please Select","");
        return $list_arr;
    }
    // Page slug
    public function pageSlug($title, $id = 0) {
		// Normalize the title		      
		$separator = '-';
		$string = trim($title);
        $string = mb_strtolower($string, "UTF-8");
	    $string = preg_replace("/[^a-z0-9_\sء?اأإآؤئبتثجحخدذرزسشصضطظعغفقكلمنهويةى]#u/", "", $string);
	    $string = preg_replace("/[\s-]+/", " ", $string);
	    $slug = preg_replace("/[\s_]/", $separator, $string);
        $slug = preg_replace('/[^a-zA-Z0-9_ %\[\]\.\(\)%&-]/s', '', $string);
        $slug = str_replace(" ", "-", $slug);
        $slug = str_replace(".", "", $slug);
		// Get any that could possibly be related.
		$allSlugs = $this->getRelatedPageSlugs($slug, $id);
		// If we haven't used it before then we are all good.
		if (!$allSlugs->contains('slug', $slug)) {
			return $slug;
		}
		// Just append numbers like a savage until we find not used.
		for ($i = 1; $i <= 10; $i++) {
			$newSlug = $slug . '-' . $i;
			if (!$allSlugs->contains('slug', $newSlug)) {
				return $newSlug;
			}
		}
		throw new \Exception('Can not create a unique slug');
	}
	protected function getRelatedPageSlugs($slug, $id = 0) {
		return Page::select('page_url')
			->where('page_url', '=', $slug)
			->where('id', '<>', $id)
			->get();
	}
    public function getTextCategoryDropdown() {        
        $field_name =  'en_name';
        $list_arr = TextCategory::where('status', '1')->pluck($field_name, 'id')->prepend("Please Select","");
        return $list_arr;
    }
    function createDirecrotory($path) {
        if (!File::exists($path)) {
            File::makeDirectory($path, 0755, true, true);
        }
    }
}
