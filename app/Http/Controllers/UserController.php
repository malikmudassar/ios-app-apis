<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\{User,Category_Question,CategoryAnswer,Verification,Country};
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Carbon\Carbon;
use App\Services\FCMService;
use DB;
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
            'gender' => 'required',
            'country' => 'required'
        ],
        [
          'fname.required'  => 'Please enter first name',
          'age.required'  => 'Please enter age',
          'birth_month.required'  => 'Please enter birth month',
          'birth_day.required'  => 'Please enter birth day',
          'height.required'  => 'Please enter height',
          'gender.required'  => 'Please enter gender',
          'country.required'  => 'Please select country',
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
            'country_id' => $request->country,
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
                    "country"=>$this->getUserCountries($val->country_id),
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

public function userVerification(Request $request)
{
       $validator = Validator::make($request->all(), 
        [
            'method' => 'required',
            'image' => 'required'
        ],
        [
          'method.required'  => 'Please enter method',
          'image.required'  => 'Please upload photo',
        ]);
        if ($validator->fails()) 
        {
    		return response()->json(["validateErrorList" => $validator->messages()],422);
        }
        else
        {
            $data = new Verification;
            if (@$_FILES['image']['name']) {
                $temp = explode('.', $_FILES['image']['name']);
                $extension = end($temp);
                $path = '../public/apiAssets/userVerifactions/';
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
                $savePath = url('/').'/apiAssets/userVerifactions/'.$image;
                $data->image = $savePath;
                $data->method = $request->input('method');
                $data->user_id = Auth::id();
                $data->save();
                if($data->save())
                {
                $status = 200;
                $data = array(
                    'success' => true,
                    'message' => 'User verification request sent',
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

public function userVerificationList()
{
    $data['nav'] = 'user_verification';
    return view('user_verification',$data);
}

public function usersVerificationTableList()
{
    $query['data'] = Verification::join('users', 'users.id', '=', 'user_verification.user_id')->orderBy('user_verification.id','desc')->get();
    return response()->json(['data' => $query['data']]);
}

public function isverified(Request $request)
{  
    $status = $request->input('status');
    $user_id = $request->input('user_id');
    if($status=='true')
    {
        $session = session();
        $update = Verification::where('user_id',$request->input('user_id'))->update([
            'verified_at' => Carbon::now(),
            'verified_by' => $session->get('id'),
        ]);
        $update = User::where('id',$request->input('user_id'))->update([
            'is_verified' => 1,
        ]);
        $msg = 'User verified successfully';
    }
    else
    {
        $update = Verification::where('user_id',$request->input('user_id'))->update([
            'verified_at' => null,
            'verified_by' => null,
        ]);
        $update = User::where('id',$request->input('user_id'))->update([
            'is_verified' => 0,
        ]);
        $msg = 'User unverified again';
    }
    if($update)
    {
        $arr = array("sucesss"=>'200' ,'message' => $msg);
    }
    else
    {
        $arr = array( "sucesss"=>'400' ,'message' => 'Opps error');
    }

    return json_encode($arr);     
}


public function testNotification(Request $request)
{
    $user = User::findOrFail(Auth::id());
    FCMService::send(
        $user->device_id,
        [
            'title' => $request->title,
            'body' => $request->body,
        ]
    );
    return response()->json([
        'message' => 'Notification sent successfully',
    ]);
}

public function getUserCountries($country_ids)
{
    $array = explode(',', $country_ids);
    $countries = Country::whereIn('country_id',$array)->get();
    return $countries;
}

public function searchFilter(Request $request)
{
    $age = $request->age;
    $country = $request->country;
    $height = $request->height;
    $occupation = $request->occupation;
    $lat_lng_from = $request->lat_lng_from;
    $lat_lng_to = $request->lat_lng_to;
    //query
    $query = "SELECT * FROM users WHERE";
    //age search
    if (isset($age) && strpos($age, ',') !== false) 
    {
        $ageArray = explode(',', $age);
        $query .= " age BETWEEN $ageArray[0] AND $ageArray[1]";
    }
    else
    {
        $query .= " age LIKE '%".$age."%'"; 
    }
    //height search
    if (isset($height) && strpos($height, ',') !== false) 
    {
        $heightArray = explode(',', $height);
        $query .= " AND height BETWEEN $heightArray[0] AND $heightArray[1]";
    }
    else
    {
        $query .= " AND height LIKE '%".$height."%'";
    }
    //occupation search
    if(isset($occupation))
    {
        $occupationArray = explode(',', $occupation);
        $occupationList = "'" . implode("', '", $occupationArray) . "'";
        $query .= " AND occupation IN ($occupationList)";
    }
    //country search
    if(isset($country))
    {
        $query .= " AND country_id IN (".$country.")";
    }
    //lat lng search
    if(isset($lat_lng_from) && isset($lat_lng_to))
    {
        $latFrom = explode(',', $lat_lng_from)[0];
        $lngFrom = explode(',', $lat_lng_from)[1];
        $latTo = explode(',', $lat_lng_to)[0];
        $lngTo = explode(',', $lat_lng_to)[1];
        $query .= " AND lat BETWEEN $latFrom AND $latTo
        AND lng BETWEEN $lngFrom AND $lngTo";
    }
    $query .= " AND id !='".Auth::id()."' AND is_verified=1 ORDER BY created_at DESC";
    // echo "query :".$query;die();
    $dataArr = DB::select($query);
    if(!empty($dataArr))
    {
        foreach($dataArr as $val)
        {
        $dataArray[] = array(
            "id"=>$val->id,
            "fname"=>$val->fname,
            "lng"=>$val->lng,
            "gender"=>$val->gender,
            "height"=>$val->height,
            "occupation"=>$val->occupation,
            "profile_path"=>$val->profile_path,
            "age"=>$val->age,
            "lat"=>$val->lat,
            "country"=>$this->getUserCountries($val->country_id),
        ); 
    }
    }
    else
    {
        $dataArray = []; 
    }
        if(!empty($dataArray))
          {
          $status = 200;
          $data = array(
            'success' => true,
            'resultsCount' => count($dataArray),
            'message' => 'Search results',
            'data' => $dataArray,
          );
          }
          else
          {
          $status = 500;
          $data = array(
            'success' => false,
            'message' => 'No data available',
            'data' => [],
          );
          }
          return response()->json($data,$status);
    }

}
?>