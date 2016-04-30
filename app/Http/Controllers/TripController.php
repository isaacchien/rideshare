<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use Auth;
use Validator;
use App\Services\API\GoogleDirections;
use Cache;

class TripController extends Controller
{
    public function rides(){
		$trips = \App\Trip::all();

		return view('rides', [
			"trips" => $trips
		]);
    }
    public function search(Request $request){

        $origin = $request->input('origin');
        $destination = $request->input('destination');

        if (empty($origin) && empty($destination)){
            $result = \App\Trip::all();
        }
        else if (empty($origin)){
            $result = \App\Trip::where('destination', 'LIKE', "%$destination%")->get();
        } else if (empty($destination)) {
            $result = \App\Trip::where('origin', 'LIKE', "%$origin%")->get();
        } else {
            $result = \App\Trip::where('origin', 'LIKE', "%$origin%")
            ->where('destination', 'LIKE', "%$destination%")
            ->get();
        }
        return view('rides', [
            "trips" => $result
        ]);

    }
    public function join(Request $request){

    	$trip_id = $request->input('id');
        $user = Auth::user();
        $user_id = $user->id;

		$exists = $user->trips->contains($trip_id);

        $validation = Validator::make($request->all(), [
            'id' => 'required|integer'
        ]);

        if ($exists) {
            return redirect('trips')
                ->withErrors(array('message' => 'You have already joined this ride.'));
        }

        if ($validation->fails()) {
            return redirect('trips')
                ->withErrors($validation);
        }

    	$trip = \App\Trip::find($trip_id);
    	$trip->users()->attach($user);

    	return redirect('home')->with('success', true);
    }
    public function route(Request $request){
    	$trip_id = $request->input('id');
    	$trip = \App\Trip::find($trip_id);
 		$origin = $trip->origin;
 		$destination = $trip->destination;


        if (Cache::get($trip_id)){
            $response = Cache::get($trip_id);
        } else {
            $googledirections = new GoogleDirections([
              'key' => 'AIzaSyC8Hv_-vtJajMaLtfEKBINQL9gul_ZQu1U'
            ]);
	        $response = $googledirections->route($trip_id);
            if (empty($response)){
				return redirect('home')->withErrors(['msg', 'Cannot find route from given origin to destination.']);
            }
	            $response = $googledirections->route($trip_id);

	            Cache::put($trip_id, $response, 60);
        }

	    return view('googledirections', [
	    	"origin" => $origin,
	    	"destination" => $destination,
            "steps" => $response["routes"][0]["legs"][0]["steps"]
	    ]);
    }
    public function delete(Request $request) {
        $trip_id = $request->input('trip_id');
        $trip = \App\Trip::find($trip_id);

        $user = Auth::user();
        if ($user->id === $trip->driver_id){
            $trip->users()->detach();
            $trip->delete();
        } else {
            $trip->users()->detach($user->id);
        }
        return redirect('home');

    }
}
