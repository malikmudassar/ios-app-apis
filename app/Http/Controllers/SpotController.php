<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\Spot;
use Illuminate\Support\Facades\Validator;

class SpotController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function getSpotsWithinRadius(Request $request)
    {
        //echo "I am here";die();
        $validator = Validator::make($request->all(), 
        [
            'latitude' => 'required|numeric',
            'longitude' => 'required|numeric'
        ],
        [
          'latitude.required'  => 'Please enter latitude',
          'longitude.required'  => 'Please enter longitude',
        ]);
        if ($validator->fails()) 
        {
    		return response()->json(["validateErrorList" => $validator->messages()],422);
        }
        else
        {
        // Get input parameters
        $latitude = $request->latitude;
        $longitude = $request->longitude;
        $radius = 25; // in kilometers

        // Perform Haversine query to retrieve spots within radius
        $spots = Spot::select('*')
        ->selectRaw('(6371 * ACOS(
            COS(RADIANS(latitude)) *
            COS(RADIANS(?)) *
            COS(RADIANS(? - longitude)) +
            SIN(RADIANS(latitude)) *
            SIN(RADIANS(?))
        ))) AS distance', [$latitude, $longitude, $latitude])
        ->havingRaw('distance <= ?', [$radius])
        ->orderByRaw('distance', 'asc') // Update to use raw SQL for ORDER BY clause
        ->get();

              $status = 200;
              $data = array(
                'success' => true,
                'message' => 'Spots retrieved successfully',
                'data' => $spots,
              );
              return response()->json($data,$status); 
         }
    }

}
?>
