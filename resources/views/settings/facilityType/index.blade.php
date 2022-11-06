@extends('master_main')
@section('mainContent')
<div class="container pt-5">
	<div class="row">
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
		<div class="col-lg-3">
			@include('settings.developerSettings.developer_settings_sidebar')
		</div>

		<div class="col-lg-9  settgs_right_content" >
			<div class="row">
				<div class="col-lg-4"  style="padding-right: 4px !important">
					<div class="card mb-4">
					
						<h6 class="card-header">
							Add New Facility Type
						</h6>
						@if(isset($editData))
						{{ Form::open(['class' => '', 'files' => true, 'url' => 'settings-facility-types/'.$editData->id, 'method' => 'PUT', 'enctype' => 'multipart/form-data']) }}
						@else
						{{ Form::open(['class' => 'form-horizontal', 'files' => true, 'url' => 'settings-facility-types',
						'method' => 'POST', 'enctype' => 'multipart/form-data']) }}
						@endif
						<div class="card-body">
							<div class="form-group">
									<label class="form-label">Facility Type Name</label>
									<input type="text" class="form-control {{ $errors->has('type_name') ? ' is-invalid' : '' }}" value="{{isset($editData)? $editData->type_name : ''}}" placeholder="Facility type name" name="type_name">
									@if ($errors->has('type_name'))
									<span class="invalid-feedback" role="alert">
										<span class="messages"><strong>{{ $errors->first('type_name') }}</strong></span>
									</span>
									@endif
								</div>
								<button type="submit" class="btn btn-default dtb_custom_btn_default mt-4">Submit</button>
						 </div>
						{{ Form::close()}}
					</div>
				</div>
				<div class="col-lg-8" style="padding-left: 0px !important">
					<div class="card">
						<h6 class="card-header">
							All Facility Types (@if(isset($types)){{$types->count()}}@endif)
						</h6>
					
						<div class="card-datatable table-responsive">
							<table class="datatables-demo table table-striped table-bordered dtb_custom_tbl_common " id="facility_type_datatable">
								<thead>
									<tr>
										<th>#SL</th>
										<th>Facility Type Name</th>
										<th>Action</th>
									</tr>
								</thead>
								<tbody>
									@php $sl = 1; @endphp
									@if(isset($types))
										@foreach($types as $type)
											<tr class="odd gradeX">
												<td class="text-center">{{$sl++}}</td>
												<td class="text-center">{{$type->type_name}}</td>
												
													<td class="text-center text-nowrap" style="color: #4E5155;">
														<a class="action_icon_color btn btn-sm btn-primary" href="{{route('settings-facility-types.edit', $type->id)}}"><span style="color: white" class="glyphicon glyphicon-edit"></span></a>&nbsp;&nbsp;
														<a href="{{url('settings-facility-types-delete-view/'.$type->id)}}" class="modalLink action_icon_color btn btn-sm btn-danger" data-modal-size="modal-md"><span style="color: white" class="glyphicon glyphicon-trash"></span></a>
													</td>
												
											</tr>
										@endforeach
									@endif
								</tbody>
							</table>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
<link rel="stylesheet" href="https://cdn.datatables.net/1.11.3/css/jquery.dataTables.min.css">
<script src="https://cdn.datatables.net/1.11.3/js/jquery.dataTables.min.js"></script>
<script>
	$(document).ready(function() {
		$('#facility_type_datatable').DataTable();
	});
	
</script>
@endsection