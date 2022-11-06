@extends('master_main')
@section('mainContent')
<div class="container pt-5">
	<div class="row">
		<div class="col-lg-12 settgs_right_content">
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
					 <h6 class="card_body_header">All Sku List ({{count($data)}}) 
					 	<a href="{{route('import-excel')}}"><button class="pull-right btn btn-success btn-sm dtb_custom_btn_default">New Upload</button></a>
					 </h6>
					 
					{{ Form::open(['class' => 'form-horizontal', 'files' => true, 'url' => 'search-users',
					'method' => 'POST', 'enctype' => 'multipart/form-data', 'id' => 'search-users']) }}
					<!-- Filters -->
					<div class="mb-4 pl-2">
						<div class="form-row align-items-center">
							<!-- <div class="mb-4 mr-5" style="margin-right: 5px;">
								<label class="form-label">Team</label>
								<select class="custom-select" name="team_id">
									@if(isset($teams))
									<option value="">Select a Team</option>
									@foreach($teams as $team)
									<option value="{{$team->id}}">{{$team->team_name}}</option>
									@endforeach
									@endif
								</select>
							</div> -->

							
						</div>
					</div>
					<div class="col-lg-12 text-center loader_class" style="display: none;">
						<img class="img-responsive" src="{{asset('assets_/img/loader.gif')}}" height="80" width="80">
					</div>
					{{ Form::close()}}

					<div class="card no_border">
						<div class="table-responsive">
							<table class="datatables-demo table table-striped table-bordered dtb_custom_tbl_common">
								<thead>
									<tr>
										<th>Unique Reference Number</th>
										<th>Sku</th>
										<th>Sku Title</th>
										<th>Action</th>
									</tr>
								</thead>
								<tbody id="allUserstbody">
									@include('all_skus.allSkuLists')
								</tbody>
							</table>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
<script type="text/javascript">
	$(function() {
  $('.datatables-demo').dataTable();
});
</script>
@endsection