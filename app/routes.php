<?php

// for guest only
Route::group(array('before' => 'guest'), function()
{
	Route::get('login', array('as' => 'login', 'uses' => 'UserController@login'));
	Route::post('login', array('uses' => 'UserController@doLogin'));
	Route::get('register', array('as' => 'register', 'uses' => 'UserController@register'));
	Route::post('register', array('uses' => 'UserController@doRegister'));
});

// for any logged in user
Route::group(array('before' => 'auth'), function()
{
	Route::get('cridential',['as'=>'user.update','uses' => 'UserController@edit']);
	Route::put('cridential',['uses' => 'UserController@update']);
	Route::get('logout', array('as' => 'logout', 'uses' => 'UserController@logout'));
});

// for client
Route::group(array('before' => 'auth|client'), function()
{
	Route::get('client', array('as' => 'client.add', 'uses' => 'ClientController@add'));
	Route::post('client', array( 'uses' => 'ClientController@doAdd'));
	
});

// for distributor
Route::group(array('before' => 'auth|distributor'), function()
{
	Route::get('distributor', array('as' => 'distributors', 'uses' => 'DistributorController@index'));
	Route::get('distributor/{id}', array('as' => 'distributors.show', 'uses' => 'DistributorController@show'));
});


// for admin
Route::group(array('before' => 'auth|admin'), function()
{
	// members
	Route::get('members', array('as' => 'members', 'uses' => 'MemberController@index'));
	Route::get('view-distributors', array('as' => 'members.view.distributor', 'uses' => 'MemberController@viewDistributor'));
	Route::get('view-clients', array('as' => 'members.view.client', 'uses' => 'MemberController@viewClient'));
	Route::get('members/add/{id}', array('as' => 'members.add', 'uses' => 'MemberController@doRegister'));
	Route::delete('members/{id}', array('as' => 'members.delete', 'uses' => 'MemberController@delete'));
	Route::delete('view-distributors/{id}', array('as' => 'users.delete', 'uses' => 'MemberController@userDelete'));
	Route::delete('view-clients/{id}', array('as' => 'users.delete', 'uses' => 'MemberController@userDelete'));

	//pins
	Route::get('pin', array('as' => 'pin', 'uses' => 'MemberController@pin'));
	Route::post('pin', array('uses' => 'MemberController@doPin'));
	
	Route::get('group', array('as' => 'group'));


	//Route::get('pin/showactivepins', array('as' => 'pin.show', 'uses' => 'MemberController@showActivePins'));
	Route::get('pin/showactivepinsgroups', array('as' => 'pin.showgroups', 'uses' => 'MemberController@showAllActivePinGroup'));
	Route::get('pin/showusedpin', array('as' => 'pin.used', 'uses' => 'MemberController@showUsedPin'));
	Route::get('pin/show/{id}', array('as' => 'pin.view', 'uses' => 'MemberController@viewPin'));
	Route::post('pin/assign', array('as' => 'pin.assign', 'uses' => 'MemberController@assignPin'));
	Route::delete('pin/{id}', array('as' => 'pin.delete', 'uses' => 'MemberController@deletePin'));
	Route::delete('group/{id}', array('as' => 'group.delete', 'uses' => 'MemberController@deleteGroup'));

});



// public pages [ keep them at last]
Route::get('/', array('as' => 'home', 'uses' => 'UserController@show'));


Route::get("sendmail/{key}",['as'=>'mail.varification','uses'=>'UserController@varifyMail']);



