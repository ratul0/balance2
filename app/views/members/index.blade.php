@extends('layouts.halfWidth')

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
					<th>Username</th>
					<th>Email</th>
					<th>Role</th>
					<th colspan="3">Action</th>
				</tr>
			</thead>
			<tbody>
				@foreach($members as $member)
					<tr>

						<td>{{ $member->user_name }}</td>
						<td>{{ $member->email }}</td>
						<td>{{ Role::find($member->role_id)->name }}</td>
						<td>
							<a href="{{ URL::route('members.add',$member->id); }}" class='btn btn-success btn-sm'>
					        	<span class="glyphicon glyphicon-zoom-in"></span>
							</a>
						</td>
	        			<td>
	        				<a href="#" class="btn btn-danger btn-sm deleteBtn" data-toggle="modal" data-target="#deleteConfirm" deleteMember="{{ $member->id }}">
	        					<span class="glyphicon glyphicon-trash"></span>
	        				</a>
						</td>
					</tr>
				@endforeach
			</tbody>
		</table>

		<div class="text-center">{{ $members->links() }}</div>
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
					Are you sure to delete this Member?
		      	</div>
		      	<div class="modal-footer">
		        	{{ Form::open(array('route' => array('members.delete', 0), 'method'=> 'delete', 'class' => 'deleteForm')) }}
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
			var deleteMember = $(this).attr('deleteMember');
			var url = "<?php echo URL::route('members'); ?>";
			$(".deleteForm").attr("action", url+'/'+deleteMember);
		});

	});
	</script>

@stop