@extends('layouts.default')

@section('content')
	<div class="col-md-12">
		<div class="page-header">
			<h3>
				{{ $title }}
			</h3>
		</div>
		@include('includes.alert')
		<table class="table table-bordered table-striped">
			<thead>
				<tr>
					<th>Pins</th>

					<th colspan="3">Action</th>
				</tr>
			</thead>
			<tbody>
				@foreach($pins as $pin)
					<tr>

						<td>{{ $pin->pin }}</td>

						<td>
							<a href="{{ URL::route('distributors.show',$pin->id); }}" class='btn btn-success btn-sm'>
					        	<span class="glyphicon glyphicon-zoom-in"></span>
							</a>
						</td>
	        			
					</tr>
				@endforeach
			</tbody>
		</table>

		<div class="text-center">{{ $pins->links() }}</div>
	</div>



@stop