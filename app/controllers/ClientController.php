<?php

use Illuminate\Database\Eloquent\ModelNotFoundException;

class ClientController extends BaseController {
	public function add()
	{
		
		//return $this->amount();

		return View::make('clients.create')
						->with('total',$this->amount())
						->with('title', 'Activate Pin');
	}

	public function doAdd(){

		$rules = array
		(
	    	'pin'	=>	'required'
		);
		$validation = Validator::make(Input::all(), $rules);
		
		if($validation->fails())
			return Redirect::back()
								->withInput()
								->withErrors($validation);
		else
		{
			$findPin = Pin::where('pin','=',Input::get('pin'))
				->where('status','=',1)
				->first();
			//echo empty($findPin);
			if(!empty($findPin)){
				Asset::create(
				['client_id'=> Auth::user()->id,
					'distributor_id'=> $findPin->distributor_id,
					'money' => $findPin->amount,
					'pin'=> $findPin->pin]
				);
				$pinUpdate = ['status'=>0,'client_id'=>Auth::user()->id];
				Pin::find($findPin->id)->update($pinUpdate);
				return Redirect::route('client.add')
			    					->with('success', "Pin Activated successfully.");
			}
			else
				return Redirect::back()->withInput()->withErrors($validation)->with('error', 'Invalid Pin. Try again.');

						

		}
	}

	private function amount()
	{
		$findClient = Asset::where('client_id','=',Auth::user()->id)->get();
		$total = 0;
		foreach ($findClient as $client) {
			$total += $client->money;
		}

		return $total;
	}



}
