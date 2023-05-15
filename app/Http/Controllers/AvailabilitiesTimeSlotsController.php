<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\{TimeSlots,Spot,Availability};
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
class AvailabilitiesTimeSlotsController extends Controller
{
    
public function getAvailabilitiesTimeSlots()
{  
    $getAvailabilitiesTimeSlots = TimeSlots::get();
    if(!empty($getAvailabilitiesTimeSlots))
    {
    $status = 200;
    $data = array(
    'success' => true,
    'message' => 'Availabilities time slots data',
    'data' => $getAvailabilitiesTimeSlots,
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

public function spotsAvailabilities(Request $request)
{  
   $validator = Validator::make($request->all(), 
        [
            'spot_name' => 'required',
            'lat' => 'required',
            'lng' => 'required',
            'date' => 'required',
            'time_slot_id' => 'required'
        ],
        [
          'spot_name.required'  => 'Please enter spot name',
          'lat.required'  => 'Please enter latitude',
          'lng.required'  => 'Please enter longitude',
          'date.required'  => 'Please enter date',
          'time_slot_id.required'  => 'Please enter time slot',
        ]);
        if ($validator->fails()) 
        {
    		return response()->json(["validateErrorList" => $validator->messages()],422);
        }
        else
        {
            $isSpotAvailable = Spot::where([
                'name' => $request->spot_name,
                'latitude' => $request->lat,
                'longitude' => $request->lng
            ])->first();
            if($isSpotAvailable !== null) 
            {
                $query = Availability::where('id',$isSpotAvailable->id)->update([
                    'date' => $request->date,
                    'time_slot' => $request->time_slot_id,
                ]);
                $msg = 'Spots availabilities updated successfully';
            }
            else
            {
                $query = Spot::create([
                    'name' => $request->spot_name,
                    'latitude' => $request->lat,
                    'longitude' => $request->lng,
                ]);
                $lastInsertedId = $query->id;
            }
            
                if(isset($lastInsertedId))
                {
                    $availabilites = Availability::create([
                        'user_id' => Auth::id(),
                        'spot_id' => $lastInsertedId,
                        'date' => $request->date,
                        'time_slot' => $request->time_slot_id,
                    ]);
                   $msg = 'Spots availabilities created successfully';
                }

                if($query)
                {
                $status = 200;
                $data = array(
                    'success' => true,
                    'message' => $msg,
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


public function checkAvailability(Request $request)
{  
    $validator = Validator::make($request->all(), 
        [
            'date' => 'required'
        ],
        [
          'date.required'  => 'Please enter date',
        ]);
        if ($validator->fails()) 
        {
    		return response()->json(["validateErrorList" => $validator->messages()],422);
        }
        else
        {
            $checkAvailability = Availability::where('user_id',Auth::id())->where('date',$request->query('date'))->first();
            if($checkAvailability !== null) 
            {
                $status = 200;
                        $data = array(
                            'success' => true,
                            'time_slot_id' => $checkAvailability->time_slot,
                            'message' => 'Availabilities already exists',
                        );
            }
            else
            {
                $status = 500;
                        $data = array(
                            'success' => false,
                            'time_slot_id' => null,
                            'message' => 'Availabilities does not exist',
                        );
            }
              return response()->json($data,$status);
        }
    
   
}


}
?>