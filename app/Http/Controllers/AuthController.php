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
        $validator = Validator::make($request->all(), 
        [
            'provider' => 'required',
            'account' => 'required',
            'device_id' => 'required'
        ],
        [
            'provider.required'  => 'Please enter provider',
            'account.required'  => 'Please enter account',
            'device_id.required'  => 'Please enter device_id',
        ]);
        
        if ($validator->fails()) 
        {
    		return response()->json(["validateErrorList" => $validator->messages()],422);
        }
        else
        {
            $check = User::where('account',$request->account)->get();
            if($check->isEmpty())
            {
                $user = User::create([
                    'provider' => $request->provider,
                    'password' => Hash::make('12345'),
                    'device_id' => $request->device_id,
                ]);
                $lastInsertedId = $user->id;
                User::where('id',$lastInsertedId)->update(['account'=>$request->account]);
            }
            else
            {
                User::where('account',$request->account)->update(['device_id'=>$request->device_id]);
            }
            $credentials = $request->only('account');
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