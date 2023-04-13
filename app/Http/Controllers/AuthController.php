<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use Illuminate\Support\Facades\Validator;

class AuthController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth:api', ['except' => ['login','logout']]);
    }

    public function login(Request $request)
    {
        if($request->source=='google')
        {
            $column = 'email';
            $value = $request->email;

        }
        else
        {
            $column = 'apple_id';
            $value = $request->apple_id;
        }
        $validator = Validator::make($request->all(), 
        [
            $column => 'required'
        ],
        [
            ''.$column.'.required'  => 'Please enter '.$column.''
        ]);
        
        if ($validator->fails()) 
        {
    		return response()->json(["validateErrorList" => $validator->messages()],422);
        }
        else
        {
            $check = User::where($column,$value)->get();
            if($check->isEmpty())
            {
                $user = User::create([
                    'source' => $request->source,
                    'password' => Hash::make('12345'),
                ]);
                $lastInsertedId = $user->id;
                User::where('id',$lastInsertedId)->update([$column=>$value]);
            }
            $credentials = $request->only($column);
            $credentials['password'] = '12345';
            $token = Auth::attempt($credentials);
            if (!$token) {
                return response()->json([
                    'status' => 'error',
                    'message' => 'Unauthorized',
                ], 401);
            }
            $user = Auth::user();
            if(!empty($user))
            {
              $status = 200;
              $data = array(
                'success' => true,
                'message' => 'User loged in successfully',
                'user' => $user,
                'authorisation' => [
                    'token' => $token,
                    'type' => 'bearer',
                ]
              );
             }
            else
            {
              $status = 500;
              $data = array(
                'success' => false,
                'message' => 'Something went wrong'
              );
            }
            return response()->json($data,$status);
        }
    }

    public function logout()
    {
        Auth::logout();
        $status = 200;
        $data = array(
        'success' => true,
        'message' => 'Successfully logged out'
        );
        return response()->json($data,$status);
    }


    public function refresh()
    {
        return response()->json([
            'status' => 'success',
            'user' => Auth::user(),
            'authorisation' => [
                'token' => Auth::refresh(),
                'type' => 'bearer',
            ]
        ]);
    }

}

?>