@extends('layouts.default')

@section('content')
	<div class="col-md-12">
		
		@if(Auth::check())
			<div class="page-header">
				<h2>Welcome 
					@if(!is_null(Info::where('user_id','=',Auth::user()->id)->first()))
					{{Info::where('user_id','=',Auth::user()->id)->first()->title}}
					{{ Auth::user()->user_name }}
					@else
						{{ Auth::user()->user_name }}
					@endif
				</h2>
			</div>
		
		@else
			<div class="page-header">
				<h2>{{ $title }}</h2>
			</div>
		
		@endif
		@include('includes.alert')
    </div>
@stop