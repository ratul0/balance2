@extends('layouts.halfWidth')

@section('content')
	@if(!empty($pin )  && !empty($distributors ))
	<div class="col-md-5 col-md-offset-3">
		<div class="page-header">
			<h2>{{ $title }}</h2>
				@if(!$pin->distributor_id)
					<span class="glyphicon glyphicon-remove text-danger"></span>
					<p>This Pin is not Assigned yet.</p>
				@else
					<span class="glyphicon glyphicon-ok text-success"></span>
					<p>This Pin is already Assigned to : {{ $distributors[$pin->distributor_id] }}</p>
					@if(!empty($pin->client_id))
						<p>This Pin is Activated By : {{ User::where('id','=',$pin->client_id)->first()->email }}</p>	
					@endif		
				@endif
			<h4>Pin No: </h4>
			<hr>
			<h2>{{$pin->pin}}</h2>
		</div>
	@if(empty($pin->client_id)  && empty($pin->distributor_id))
      	{{Form::open(array('route' => 'pin.assign'))}}

      	
	      	@include('includes.alert')
	      	<div class="form-group">
		          	{{ Form::label('member', 'Assign This Pin To: *') }}
		          	{{Form::select('member',$distributors,NULL,array('class'=>'form-control'));}}
		          	{{$errors->first('member')}}
		     </div>

	        {{Form::hidden('pin_id',$pin->id)}}
      	


	      	{{ Form::submit('Assign',array('class' => 'btn btn-primary btn-lg', 'data-loading-text' => 'Assigning Pin...')) }}

	      	{{ Form::close() }}
	@endif
      </div>
    @else
    	<h3>There is no Active pin with this id.</h3>
    @endif

@stop