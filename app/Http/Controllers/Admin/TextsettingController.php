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

use App\Models\Textsetting;

class TextsettingController extends Controller
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
        
        $textsettings   = new Textsetting();        
        $textcatlist    = $this->getTextCategoryDropdown();       
        $textsettings       = $textsettings->where("lang_code", 'en');
        
        $columns = ['key_value', 'value'];

        if (isset($input['search_text']) && $input['search_text'] != '') {
            $search_text = $input['search_text'];
            $search->search_text = $search_text;            
            foreach($columns as $column){               
                $textsettings = $textsettings->orWhere($column, 'LIKE', '%' . $search_text . '%');
            }            
        }

        if (isset($input['lang_code']) && $input['lang_code'] != '') {
            $lang_code          = $input['lang_code'];
            $textsettings       = $textsettings->where("lang_code", $lang_code);
            $search->lang_code  = $lang_code;
        }

        if (isset($input['key_text']) && $input['key_text'] != '') {
            $key_text           = $input['key_text'];
            $textsettings       = $textsettings->where("key_text", $key_text);
            $search->key_text   = $key_text;
        }
             
        if (isset($input['showrecord']) && $input['showrecord'] != '') {
            $showrecord = $input['showrecord'];
            $search->showrecord = $showrecord;
            Session::put('showrecord', $showrecord);
        }
       
        $filters = $request->all();
        unset($filters['_token']);
        $arr['filters'] = $filters;

       

        $textsettings = $textsettings->sortable(['id' => 'DESC','position' => 'ASC', ])->paginate($showrecord);
        return view('admin.textsettings.index', compact('textsettings','textcatlist'))->with($arr)
            ->with('i', ($request->input('page', 1) - 1) * $showrecord);
    }

    public function create()
    {
        $textcatlist    = $this->getTextCategoryDropdown();    
        $languagelist = $this->getLanguageDropdownWithCode();
        return View::make("admin.textsettings.add", compact('textcatlist','languagelist'));
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'key_value' => 'required',
        ], [
            'key_value.required' => 'This field is required.',
        ]);

        $keyText = $request->get('key_text');
        $keyValue = $request->get('key_value');
        $langValue = $request->get('value');
        foreach ($langValue as $lang_code => $value) {
            $model = new Textsetting;
            $model->key_text = trim($keyText);
            $model->key_value = trim($keyValue);
            $model->value = ($value) ? $value : '';
            $model->lang_code = 'en';
            $model->save();
            $lang_code = 'en';
            $this->settingFileWrite($lang_code);
        }
        return redirect()->route("admin.textsettings.create")->with('alert-success', 'Text added successfully.');
    }

    public function edit($id)
    {
        $textcatlist  = $this->getTextCategoryDropdown();    
        $languagelist = $this->getLanguageDropdownWithCode();
        $textsetting = Textsetting::find($id);
        if(empty($textsetting)){
            return redirect()->route('admin.textsettings.index')->with('alert-error','Text Setting not found');
        }        
        return view('admin.textsettings.edit',compact('textsetting','textcatlist','languagelist'));
    }

    public function update(Request $request, $id)
    {

        $data = $request->all();
        $this->validate($request, [
            'value' => 'required',
        ]);

        $textsetting = Textsetting::find($id);
        $textsetting->update($data);
        $this->settingFileWrite($textsetting->lang_code);

        return redirect()->route('admin.textsettings.index')->with('alert-success', 'Text updated successfully');
    }

    public function destroy($id)
    {
        return redirect()->route('admin.textsettings.index')->with('alert-error', 'Text deleted permission not allowed');;
        // $textsetting = Textsetting::find($id);
        // $lang_code = $textsetting->lang_code;
        // $textsetting->delete();
        // $this->settingFileWrite($lang_code);
        // return back()->with('alert-success', 'Text deleted successfully');
    }
    

    public function settingFileWrite($lang_code = 'en')
    {
        $list = Textsetting::where(['lang_code' => $lang_code])->orderBy('created_at', 'asc')->get()->toArray();
          //  dd($list);
        $currLangArray = "<?php return [\n";

        foreach ($list as $listDetails) {
            $currLangArray .= "'" . $this->htmlEntities($listDetails['key_value']) . "'=>'" . $this->htmlEntities($listDetails['value']) . "'," . "\n";
        }

        $currLangArray .= '];';

        $file = base_path() . '/resources/lang/' . $lang_code . '/front.php';

        $bytes_written = File::put($file, $currLangArray);
        if ($bytes_written === false) {
            die("Error writing to file");
        }
        Artisan::call('config:clear');
    }

    public function htmlEntities($str = '')
    {
        if (strpos($str, "'") && !strpos($str, "\'")) {
            return str_replace("'", "\'", $str);
        } else {
            return $str;
        }
    }  

}
