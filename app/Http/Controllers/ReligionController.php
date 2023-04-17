<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\Religion;
class ReligionController extends Controller
{
    public function index(Request $request)
    {
        $data['nav'] = 'religion';
        return view('religion',$data);
    }
    public function religionTableList()
    {
        $query['data'] = Religion::orderBy('religion_id','desc')->get();
        return response()->json(['data' => $query['data']]);
    }

    public function addEditReligion(Request $request)
    {
        $data = new Religion;
        $data->religion = $request->input('religion');
        if($request->input('religion_id') >0)
        {
            $update = Religion::where('religion_id',$request->input('religion_id'))->update([
                'religion' => $request->input('religion'),
            ]);
            if($update)
            {
                $arr = array("sucesss"=>'200' ,'message' => 'Religion successfully updated');
            }
            else
            {
                $arr = array( "sucesss"=>'400' ,'message' => 'Opps error');
            }
        }
        else
        {
            $data->save();
            if($data->save() > 0){
                $arr = array( "sucesss"=>'200' ,'message' => 'Religion successfully added');
            }
            else
            {
                $arr = array( "sucesss"=>'400' ,'message' => 'Opps error');
            }
        }
            return json_encode($arr);     
        }

        public function deleteReligionAction(Request $request)
        {
        $query=Religion::where('religion_id',$request->input('religion_id'))->delete();
        if($query)
        {
            $arr = array( "sucesss"=>'200' ,'message' => 'Religion successfully deleted'); 
        }
        else
        { 
            $arr = array( "sucesss"=>'400' ,'message' => 'Opps error');
        }
        return json_encode($arr);
        }
}
?>