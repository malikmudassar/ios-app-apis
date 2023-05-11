<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\{Category,Question,Language,User};
class DashboardController extends Controller
{
    public function index(Request $request)
    {
        $data['nav'] = 'dashboard';
        $data['categoriesCounter'] = Category::count();
        $data['questionsCounter'] = Question::count();
        $data['languagesCounter'] = Language::count();
        $data['usersCounter'] = User::count();
        return view('dashboard',$data);
    }


}
?>