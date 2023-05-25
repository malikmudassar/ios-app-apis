<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\{Invites};
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
class InvitesController extends Controller
{
    public function sendInvites(Request $request)
    {
        $query = Invites::create([
            'from_user' => Auth::id(),
            'to_user' => $request->to_user,
            'spot_id' => $request->spot_id,
        ]);
        if($query)
        {
        $status = 200;
          $data = array(
            'success' => true,
            'message' => 'Invite sent successfully',
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

public function getInvites()
{
        $getInvites = Invites::with('spot:id,name','user:id,fname,profile_path')->where('to_user', Auth::id())->get();
        if(!$getInvites->isEmpty())
        {
        $status = 200;
          $data = array(
            'success' => true,
            'message' => 'Invites list',
            'data' => $getInvites,
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

public function acceptInvite($invite_id)
{
        $query = Invites::where('invite_id',$invite_id)->update([
            'is_accepted' => 1,
        ]);
        if($query)
        {
        $status = 200;
          $data = array(
            'success' => true,
            'message' => 'Invite accepted successfully',
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


}
?>