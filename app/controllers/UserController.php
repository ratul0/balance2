<?php

class UserController extends BaseController {


	private function varify($email){
		$varify = User::where('email','=',$email)->first();
		if(! is_null($varify)){
			if($varify->role_id==2){
				return $varify->distributor_approve & $varify->varification_status;
			}else{
				return $varify->varification_status;
			}
			
		}else{
			return 0;
		}
	}

	/**
	 * login page
	 * @return void
	 */
	public function login()
	{
		return View::make('users.login')
						->with('title', 'Log in');
	}

	/**
	 * process to login a user
	 * @return void
	 */
	public function doLogin()
	{
		$rules = array
		(
	    	'email' 	=> 'required|email',
	    	'password' 	=> 'required'
		);
		$validation = Validator::make(Input::all(), $rules);
		
		if($validation->fails())
			return Redirect::route('login')
								->withInput()
								->withErrors($validation);
		else
		{
			$credentials = array
			(
				'email'		=>	Input::get('email'),
				'password'	=>	Input::get('password')
			);

			if($this->varify(Input::get('email')) && Auth::attempt($credentials))
			{
				Session::put('role', Auth::user()->role_id);
				
				//return User::where('id','=',Auth::user()->id)->first();
				if(User::where('id','=',Auth::user()->id)->first()->first_login == 0){
					
					return Redirect::route('info.create',[Auth::user()->id]);
				}
				
			    return Redirect::intended('/');
			}
			else
				return Redirect::route('login')
									->withInput()
									->with('error', 'Error in Email Address or Password.');
		}
	}

	/**
	 * logout a user
	 * @return void
	 */
	function logout()
	{
		Auth::logout();
		Session::forget('role');

		return Redirect::route('login')
						->with('success', 'You have been logged out.');
	}

	public function show(){

		if(Auth::check()){
			if(Auth::user()->role_id==1){
				return View::make('public.pages.admin')
						->with('title', "Home");
			}
		}
		return View::make('public.pages.show')
						->with('title', "Home");
	}

	public function register()
	{
		return View::make('users.register')
						->with('title', 'Register');
	}

	public function doRegister()
	{
		//return Input::all();


	
		$rules = array
		(
	    	'username'	=>	'required|min:3|max:15',
	    	'email' 	=> 'required|email|unique:users',
	    	'password' =>'Required|Confirmed',
			'password_confirmation' =>'Required',
			'role'	=>	'Required',
			'agree'	=>	'Required',
			'recaptcha_response_field' => 'required|recaptcha'

		);
		$validation = Validator::make(Input::all(), $rules);
		
		if($validation->fails())
			return Redirect::route('register')
								->withInput()
								->withErrors($validation);
		else
		{
			if(Input::get('role')==3){
				$user = new User;
				$user->user_name      = Input::get('username');
				$user->email      = Input::get('email');
				$user->password      = Hash::make(Input::get('password'));
				$user->role_id        = Input::get('role');
				$code = str_random(25);
				$user->varification_code        = $code;
				$data = ['username'=>Input::get('username'),'code'=>$code];
				Mail::send('emails.validate',$data,function($message){
					$message->to(Input::get('email'))->subject('Please Varify Your Email.');
				});


				if($user->save())
			    return Redirect::route('home')
			    					->with('success', "Varify Your Account.");
			else
				return Redirect::back()->withInput()->withErrors($validation)->with('error', 'Some error occured. Try again.');
			}else{

				$user = new User;
				$user->user_name      = Input::get('username');
				$user->email      = Input::get('email');
				$user->password      = Hash::make(Input::get('password'));
				$user->role_id        = Input::get('role');
				$user->distributor_status = 1;
				$code = str_random(25);
				$user->varification_code        = $code;
				$data = ['username'=>Input::get('username'),'code'=>$code];
				Mail::send('emails.validate',$data,function($message){
					$message->to(Input::get('email'))->subject('Please Varify Your Email.');
				});


				if($user->save())
				    return Redirect::route('home')
				    					->with('success', "Request Send successfully.Please Varify Your Email.");
				else
					return Redirect::back()->withInput()->withErrors($validation)->with('error', 'Some error occured. Try again.');
			}
			

									
		}
	}

	public function edit(){
		return View::make('users.edit')
			->with('title','Update Cridentials')
			->with('user',User::where('id','=',Auth::user()->id)->first());
	}

	public function update(){
		$rules = array
		(
	    	'username'	=>	'required|min:3|max:15',	
	    	'password' =>'Required|Confirmed',
			'password_confirmation' =>'Required'
			

		);
		$validation = Validator::make(Input::all(), $rules);
		
		if($validation->fails())
			return Redirect::back()
								->withInput()
								->withErrors($validation);
		else
		{
			

			$userUpdate = ['user_name' => Input::get('username'),
				'password'=>Hash::make(Input::get('password'))
				];

			

			if(User::find(Auth::user()->id)->update($userUpdate)){

				Auth::logout();
				Session::forget('role');

				return Redirect::route('login')
								->with('success', 'Your Cridentials Have Been Changed.');

			}
			    
			else
				return Redirect::back()->withInput()->withErrors($validation)->with('error', 'Some error occured. Try again.');

									
		}
	}

	public function varifyMail($code){
		if(User::where('varification_code','=',$code)->update(['varification_status'=>1])){
			return Redirect::route('login')
								->with('success', 'Account varified.');
		}else{
			return Redirect::route('login')
								->with('error', 'Varification Failed.Try again');
		}
		
	}

	public function passwordRecover(){
		$rules = array
		(
	    	'email' 	=> 'required|email'

		);

		$validation = Validator::make(Input::all(),$rules);

		if($validation->fails()){

			return Redirect::route('login')
								->with('error', 'Invalid Email Address. Try again.');

		}else{
			$code = str_random(25);

			$userUpdate = ['recovery_code' => $code];
			User::where('email','=',Input::get('email'))->update($userUpdate);
			$data = ['code'=>$code];
			
			//send mail
			Mail::send('emails.recover',$data,function($message){
					$message->to(Input::get('email'))->subject('Recover Your Account.');
				});
			return Redirect::route('login')
								->with('success', 'Request Send successfully.Please Recover Your Account.');
			//return User::where('email','=',Input::get('email'))->get();
		}


	}

	public function mailRecover($code){
		$user = User::where('recovery_code','=',$code)->first();
		if(! is_null($user)){
			
			Auth::login($user);
			return View::make('users.edit')
				->with('title','Update Cridentials')
				->with('user',User::where('id','=',$user->id)->first());
		}else{
			return Redirect::route('login')
								->with('error', 'Recovery Failed.Try again');
		}
	}


	


}