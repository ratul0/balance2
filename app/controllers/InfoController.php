<?php

class InfoController extends \BaseController {

	/**
	 * Display a listing of the resource.
	 * GET /info
	 *
	 * @return Response
	 */
	public function index()
	{
		//
	}

	/**
	 * Show the form for creating a new resource.
	 * GET /info/create
	 *
	 * @return Response
	 */
	public function create($id)
	{
		return View::make('info.create')
						->with('user_id',$id)
						->with('title', 'Add Personal Info');
	}

	/**
	 * Store a newly created resource in storage.
	 * POST /info
	 *
	 * @return Response
	 */
	public function store()
	{
		$rules = [
			'title'				=>	'required',
			'first_name'       =>	'required',
			'last_name'        =>	'required',
			'gender' 		   =>	'required',
			'picture'         =>	'image|mimes:jpeg,bmp,png',
			'date_of_birth'   =>	'required|date',
			'address' 			=> 'required',
			'country' 			=> 'required',
		];

		$validation = Validator::make(Input::all(), $rules);
		
		if($validation->fails())
			return Redirect::back()
								->withInput()
								->withErrors($validation);

		else
		{
			$info            = new Info();
			$info->title = Input::get('title');
			$info->first_name = Input::get('first_name');
			$info->last_name = Input::get('last_name');
			$info->gender     = Input::get('gender');
			$info->date_of_birth   = Input::get('date_of_birth');
			$info->address     = Input::get('address');
			$info->country   = Input::get('country');
			$info->user_id   = Input::get('user_id');

			if (Input::hasFile('picture')) {
			        $file            = Input::file('picture');
			        $destinationPath = public_path().'/img/profile_picture';
			        $filename        = Input::get('first_name').".".$file->getClientOriginalExtension();
			        $uploadSuccess   = $file->move($destinationPath, $filename);
			        $info ->url = Input::get('first_name').".".$file->getClientOriginalExtension();
			        
			    }

			    
			if($info->save())
			{

				// if picture is uploaded...

				User::find(Input::get('user_id'))->update(['first_login'=>1]);
			    return Redirect::to('/')
			    					->with('success', "Information added successfully.");
			}
			else
				return Redirect::back()
									->withInput()
									->with('error', 'Some error occured. Try again.');
		}
	}

	/**
	 * Display the specified resource.
	 * GET /info/{id}
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id)
	{
		$profile = Info::where('user_id','=',$id)->first();
		return View::make('info.show')
						->with('user_id',$id)
						->with('profile',$profile)
						->with('title', 'Show Personal Info');
	}

	/**
	 * Show the form for editing the specified resource.
	 * GET /info/{id}/edit
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
		$profile = Info::where('user_id','=',$id)->first();
		return View::make('info.edit')
						->with('user_id',$id)
						->with('profile',$profile)
						->with('title', 'Edit Personal Info');
	}

	/**
	 * Update the specified resource in storage.
	 * PUT /info/{id}
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id)
	{
		$rules = [
			'title'				=>	'required',
			'first_name'       =>	'required',
			'last_name'        =>	'required',
			'gender' 		   =>	'required',
			'picture'         =>	'image|mimes:jpeg,bmp,png',
			'date_of_birth'   =>	'required|date',
			'address' 			=> 'required',
			'country' 			=> 'required',
		];

		$validation = Validator::make(Input::all(), $rules);
		
		if($validation->fails())
			return Redirect::back()
								->withInput()
								->withErrors($validation);

		else
		{

			
		
			
			$url = "";
			if (Input::hasFile('picture')) {
			        $file            = Input::file('picture');
			        $destinationPath = public_path().'/img/profile_picture';
			        $filename        = Input::get('first_name').".".$file->getClientOriginalExtension();
			        $uploadSuccess   = $file->move($destinationPath, $filename);
			        $url = Input::get('first_name').".".$file->getClientOriginalExtension();
			        
			    }

			    $infoUpdate = [
					'title' => Input::get('title'),
					'first_name' => Input::get('first_name'),
					'last_name' => Input::get('last_name'),
					'gender'     => Input::get('gender'),
					'date_of_birth'   => Input::get('date_of_birth'),
					'address'     => Input::get('address'),
					'country'   => Input::get('country'),
					'user_id'   => Input::get('user_id'),
					'url'   => $url
				];

			    
			if(Info::where('user_id','=',Input::get('user_id'))->update($infoUpdate))
			{

				// if picture is uploaded...

				
			    return Redirect::to('/')
			    					->with('success', "Information added successfully.");
			}
			else
				return Redirect::back()
									->withInput()
									->with('error', 'Some error occured. Try again.');
		}
	}

	/**
	 * Remove the specified resource from storage.
	 * DELETE /info/{id}
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
		//
	}

}