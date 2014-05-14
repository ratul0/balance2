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
	          	<span class="pull-right">
	          		<a href="#" data-toggle="modal" data-target="#passwordRecover">
	        					<span class="glyphicon glyphicon-wrench"></span>
	        					Forgot password?
	        		</a>
	          	</span>
	          	{{ Form::password('password', array('class' => 'form-control')) }}
	          	{{$errors->first('password')}}
	        </div>
      	


      	{{ Form::submit('Login',array('class' => 'btn btn-primary btn-lg', 'data-loading-text' => 'Logging in...')) }}

      	{{ Form::close() }}

      	<hr/>

      	Don't have an account? {{ link_to_route('register', 'Register here', array(), array('class' => 'btn btn-success btn-sm')) }}
    </div>



    	<!-- Modal -->
	<div class="modal fade" id="passwordRecover" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" data-backdrop="static">
	  	<div class="modal-dialog">
	    	<div class="modal-content">
		      	<div class="modal-header">
		        	<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
		        	<h4 class="modal-title" id="myModalLabel">Your Email :</h4>
		      	</div>
		      	<div class="modal-body">
					Enter Your Email address :
		      	</div>
		      	<div class="modal-footer">
		        	{{ Form::open(array('route' => array('password.recover'))) }}
		        		  	<div class="form-group">
					          	
					          	{{ Form::text('email', '', array('class' => 'form-control')) }}
					          	
					        </div>
		        		{{ Form::submit('Submit', array('class' => 'btn btn-success')) }}
		        	{{ Form::close() }}
		      	</div>
	    	</div>
		</div>
	</div>
@stop