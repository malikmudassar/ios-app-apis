<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\{Question,Category};
use Illuminate\Support\Facades\Hash;
class QuestionController extends Controller
{
    public function index(Request $request)
    {
        $data['nav'] = 'question';
        $data['category'] = Category::orderBy('id','desc')->get();
        return view('question',$data);
    }

    public function questionTableList()
    {
        $query['data'] = Question::orderBy('category__questions.category_id','asc')
        ->orderBy('category__questions.id', 'desc')
        ->select('category__questions.*', 'profile_categories.id as profile_cat_id', 'profile_categories.category_name')
        ->join('profile_categories', 'profile_categories.id', '=', 'category__questions.category_id')
        ->get();
        return response()->json(['data' => $query['data']]);
    }

    public function addEditQuestion(Request $request)
    {
        $data = new Question;
        $data->category_id = $request->input('category_id');
        $data->question = $request->input('question');
        $data->upto = $request->input('upto');
        $data->sortOrder = $request->input('sortOrder');
        $data->addButton = $request->input('addButton');
        if($request->input('id') >0)
        {
            $update = Question::where('id',$request->input('id'))->update([
                'category_id' => $request->input('category_id'),
                'question' => $request->input('question'),
                'upto' => $request->input('upto'),
                'sortOrder' => $request->input('sortOrder'),
                'addButton' => $request->input('addButton'),
            ]);
            if($update)
            {
                $arr = array("sucesss"=>'200' ,'message' => 'Question successfully updated');
            }
            else
            {
                $arr = array( "sucesss"=>'400' ,'message' => 'Opps error');
            }
        }
        else
        {
            $data->save();
            Question::where('id',$data->id)->update([
                'enc_id' => Hash::make($data->id),
            ]);
            if($data->save() > 0){
                $arr = array( "sucesss"=>'200' ,'message' => 'Question successfully added');
            }
            else
            {
                $arr = array( "sucesss"=>'400' ,'message' => 'Opps error');
            }
        }
            return json_encode($arr);     
        }

        public function deleteQuestionAction(Request $request)
        {
        $query=Question::where('id',$request->input('id'))->delete();
        if($query)
        {
            $arr = array( "sucesss"=>'200' ,'message' => 'Question successfully deleted'); 
        }
        else
        { 
            $arr = array( "sucesss"=>'400' ,'message' => 'Opps error');
        }
        return json_encode($arr);
        }
}
?>