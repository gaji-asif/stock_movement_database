@extends('master_main')
@section('mainContent')
<div class="container pt-5">
	<div class="row">

		<div class="col-lg-3">
			@include('settings.developerSettings.developer_settings_sidebar')
		</div>

		<div class="col-lg-9  settgs_right_content">
			<div class="card mb-4 no_border">
				@if(session()->has('message-success'))
				<div class="alert success_message mb-10 background-success" role="alert">
					{{ session()->get('message-success') }}
					<button type="button" class="close" data-dismiss="alert" aria-label="Close">
						<span aria-hidden="true">&times;</span>
					</button>
				</div>
				@endif
				
				<div class="card-body">
					 <h6 class="card_body_header">Template List ({{$settingTemplates->count()}})	
					 	<a href="{{route('settings-template.create')}}"><button class="pull-right btn btn-success btn-sm dtb_custom_btn_default">Add New Template</button></a>
					 </h6>
					 
					<div class="card no_border">
						<div class="table-responsive">
							<table class="datatable_template table table-striped table-bordered dtb_custom_tbl_common">
								<thead>
									<tr>
										<th width="200px">Template Name</th>
										<th>Description</th>
										<th width="100px">Action</th>
									</tr>
								</thead>
								<tbody >
									@if(!empty($settingTemplates))
										@foreach($settingTemplates as $template)
											<tr class="odd" role="row">
												<td class="text-center">{{$template->name}}</td>
												<td class="text-center">{!! $template->description !!}</td>
											
												<td class="text-center text-nowrap" style="color: #4E5155;">
													<a class="action_icon_color btn btn-sm btn-primary" href="{{route('settings-template.edit', $template->id)}}"><span style="color: white" class="glyphicon glyphicon-edit"></span></a>&nbsp;&nbsp;
													<a href="{{url('delete_template_view/'.$template->id)}}" class="modalLink action_icon_color btn btn-sm btn-danger" data-modal-size="modal-md"><span style="color: white"  class="glyphicon glyphicon-trash"></span></a>
													
												</td>
											</tr>
										@endforeach
									@else
									<tr>
										<td colspan="7" class="text-center text-danger">No Data Found</td>
									</tr>
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
<script>
    $(document).ready(function(){
        $(".datatable_template").dataTable({
            order: [
                    [0, "desc"]
                ]
        });
    });
</script>
@endsection