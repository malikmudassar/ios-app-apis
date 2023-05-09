<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\User;
class LoginController extends Controller
{
    public function index(Request $request)
    {
        return view('login');
    }
    
    public function adminLogin(Request $request)
    {
        $email = $request->input('email');
        $password = $request->input('password');
        $verify=User::where('account',$email)->where('admin_type','admin')->get();
        if(!$verify->isEmpty() && hash('md5', $password) == $verify[0]->password)
        {
            $session = session();
            $session->put('id', $verify[0]->id);
            $session->put('fname', $verify[0]->fname);
            $session->put('account', $verify[0]->account);
            $session->put('admin_type', $verify[0]->admin_type);

            $arr = array( "sucesss"=>'200' ,'message' => 'login successfully');
        }
        else
        {
            $arr = array( "sucesss"=>'400' ,'message' => 'Invalid email or password');
        }
        return json_encode($arr);
    }

    public function logout()
    {
        session()->flush();
        return redirect('/');
    }

    
}
?>