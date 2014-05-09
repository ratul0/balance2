@extends('layouts.default')

@section('content')
	<div class="col-md-12">
		<div class="page-header">
			<h3>
				{{ $title }}
				<a href="{{ URL::route('info.edit',$profile->user_id) }}" class='btn btn-primary btn-sm pull-right' style="vertical-align: middle;">
					<span class="glyphicon glyphicon-chevron-left"></span> Edit Profile
				</a>
			</h3>
		</div>
		@include('includes.alert')
		<div class="row">
			<div class="col-md-4">
				<div class="thumbnail text-center">
			      	<span>{{HTML::image("/img/profile_picture/$profile->url",NULL,$attributes=array('width'=>200,'height'=>200))}}</span>
			      	<div class="caption">
			        	<h4>{{ $profile->first_name }}</h4>
			      	</div>

			    </div>
			</div>
			<div class="col-md-8">
				<div class="panel-group" id="student_info">
				  	<!-- personal -->
				  	<div class="panel panel-default">
						<div class="panel-heading">
							<h4 class="panel-title">
								<a data-toggle="collapse" data-parent="#student_info" href="#personal">
				          			Personal Information
				        		</a>
							</h4>
						</div>
				    	<div id="personal" class="panel-collapse collapse in">
							<div class="panel-body">
								<table class="table table-bordered table-striped">
									<tr>
										<th>First Name</th>
										<td>{{ $profile->first_name }}</td>
									</tr>
									<tr>
										<th>Last Name</th>
										<td>{{ $profile->last_name }}</td>
									</tr>

									<tr>
										<th>Gender</th>
										<td>{{ $profile->gender }}</td>
									</tr>

									<tr>
										<th>Date of Birth</th>
										<td>
											@if(!is_null($profile->date_of_birth))
												{{ date('d F, Y', strtotime($profile->date_of_birth)) }}</td>
											@endif
									</tr>

									<tr>
										<th>Address</th>
										<td>{{ $profile->address }}</td>
									</tr>
									<tr>
										<th>Country</th>
										<td>{{ $profile->country }}</td>
									</tr>
									
								</table>
							</div>
						</div>
				  	</div>


				</div>
			</div>
		</div>
	</div>
@stop