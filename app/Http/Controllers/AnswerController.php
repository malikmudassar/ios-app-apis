<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\{Answer,Question,Category};
class AnswerController extends Controller
{
    public function index(Request $request)
    {
        $data['nav'] = 'answer';
        $data['category'] = Category::orderBy('id','desc')->get();
        return view('answer',$data);
    }

    public function answerTableList()
    {
        $query['data'] = Answer::orderBy('category_answers.id','desc')
        ->select('category_answers.*', 'profile_categories.id as profile_cat_id', 'profile_categories.category_name','category__questions.id as cat_question_id','category__questions.question')
        ->join('profile_categories', 'profile_categories.id', '=', 'category_answers.category_id')
        ->join('category__questions', 'category__questions.id', '=', 'category_answers.question_id')
        ->get();
        return response()->json(['data' => $query['data']]);
    }

    public function addEditAnswer(Request $request)
    {
        $data = new Answer;
        $data->category_id = $request->input('category_id');
        $data->question_id = $request->input('question_id');
        $data->answer_statement = $request->input('answer_statement');
        if($request->input('id') >0)
        {
            $update = Answer::where('id',$request->input('id'))->update([
                'category_id' => $request->input('category_id'),
                'question_id' => $request->input('question_id'),
                'answer_statement' => $request->input('answer_statement'),
            ]);
            if($update)
            {
                $arr = array("sucesss"=>'200' ,'message' => 'Answer successfully updated');
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
                $arr = array( "sucesss"=>'200' ,'message' => 'Answer successfully added');
            }
            else
            {
                $arr = array( "sucesss"=>'400' ,'message' => 'Opps error');
            }
        }
            return json_encode($arr);     
        }

        public function deleteAnswerAction(Request $request)
        {
        $query=Answer::where('id',$request->input('id'))->delete();
        if($query)
        {
            $arr = array( "sucesss"=>'200' ,'message' => 'Answer successfully deleted'); 
        }
        else
        { 
            $arr = array( "sucesss"=>'400' ,'message' => 'Opps error');
        }
        return json_encode($arr);
        }

        public function categoryDropdownFilter(Request $request)
        {
        $query=Question::where('category_id',$request->input('category_id'))->orderBy('id','desc')->get();
        if($query)
        {
            $arr = array( "sucesss"=>'200' ,'message' => 'Questions array','data' => $query); 
        }
        else
        { 
            $arr = array( "sucesss"=>'400' ,'message' => 'Opps error' , 'data' => []);
        }
        return json_encode($arr);
        }
}
?>