<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\{Information,Category_Question};
class InformationController extends Controller
{
    public function index(Request $request)
    {
        $data['nav'] = 'information';
        $data['questions'] = Category_Question::orderBy('id','desc')->get();
        return view('information',$data);
    }

    public function infoTableList()
    {
        $query['data'] = information::orderBy('info_id','desc')
                                      ->join('category__questions', 'category__questions.id', '=', 'information.question_id')
                                      ->get();
        return response()->json(['data' => $query['data']]);
    }

    public function addEditInfo(Request $request)
    {
        $data = new Information;
        $data->info_content = $request->input('info_content');
        $data->question_id = $request->input('question_id');
        if($request->input('info_id') >0)
        {
            $update = Information::where('info_id',$request->input('info_id'))->update([
                'info_content' => $request->input('info_content'),
                'question_id' => $request->input('question_id'),
            ]);
            if($update)
            {
                $arr = array("sucesss"=>'200' ,'message' => 'Question information successfully updated');
            }
            else
            {
                $arr = array( "sucesss"=>'400' ,'message' => 'Opps error');
            }
        }
        else
        {
            $data->save();
            Category_Question::where('id',$request->input('question_id'))->update([
                'has_info' => 1,
            ]);
            if($data->save() > 0)
            {
                $arr = array( "sucesss"=>'200' ,'message' => 'Question information successfully added');
            }
            else
            {
                $arr = array( "sucesss"=>'400' ,'message' => 'Opps error');
            }
        }
            return json_encode($arr);     
        }

        public function deleteInfoAction(Request $request)
        {
        $query=Information::where('info_id',$request->input('info_id'))->delete();
        if($query)
        {
            $arr = array( "sucesss"=>'200' ,'message' => 'Question information successfully deleted'); 
        }
        else
        { 
            $arr = array( "sucesss"=>'400' ,'message' => 'Opps error');
        }
        return json_encode($arr);
        }


}
?>