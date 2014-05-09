@extends('layouts.halfWidth')

@section('content')
	<div class="col-md-5 col-md-offset-3">
		<div class="page-header">
			<h2>{{ $title }}</h2>
		</div>

      	{{Form::open(array('route' => 'pin'))}}


      	@include('includes.alert')
      	<div class="form-group">
	          	{{ Form::label('amount', 'Amount Of Money *') }}
	          	{{ Form::text('amount', '', array('class' => 'form-control')) }}
	          	{{$errors->first('amount')}}
	        </div>

	        <div class="form-group">
	          	{{ Form::label('number', 'No Of Pins *') }}
	          	
	          	{{ Form::text('number', '',array('class' => 'form-control')) }}
	          	{{$errors->first('number')}}
	        </div>

	        <div class="form-group">
	          	{{ Form::label('category', 'Category Name *') }}
	          	
	          	{{ Form::text('category', '',array('class' => 'form-control')) }}
	          	{{$errors->first('category')}}
	        </div>

	        
      	


      	{{ Form::submit('Generate Pins',array('class' => 'btn btn-primary btn-lg', 'data-loading-text' => 'Generating Pins...')) }}

      	{{ Form::close() }}
    </div>
@stop