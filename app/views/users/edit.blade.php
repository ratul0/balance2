@extends('layouts.default')

@section('content')
	<div class="col-md-5 col-md-offset-3">
		<div class="page-header">
			<h2>{{ $title }}</h2>
		</div>

      	{{Form::open(array('route' => 'user.update','method' => 'PUT'))}}


      	@include('includes.alert')
	      	<div class="form-group">
		          	{{ Form::label('username', 'User Name *') }}
		          	{{ Form::text('username', $user->user_name, array('class' => 'form-control')) }}
		          	{{$errors->first('username')}}
		    </div>



	        <div class="form-group">
	          	{{ Form::label('password', 'New Password *') }}
	          	
	          	{{ Form::password('password', array('class' => 'form-control')) }}
	          	{{$errors->first('password')}}
	        </div>

	        <div class="form-group">
	          	{{ Form::label('password_confirmation', 'Confirm Password *') }}
	          	
	          	{{ Form::password('password_confirmation', array('class' => 'form-control')) }}
	          	{{$errors->first('password_confirmation')}}
	        </div>


      	


      	{{ Form::submit('Update',array('class' => 'btn btn-primary btn-lg', 'data-loading-text' => 'Updating Cridentials...')) }}

      	{{ Form::close() }}

@stop