<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\Country;
class CountryController extends Controller
{
    public function index(Request $request)
    {
        return view('country');
    }
    public function countryTableList()
{
    $query['data'] = Country::get();
    return response()->json(['data' => $query['data']]);
}

public function addEditCountry(Request $request)
   {
    $data = new Country;
    $data->country = $request->input('country');
    if($request->input('country_id') >0)
    {
        $update = Country::where('country_id',$request->input('country_id'))->update([
            'country' => $request->input('country'),
        ]);
        if($update)
        {
            $arr = array("sucesss"=>'200' ,'message' => 'Country successfully updated');
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
            $arr = array( "sucesss"=>'200' ,'message' => 'Country successfully added');
        }
        else
        {
            $arr = array( "sucesss"=>'400' ,'message' => 'Opps error');
        }
    }
        return json_encode($arr);     
    }

}
?>