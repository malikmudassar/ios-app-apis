<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\User;
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


}
?>