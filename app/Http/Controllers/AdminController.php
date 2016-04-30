<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use Illuminate\Support\Facades\Redirect;

use Auth;
use DateTime;
use Validator;

class AdminController extends Controller
{
    //

    public function create() {
		return view('create');    
	}

	public function store(Request $request) {
		$user = Auth::user();

		$origin = $request->input('origin');
		$destination = $request->input('destination');
		$date = $request->input('date');
		$time = $request->input('time');

		$datetime = date('Y-m-d H:i:s', strtotime("$date $time"));

		$validation = Validator::make($request->all(), [
    		'origin' => 'required|min:2',
    		'destination' => 'required|min:2',
		]);
		if ($validation->fails()){

			// dd($validation->errors());

			return redirect('admin/create')
                        ->withErrors($validation)
                       	->withInput();
		}
		$trip = new \App\Trip;

		$trip->origin = $origin;

		$trip->destination = $destination;
		$trip->driver_id = $user->id;
		$trip->datetime = $datetime;


		$trip->save();

    	$trip->users()->attach($user);

		return Redirect::to('home')->with('success', true);
	}

}
