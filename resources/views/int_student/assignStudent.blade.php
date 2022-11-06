@extends('master_main')
@section('mainContent')
<style>
    .ui-tooltip-content{
        display: none;
    }
</style>
<div class="container pt-5">
    <div class="row">
        <div class="col-lg-3">
            @include('settings.developerSettings.developer_settings_sidebar')
        </div>
        <div class="col-lg-9 settgs_right_content">

            {{ Form::open(['class' => '', 'files' => true, 'url' => '/assign', 'method' => 'POST', 'enctype' => 'multipart/form-data']) }}

            <div class="card mb-4 no_border">
                <div class="card-body">
                    <h6 class="card_body_header">Assign Student to {{ $Admission_officer->name }}
                    </h6>
                    <input type="hidden" name="administrator_id" value="{{ $Admission_officer->id }}">
                    <hr class="border-light m-0">
                    <div class="pb-2 pt-4">

                        <h5 class="mb-4">Students</h5>

                        <div class="form-group">
                            <select class=" selectpicker form-control  custom-select" multiple
                                data-live-search="true" data-style="btn-white border" title="Select Student"
                                name="students[]">
                                @if(isset($IntStudents))
                                @foreach($IntStudents as $IntStudent)
                                <option value="{{$IntStudent->id}}">{{$IntStudent->field_5}}</option>
                                @endforeach
                                @endif
                            </select>
                        </div>

                    </div>
                    <div class="card-footer border-0 text-right mb-2 pr-0">
                        <a href="{{route('assign')}}" class="btn btn-danger mr-2">{{ __('Return') }}</a>
                        <button type="submit" class="btn btn-success">{{ __('Assign') }}</button>
                    </div>
                </div>



            </div>
            {{ Form::close()}}
        </div>
    </div>
</div>
@endsection
