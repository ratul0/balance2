@extends('layouts.default')

@section('content')
	<div class="col-md-5 col-md-offset-3">
		<div class="page-header">
			<h2>{{ $title }}</h2>
		</div>

      	{{Form::open(array('route' => 'login'))}}


      	@include('includes.alert')
      	<div class="form-group">
	          	{{ Form::label('email', 'Email Address *') }}
	          	{{ Form::text('email', '', array('class' => 'form-control')) }}
	          	{{$errors->first('email')}}
	        </div>

	        <div class="form-group">
	          	{{ Form::label('password', 'Password *') }}
	          	
	          	{{ Form::password('password', array('class' => 'form-control')) }}
	          	{{$errors->first('password')}}
	        </div>
      	


      	{{ Form::submit('Login',array('class' => 'btn btn-primary btn-lg', 'data-loading-text' => 'Logging in...')) }}

      	{{ Form::close() }}

      	<hr/>

      	Don't have an account? {{ link_to_route('register', 'Register here', array(), array('class' => 'btn btn-success btn-sm')) }}
    </div>
@stop