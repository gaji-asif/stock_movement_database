@extends('master_main')
@section('mainContent')



<style>
	h1 h2 h3 h4 h5 h6 p{
		color: black
	}
</style>

<div class="container mt-3">
	<div class="row   justify-content-md-center ">
		<div class="col-md-6 col-lg-8" >
			<div class="card table-card">
				<div class="card-header">
					<h5>Activity Log</h5>
				
				</div>
				<div class="card-block" >
					<div class="table-responsive " style="max-height: 40em; overflow: auto;">
						<table class="table table-hover">
							@if(isset($notifications))
							@foreach ($notifications as $log)
								<tr>
									{{-- <td @if($log->seen == 1) style="background-color:#f5f5f5" @endif > --}}
									<td >
										<div class="d-inline-block pl-5" >
											<div class="row">
												<a href="#">
													<h6 class="pl-2" style="color: blue;padding-top:3px">
														{{ $log->user_name }} </h6>
												</a>
												<p class="pr-2 pl-2"> {{ $log->action }} </p>
												<a href="#">
													<h6 style="color: blue;padding-top:3px"> {{ $log->function_name }} </h6>
												</a>
											</div>
											<p class="text-muted">
												{{ date('H:i:s d-M-Y', strtotime($log->created_at)) }}</p>
										</div>
									
									</td>
								</tr>

							@endforeach
							@endif
						</table>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
@endsection
