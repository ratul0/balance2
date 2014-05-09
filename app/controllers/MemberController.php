<?php

use Illuminate\Database\Eloquent\ModelNotFoundException;

class MemberController extends BaseController {


	private function getDistributorId(){
		$distributors = User::where('role_id', '=', 2)->get();

		$store = array();
		
		foreach ($distributors as $distributor) {
			$store[$distributor->id] = $distributor->email;


		}

		return $store;
	}

	function generatePin( $number ) {
		/*$chars = "abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789";	
		$pins = array();
		$size = strlen( $chars );
		for ($j=0; $j < $number; $j++) { 
			$str = "";
			for( $i = 0; $i < $length; $i++ ) {
				$str .= $chars[ rand( 0, $size - 1 ) ];	
			}

			$pins[$j] = $str;
			
		}*/
		$pins = array();
		for ($j=0; $j < $number; $j++) { 
			$string = str_random(15);
			$pin = Pin::where('pin', '=', $string)->first();
			if($pin){
				$j--;
			}else{
				$pins[$j] = $string;
			}
		}



		return $pins;
	}

	/**
	 * View all members
	 * @return void
	 */
	public function index()
	{
		$members = User::Where('varification_status','=',1)
						->Where('distributor_status','=',1)
						->Where('distributor_approve','=',0)
						->paginate(10);

		return View::make('members.index')
						->with('title', 'View All members')
						->with('members', $members);
	}

	public function doRegister($id)
	{




			if(User::find($id)->update(['distributor_approve'=>1])){

				return Redirect::route('home')
			    					->with('success', "Member Added Sussessfully.");
			}
			    
			else
				return Redirect::route('home')
			    					->with('error', 'Some error occured. Try again.');
				
	}
	/**
	 * Delete a page
	 * @param  string $pageUrl
	 * @return void
	 */
	public function delete($id)
	{
		$member = User::where('id', '=', $id);
		if($member->delete())
			return Redirect::route('members')
								->with('success', "The member has been deleted.");
		else
			return Redirect::route('members')
								->with('errors', 'Some error occured. Try again.');
	}

	public function userDelete($id){
		$member = User::where('id', '=', $id);
		if($member->delete())
			return Redirect::route('home')
								->with('success', "The member has been deleted.");
		else
			return Redirect::route('home')
								->with('errors', 'Some error occured. Try again.');
	}

	public function pin(){

		return View::make('pins.create')
			->with('title','Generate Pin');
		//return dd($this->generatePin(2,20));

	}

	public function doPin(){

		$rules = array
		(
	    	'amount'	=>	'required|Numeric',
			'number'	=>	'required|Numeric',
			'category'	=>	'required|unique:groups'
			

		);
		$validation = Validator::make(Input::all(), $rules);
		
		if($validation->fails())
			return Redirect::route('pin')
								->withInput()
								->withErrors($validation);
		else
		{

			$data = $this->generatePin(Input::get('number'));
			
			$pin = new Pin;
			$amount = Input::get('amount');
			$category = Input::get('category');
			Group::create(['category'=>$category,'amount'=>Input::get('number')]);
			foreach ($data as $value) {


				Pin::create(['amount'=>$amount,'pin'=>$value,'category'=>$category]);
				$flag = 1;
			}

			if($flag)
			    return Redirect::route('pin')
			    					->with('success', "Pins Created successfully.");
			else
				return Redirect::back()->withInput()->withErrors($validation)->with('error', 'Some error occured. Try again.');

						

		}
	}

	/*public function showActivePins(){

		$pins = Pin::paginate(10);

		

		return View::make('pins.show')
			->with('pins',$pins)
			->with('title','View Active Pins');
	}*/

	public function showUsedPin(){

		$pins = Pin::where('status','=',0)->paginate(10);

		

		return View::make('pins.used')
			->with('pins',$pins)
			->with('title','View Used Pins');
	}

	public function showAllActivePinGroup(){
		$groups = Group::paginate(10);

		

		return View::make('pins.showgroups')
			->with('groups',$groups)
			->with('title','View Active Pins Groups');
	}


	public function viewPin($id){

		$group = Group::where('id', '=', $id)->first();
		if(! is_null($group->category)){
			$pin = Pin::where('category','=',$group->category)->paginate(10);
		}
		
		return View::make('pins.viewgroup')
			->with('group',$group)
			->with('pins',$pin)
			->with('distributors',$this->getDistributorId())
			->with('title','View Pin');
	}


	public function viewDistributor(){
		$members = User::where('role_id', '=', 2)->paginate(10);
		return View::make('members.distributor')
						->with('members', $members)
						->with('title', "View All Distributors");
	}


	public function viewClient(){

		$members = User::where('role_id', '=', 3)->paginate(10);
		return View::make('members.client')
						->with('members', $members)
						->with('title', "View All Clients");
	}

	public function assignPin(){
		$pinId = Input::get('pin_id');
		$rules = array
		(
	    	'member'	=>	'required|Numeric'
		);
		$validation = Validator::make(Input::all(), $rules);
		
		if($validation->fails())
			return Redirect::back()
								->withInput()
								->withErrors($validation);
		else
		{

			$groupUpdate = ['distributor_id'=>Input::get('member')];
			$group = Group::where('id','=',$pinId)->first();

			Group::find($pinId)->update($groupUpdate);
			if(Pin::where('category','=',$group->category)->update($groupUpdate))
			    return Redirect::route('pin')
			    					->with('success', "Pins Assigned successfully.");
			else
				return Redirect::back()->withInput()->withErrors($validation)->with('error', 'Some error occured. Try again.');

						

		}
	}

	public function deletePin($id)
	{
		$pin = Pin::where('id', '=', $id);
		if($pin->delete())
			return Redirect::route('pin.showgroups')
								->with('success', "Pin has been deleted.");
		else
			return Redirect::route('home')
								->with('errors', 'Some error occured. Try again.');
	}

	public function deleteGroup($id)
	{
		$group = Group::where('id','=',$id)->first();
		Pin::where('category', '=', $group->category)->delete();
		if(Group::where('id','=',$id)->delete())
			return Redirect::route('pin.showgroups')
								->with('success', "Pin has been deleted.");
		else
			return Redirect::route('pin.showgroups')
								->with('errors', 'Some error occured. Try again.');
	}

}