@extends('master_main')
@section('mainContent')

<div class="container pt-5">
    <div class="row">

        <div class="col-lg-3">
            @include('settings.developerSettings.developer_settings_sidebar')
        </div>

        <div class="col-lg-9  settgs_right_content">
            <div class="card mb-4 no_border">

                <div class="card-body">
                    <h6 class="card_body_header">Admission officers

                    </h6>


                    <div class="card no_border">
                        <div class="table-responsive">
                            <table class="datatables-demo table table-striped table-bordered dtb_custom_tbl_common">
                                <thead>
                                    <tr>
                                        <th>Name</th>
                                        <th>E-mail</th>
                                        <th>Role</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>



                                    @if(!empty($Admission_officers))
                                    @foreach($Admission_officers as $Admission_officer)
                                    <tr class="odd" role="row">
                                        <td class="sorting_1">{{$Admission_officer->name}}</td>
                                        <td>{{$Admission_officer->email}}</td>
                                        <td>
                                            @if(isset($Admission_officer->role))
                                            {{$Admission_officer->role_name}}
                                            @endif
                                        </td>
                                        <td class="text-center text-nowrap">
                                            <a class=" btn btn-info btn-sm" href="{{url('assign_student/'.$Admission_officer->id)}}">Assign</a>&nbsp;&nbsp;

                                                    <a  class="btn btn-success btn-sm" href="{{url('assign/view/'.$Admission_officer->id)}}">View</a>
                                        </td>

                                    </tr>
                                    @endforeach
                                    @else
                                    <tr>
                                        <td colspan="8" class="text-center text-danger">No Data Found</td>
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
@endsection
