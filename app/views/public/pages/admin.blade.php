@extends('layouts.halfWidth')

@section('content')
	<div class="col-md-12">
		
		@if(Auth::check())
			<div class="page-header">
				<h2>Welcome {{ Auth::user()->user_name }}</h2>
			</div>
		
		@else
			<div class="page-header">
				<h2>{{ $title }}</h2>
			</div>
		
		@endif
		@include('includes.alert')
    </div>
@stop