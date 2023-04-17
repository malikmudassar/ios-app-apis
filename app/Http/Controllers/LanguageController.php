<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\Language;
class LanguageController extends Controller
{
    public function index(Request $request)
    {
        $data['nav'] = 'language';
        return view('language',$data);
    }
    public function languageTableList()
    {
        $query['data'] = Language::orderBy('language_id','desc')->get();
        return response()->json(['data' => $query['data']]);
    }

    public function addEditLanguage(Request $request)
    {
        $data = new Language;
        $data->language = $request->input('language');
        if($request->input('language_id') >0)
        {
            $update = Language::where('language_id',$request->input('language_id'))->update([
                'language' => $request->input('language'),
            ]);
            if($update)
            {
                $arr = array("sucesss"=>'200' ,'message' => 'Language successfully updated');
            }
            else
            {
                $arr = array( "sucesss"=>'400' ,'message' => 'Opps error');
            }
        }
        else
        {
            $data->save();
            if($data->save() > 0){
                $arr = array( "sucesss"=>'200' ,'message' => 'Language successfully added');
            }
            else
            {
                $arr = array( "sucesss"=>'400' ,'message' => 'Opps error');
            }
        }
            return json_encode($arr);     
        }

        public function deleteLanguageAction(Request $request)
        {
        $query=Language::where('language_id',$request->input('language_id'))->delete();
        if($query)
        {
            $arr = array( "sucesss"=>'200' ,'message' => 'Language successfully deleted'); 
        }
        else
        { 
            $arr = array( "sucesss"=>'400' ,'message' => 'Opps error');
        }
        return json_encode($arr);
        }
}
?>