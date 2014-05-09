@extends('layouts.default')

@section('content')
	<div class="col-md-5 col-md-offset-3">
		<div class="page-header">
			<h2>{{ $title }}</h2>
		</div>

      	{{Form::open(array('route' => 'register'))}}


      	@include('includes.alert')
	      	<div class="form-group">
		          	{{ Form::label('username', 'User Name *') }}
		          	{{ Form::text('username', '', array('class' => 'form-control')) }}
		          	{{$errors->first('username')}}
		    </div>

		    <div class="form-group">
		          	{{ Form::label('email', 'Email *') }}
		          	{{ Form::text('email', '', array('class' => 'form-control')) }}
		          	{{$errors->first('email')}}
		    </div>

	        <div class="form-group">
	          	{{ Form::label('password', 'Password *') }}
	          	
	          	{{ Form::password('password', array('class' => 'form-control')) }}
	          	{{$errors->first('password')}}
	        </div>

	        <div class="form-group">
	          	{{ Form::label('password_confirmation', 'Confirm Password *') }}
	          	
	          	{{ Form::password('password_confirmation', array('class' => 'form-control')) }}
	          	{{$errors->first('password_confirmation')}}
	        </div>

	        <div class="form-group">
		          	{{ Form::label('role', 'Want To Register As : *') }}
		          	<br/>
		          	{{ Form::label('role','Distributor') }}
          			{{ Form::radio('role','2') }}
          			<br/>
          			{{ Form::label('role','Client') }}
          			{{ Form::radio('role','3') }}
          			<br/>
		          	{{$errors->first('role')}}
		    </div>
      		
      		<div class="form-group">
      		{{ Form::label('captcha', 'Enter the Captcha *') }}
		 	{{ Form::captcha() }}  
		 	{{$errors->first('captcha')}}
		 	</div>

		 	<div class="form-group">
		 		<span>
		 		{{Form::checkbox('agree', null)}}
		 		{{ Form::label('agree', 'I agree to the Application Terms of Service  and Privacy Policy.') }}
		 		</span>
		 		{{$errors->first('agree')}}
		 	</div>

      	{{ Form::submit('register',array('class' => 'btn btn-primary btn-lg', 'data-loading-text' => 'Registering User...')) }}

      	{{ Form::close() }}

      	<hr/>

      	Do You have an account? {{ link_to_route('login', 'Login here', array(), array('class' => 'btn btn-success btn-sm')) }}
    </div>
@stop