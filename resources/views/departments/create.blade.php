@extends('master_main')
@section('mainContent')
<div class="row mt-4">
	<div class="col-lg-2"></div>
	<div class="col-lg-8">
		<div class="card mb-4">
			@if(session()->has('message-success'))
				<div class="alert alert-success mb-10 background-success" role="alert">
					{{ session()->get('message-success') }}
					<button type="button" class="close" data-dismiss="alert" aria-label="Close">
						<span aria-hidden="true">&times;</span>
					</button>
				</div>
			@elseif(session()->has('message-danger'))
			<div class="alert alert-danger">
				{{ session()->get('message-danger') }}
				<button type="button" class="close" data-dismiss="alert" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			@endif
			<h6 class="card-header">
				Add New Department
			</h6>
			@if(isset($editData))
			{{ Form::open(['class' => '', 'files' => true, 'url' => 'role/'.$editData->id, 'method' => 'PUT', 'enctype' => 'multipart/form-data']) }}
			@else
			{{ Form::open(['class' => 'form-horizontal', 'files' => true, 'url' => 'department',
			'method' => 'POST', 'enctype' => 'multipart/form-data']) }}
			@endif
			<div class="card-body">
				<div class="form-group">
						<label class="form-label">Department Name</label>
						<input type="text" class="form-control {{ $errors->has('name') ? ' is-invalid' : '' }}" value="{{isset($editData)? $editData->name : ''}}" placeholder="Department Name" name="name" required="">
						@if ($errors->has('name'))
						<span class="invalid-feedback" role="alert">
							<span class="messages"><strong>{{ $errors->first('name') }}</strong></span>
						</span>
						@endif
					</div>
					<button type="submit" class="btn btn-default mt-4">Submit</button>
			 </div>
			{{ Form::close()}}
		</div>
	</div>
	<div class="col-lg-2"></div>
</div>
@endsection