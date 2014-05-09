<?php

use Illuminate\Database\Eloquent\ModelNotFoundException;

class DistributorController extends BaseController {
	public function index()
	{
		$pins = Pin::where('distributor_id','=',Auth::user()->id)->paginate(10);
		

		return View::make('distributors.index')
						->with('title', 'View All Pins')
						->with('pins', $pins);
	}

	public function show($id){
		$pin = Pin::where('id','=',$id)->first();
		return View::make('distributors.show')
						->with('title', 'Print This Pin')
						->with('pin', $pin->pin);
	}

}