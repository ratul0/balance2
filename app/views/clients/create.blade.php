@extends('layouts.default')

@section('content')
	<div class="col-md-5 col-md-offset-3">
		<div class="page-header">
			<h2>{{ $title }}</h2>
			<p class='btn btn-primary btn-sm pull-right' style="vertical-align: middle;">
					<span class="glyphicon glyphicon-gift"></span> You Currently have {{$total}} $
				</p>
		</div>

      	{{Form::open(array('route' => 'client.add'))}}


      	@include('includes.alert')
	      	<div class="form-group">
		          	{{ Form::label('pin', 'Enter A Pin *') }}
		          	{{ Form::text('pin', '', array('class' => 'form-control')) }}
		          	{{$errors->first('pin')}}
		    </div>

      	


      	{{ Form::submit('Submit',array('class' => 'btn btn-primary btn-lg', 'data-loading-text' => 'Submitting in...')) }}

      	{{ Form::close() }}

    </div>
@stop