<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
class DashboardController extends Controller
{
    public function index(Request $request)
    {
        $data['nav'] = 'dashboard';
        return view('dashboard',$data);
    }


}
?>