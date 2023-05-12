<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\{User,Category_Question,CategoryAnswer};
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
class UserController extends Controller
{
    public function userProfile(Request $request)
    {
        $validator = Validator::make($request->all(), 
        [
            'fname' => 'required',
            'age' => 'required',
            'birth_month' => 'required',
            'birth_day' => 'required',
            'height' => 'required',
            'gender' => 'required'
        ],
        [
          'fname.required'  => 'Please enter first name',
          'age.required'  => 'Please enter age',
          'birth_month.required'  => 'Please enter birth month',
          'birth_day.required'  => 'Please enter birth day',
          'height.required'  => 'Please enter height',
          'gender.required'  => 'Please enter gender',
        ]);
        if ($validator->fails()) 
        {
    		return response()->json(["validateErrorList" => $validator->messages()],422);
        }
        else
        {
        $query = User::where('id',Auth::id())->update([
            'fname' => $request->fname,
            'age' => $request->age,
            'birth_month' => $request->birth_month,
            'birth_day' => $request->birth_day,
            'height' => $request->height,
            'gender' => $request->gender,
        ]);
        if($query)
        {
        $status = 200;
          $data = array(
            'success' => true,
            'message' => 'User profile successfully updated',
          );
        }
        else
        {
          $status = 500;
          $data = array(
            'success' => false,
            'message' => 'Something went wrong',
          );
        }
    }
    	return response()->json($data,$status);        
}

public function userProfileImage(Request $request)
{
       $validator = Validator::make($request->all(), 
        [
            'image' => 'required'
        ],
        [
          'image.required'  => 'Please upload prfile image',
        ]);
        if ($validator->fails()) 
        {
    		return response()->json(["validateErrorList" => $validator->messages()],422);
        }
        else
        {
            if (@$_FILES['image']['name']) {
                $temp = explode('.', $_FILES['image']['name']);
                $extension = end($temp);
                $path = '../public/apiAssets/userProfiles/';
                $filename = basename($_FILES['image']['name']); 
                $filename = time() . "." . $extension;
                if (move_uploaded_file($_FILES['image']['tmp_name'], $path . $filename)) {
                    $image=$filename;
                } else {
                     $image='error';
                }
                }else{
                $image='error';
                }
                $savePath = url('/').'/apiAssets/userProfiles/'.$image;
                $query = User::where('id',Auth::id())->update([
                    'profile_path' => $savePath,
                    ]);
                if($query)
                {
                $status = 200;
                $data = array(
                    'success' => true,
                    'message' => 'User profile successfully updated',
                );
                }
                else
                {
                $status = 500;
                $data = array(
                    'success' => false,
                    'message' => 'Something went wrong',
                );
                }
    }
    	   return response()->json($data,$status); 

}

public function userQA(Request $request)
{
            $array = json_decode($request->object, true);
            $preferences = $array['preferences'];
            $questions = [];
            foreach ($preferences as $preference) {
                foreach ($preference['questions'] as $question) {
                    $questionID = $question['questionID'];
                    $selectedOptionsID = $question['selectedOptionsID'];
                    $questions[] = [
                        'questionID' => $questionID,
                        'selectedOptionsID' => $selectedOptionsID
                    ];
                }
            }
            $userQA = json_encode($questions);
            $query = User::where('id',Auth::id())->update([
              'userQA' => $userQA,
              ]);
          if($query)
          {
          $status = 200;
          $data = array(
              'success' => true,
              'message' => 'User profile successfully updated',
          );
          }
          else
          {
          $status = 500;
          $data = array(
              'success' => false,
              'message' => 'Something went wrong',
          );
          }
          return response()->json($data,$status);
}

public function getUserData()
{
          $userData = User::where('id',Auth::id())->get();
          foreach($userData as $val)
       {
            $questions = json_decode($val->userQA, true);
            $question_answers = [];
            if(isset($questions))
            {
            foreach ($questions as $question) {
                $questionID = $question['questionID'];
                $selectedOptionsID = $question['selectedOptionsID'];
                $question_statement = Category_Question::where('id',$questionID)->get();
                $answer_statement = [];
                foreach ($selectedOptionsID as $option_id) {
                    $answer_statement[] = CategoryAnswer::where('id',$option_id)->get();
                }
                $question_answers[] = [
                    'question_statement' => $question_statement,
                    'answer_statement' => $answer_statement
                ];
            }
          }
                $dataArray[] = array(
                    "id"=>$val->id,
                    "fname"=>$val->fname,
                    "account"=>$val->account,
                    "age"=>$val->age,
                    "birth_month"=>$val->birth_month,
                    "birth_day"=>$val->birth_day,
                    "occupation"=>$val->occupation,
                    "purpose"=>$val->purpose,
                    "provider"=>$val->provider,
                    "lat"=>$val->lat,
                    "lng"=>$val->lng,
                    "device_id"=>$val->device_id,
                    "attraction"=>$val->attraction,
                    "pref_profile_view"=>$val->pref_profile_view,
                    "subsc_package"=>$val->subsc_package,
                    "Zodic_sign"=>$val->Zodic_sign,
                    "height"=>$val->height,
                    "gender"=>$val->gender,
                    "profile_path"=>$val->profile_path,
                    "state"=>$val->state,
                    "preferences"=>$question_answers,
                );  
        }
          if(!empty($dataArray))
          {
          $status = 200;
          $data = array(
            'success' => true,
            'message' => 'Profile data',
            'data' => $dataArray,
          );
          }
          else
          {
          $status = 500;
          $data = array(
            'success' => false,
            'message' => 'Something went wrong',
            'data' => [],
          );
          }
          return response()->json($data,$status);
}

public function getOtherUserData(Request $request)
{
    $logedinUserData = User::where('id', Auth::id())->get();
    foreach ($logedinUserData as $row) {
        $logedinQuestions = json_decode($row->userQA, true);
    }

    $userData = User::where('id', $request->user_id)->get();
    $dataArray = [];
    foreach ($userData as $val) {
        $questions = json_decode($val->userQA, true);
        $question_answers = [];
        $matchedCount = 0;
        if (isset($questions)) {
            foreach ($questions as $question) {
                $questionID = $question['questionID'];
                $selectedOptionsID = $question['selectedOptionsID'];
                $question_statement = Category_Question::where('id', $questionID)->get();
                $answer_statement = [];
                foreach ($selectedOptionsID as $option_id) {
                    $answer = CategoryAnswer::where('id', $option_id)->first();
                    if ($answer) {
                        $answer->is_matched = $this->isAnswerMatched($logedinQuestions, $questionID, $answer->id);
                        // $answer->is_tested = 'testing'; //add new indexes same like this.
                        $answer_statement[] = $answer;
                        $matchedCount += $answer->is_matched;
                    }
                }
                $question_answers[] = [
                    'question_statement' => $question_statement,
                    'answer_statement' => $answer_statement
                ];
            }
        }
        $val->total_matched = $matchedCount;
        $val->preferences = $question_answers;
        $dataArray[] = $val;
    }

    if(!empty($dataArray))
          {
          $status = 200;
          $data = array(
            'success' => true,
            'message' => 'Other user data',
            'data' => $dataArray,
          );
          }
          else
          {
          $status = 500;
          $data = array(
            'success' => false,
            'message' => 'Something went wrong',
            'data' => [],
          );
          }
          return response()->json($data,$status);
}

private function isAnswerMatched($logedinQuestions, $questionID, $answerID)
{
    foreach ($logedinQuestions as $logedinQuestion) {
        if ($logedinQuestion['questionID'] == $questionID) {
            $selectedOptionsID = $logedinQuestion['selectedOptionsID'];
            if (in_array($answerID, $selectedOptionsID)) {
                return 1;
            }
        }
    }
    return 0;
}

public function usersList()
{
    $data['nav'] = 'users';
    return view('users',$data);
}

public function usersTableList()
{
    $query['data'] = User::orderBy('id','desc')->where('admin_type',null)->get();
    return response()->json(['data' => $query['data']]);
}

public function editUser(Request $request)
{  
    $update = User::where('id',$request->input('id'))->update([
        'subsc_package' => $request->input('subsc_package'),
    ]);
    if($update)
    {
        $arr = array("sucesss"=>'200' ,'message' => 'Subscription package successfully updated');
    }
    else
    {
        $arr = array( "sucesss"=>'400' ,'message' => 'Opps error');
    }

    return json_encode($arr);     
}


}
?>