@extends('master_main')
@section('mainContent')
    <div class="container pt-5">
        <div class="row">
            <div class="col-lg-3">
                @include('settings.developerSettings.developer_settings_sidebar')
            </div>
            <div class="col-lg-9 settgs_right_content">
                @if (isset($editData))
                    {{ Form::open(['class' => '', 'files' => true, 'url' => 'settings-template/' . $editData->id, 'method' => 'PUT', 'enctype' => 'multipart/form-data']) }}
                @else
                    {{ Form::open(['class' => 'form-horizontal', 'files' => true, 'url' => 'settings-template', 'method' => 'POST', 'enctype' => 'multipart/form-data']) }}
                @endif
                <div class="card mb-4 no_border">
                    @if (session()->has('message-success'))
                        <div class="alert alert-success mb-10 background-success" role="alert">
                            {{ session()->get('message-success') }}
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                    @endif

                    <div class="card-body padding_left_right">
                        <h6 class="card_body_header">Add New Template
                            <a href="{{ route('settings-template.index') }}"
                                class="pull-right btn btn-success btn-sm dtb_custom_btn_default">Template List</a>
                        </h6>
                        {{-- <hr class="border-light m-0"> --}}
                        <div class="pb-2 pt-3">

                            <div class="form-group">
                                <label class="form-label">Template Name</label>
                                <input type="text" class="form-control {{ $errors->has('name') ? ' is-invalid' : '' }}"
                                    value="{{ isset($editData) ? $editData->name : '' }}" placeholder="Template Name"
                                    name="name" required>
                                @if ($errors->has('name'))
                                    <span class="invalid-feedback" role="alert">
                                        <span class="messages"><strong>{{ $errors->first('name') }}</strong></span>
                                    </span>
                                @endif
                            </div>
                            <div class="form-group">
                                <label class="form-label">Description</label>
                                <textarea name="templat_des" id="" cols="30" rows="10"
                                    required>{{ isset($editData) ? $editData->description : '' }}</textarea>
                                @if ($errors->has('templat_des'))
                                    <span class="invalid-feedback" role="alert">
                                        <span
                                            class="messages"><strong>{{ $errors->first('templat_des') }}</strong></span>
                                    </span>
                                @endif
                            </div>
                        </div>
                        <div class="form-group row pt-3">
                            <div class="col-sm-12 ml-sm-auto">
                                <button type="submit"
                                    class="col-lg-5 btn btn-success dtb_custom_btn_default button_middle">Submit</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script>
        CKEDITOR.replace('templat_des');
    </script>
@endsection
