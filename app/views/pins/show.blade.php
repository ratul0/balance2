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
					<th>Amount</th>
					<th>Pin</th>
					<th>Status</th>
					<th>Assigned</th>

					<th colspan="3">Action</th>
				</tr>
			</thead>
			<tbody>
				@foreach($pins as $pin)
					<tr>

						<td>{{ $pin->amount }}</td>
						<td>{{ $pin->pin }}</td>
						<td>
							@if($pin->status == 0)
								
								<span class="glyphicon glyphicon-ok text-success">Used</span>
							@else
								<span class="glyphicon glyphicon-remove text-danger">Unused</span>
								
							@endif
						</td>
						<td>
							@if(!$pin->distributor_id)
								<span class="glyphicon glyphicon-remove text-danger"></span>
							@else
								<span class="glyphicon glyphicon-ok text-success"></span>
								
							@endif
						</td>
						<td>
							<a href="{{ URL::route('pin.view',$pin->id); }}" class='btn btn-success btn-sm'>
					        	<span class="glyphicon glyphicon-zoom-in"></span>
							</a>
						</td>
	        			<td>
	        				<a href="#" class="btn btn-danger btn-sm deleteBtn" data-toggle="modal" data-target="#deleteConfirm" deletePin="{{ $pin->id }}">
	        					<span class="glyphicon glyphicon-trash"></span>
	        				</a>
						</td>
					</tr>
				@endforeach
			</tbody>
		</table>

		<div class="text-center">{{ $pins->links() }}</div>
	</div>

	<!-- Modal -->
	<div class="modal fade" id="deleteConfirm" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" data-backdrop="static">
	  	<div class="modal-dialog">
	    	<div class="modal-content">
		      	<div class="modal-header">
		        	<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
		        	<h4 class="modal-title" id="myModalLabel">Confirmation</h4>
		      	</div>
		      	<div class="modal-body">
					Are you sure to delete this Pin?
		      	</div>
		      	<div class="modal-footer">
		        	{{ Form::open(array('route' => array('pin.delete', 0), 'method'=> 'delete', 'class' => 'deleteForm')) }}
		        		<button type="button" class="btn btn-danger" data-dismiss="modal">No</button>
		        		{{ Form::submit('Yes, Delete', array('class' => 'btn btn-success')) }}
		        	{{ Form::close() }}
		      	</div>
	    	</div>
		</div>
	</div>

	<script type="text/javascript">
	$(document).ready(function() {
		
		// delete a member
		$('.deleteBtn').click(function() {
			var deletePin = $(this).attr('deletePin');
			var url = "<?php echo URL::route('pin'); ?>";
			$(".deleteForm").attr("action", url+'/'+deletePin);
		});

	});
	</script>

@stop