@extends('layouts.default')

@section('content')
	<div class="col-md-12">
		<div class="page-header">
			<h3>
				{{ $title }}
			</h3>
		</div>
		
		{{ Form::open(array('route' => 'info.create', 'files' => true)) }}

			@include('includes.alert')
			<div class="row">
				<div class="col-md-6">
					<!-- personal information -->
					<fieldset class="scheduler-border">
						<legend class="scheduler-border">Personal Information</legend>
					    
					    <div class="form-group">
				          	{{ Form::label('title', 'Title *') }}
				          	{{ Form::text('title', '', array('class' => 'form-control')) }}

				          	{{$errors->first('title')}}
				        </div>

					    <div class="form-group">
				          	{{ Form::label('first_name', 'First Name *') }}
				          	{{ Form::text('first_name', '', array('class' => 'form-control')) }}

				          	{{$errors->first('first_name')}}
				        </div>

				        <div class="form-group">
				          	{{ Form::label('last_name', 'Last Name') }}
				          	{{ Form::text('last_name', '', array('class' => 'form-control')) }}
				          	{{$errors->first('last_name')}}
				        </div>

				        <div class="form-group">
				          	{{ Form::label('gender', 'Gender') }}
				          	{{ Form::select('gender', Info::$genders, '', array('class' => 'form-control')) }}
				          	
				          	{{$errors->first('gender')}}
				        </div>

						
				        <div class="form-group">
				          	{{ Form::label('date_of_birth', 'Date of Birth') }}
				          	{{ Form::text('date_of_birth', '', array('class' => 'form-control', 'datepicker',  'autocomplete' => 'off')) }}
				          	
				          	{{$errors->first('date_of_birth')}}
				        </div>



						<div class="form-group">
				          	{{ Form::label('address', 'Address *') }}
				          	{{ Form::text('address', '', array('class' => 'form-control')) }}
				          	
				          	{{$errors->first('address')}}
				        </div>

				        <div class="form-group">
				          	{{ Form::label('country', 'Country') }}
				          	{{ Form::text('country', '', array('class' => 'form-control')) }}
				          	
				          	{{$errors->first('country')}}
				        </div>
						
				        
					</fieldset>

					<!-- Upload Picture -->
					<fieldset class="scheduler-border">
						<legend class="scheduler-border">Upload Picture</legend>

						<div class="form-group">
						    {{ Form::label('picture', 'Upload Picture') }}
						    {{ Form::file('picture', array('class' => 'form-control')) }}
						   
						    {{$errors->first('picture')}}
						</div>
					</fieldset>
			    </div>

			</div>

			{{Form::hidden('user_id',$user_id)}}

	        {{ Form::submit('Add Info', array('class' => 'btn btn-primary', 'data-loading-text' => 'Adding...', 'type' => 'button')) }}

	    {{ Form::close() }}
	</div>
@stop