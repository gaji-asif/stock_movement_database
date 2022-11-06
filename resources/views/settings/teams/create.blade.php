@extends('master_main')
@section('mainContent')
<div class="container pt-5">
  <div class="row">
    <div class="col-lg-3">
      @include('settings.developerSettings.developer_settings_sidebar')
    </div>
    <div class="col-lg-9 settgs_right_content">
        @if(isset($editData))
        {{ Form::open(['class' => '', 'files' => true, 'url' => 'settings-teams/'.$editData->id, 'method' => 'PUT', 'enctype' => 'multipart/form-data']) }}
        @else
        {{ Form::open(['class' => 'form-horizontal', 'files' => true, 'url' => 'settings-teams',
        'method' => 'POST', 'enctype' => 'multipart/form-data']) }}
        @endif
      <div class="card mb-4 no_border">
        @if(session()->has('message-success'))
        <div class="alert alert-success mb-10 background-success" role="alert">
          {{ session()->get('message-success') }}
          <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        @endif

        <div class="card-body padding_left_right"><br>
          <h6 class="card_body_header">
            @if(isset($editData))
            <span style="margin-top: 4px">Edit Team</span>
            @else
             <span style="margin-top: 4px">Add New Team</span>
            @endif
            <a href="{{route('settings-teams.index')}}" class="pull-right btn btn-success btn-sm dtb_custom_btn_default" style="margin-top: -5px;">Team List</a>
          </h6>
          <br>
          <div class="media align-items-center">
            @if(!empty($editData->icon_path))
            <img src="//{{ $editData->icon_path }}" alt="" class="d-block ui-w-80" id="profileDisplay">
            @else
            <img src="{{asset('assets_/img/engagedev.png')}}" alt="" class="d-block ui-w-80" id="profileDisplay">
            @endif

            
            <div class="media-body ml-3">
              <label class="form-label d-block mb-2">Team Icon</label>
              <label class="btn btn-outline-primary btn-sm">
                Upload
                <input type="file" class="user-edit-fileinput" name="team_icon" id="team_icon" onChange="displayImage(this)" accept="image/*">
              </label>&nbsp;
            </div>
          </div>
          <hr class="border-light m-0">
          <div class="pb-2 pt-3">
            <div class="form-group">
              <label class="form-label">Team Name</label>
              <input name="team_name" type="text" class="form-control {{ $errors->has('team_name') ? ' is-invalid' : '' }}" placeholder="Team Name" value="@if(isset($editData)) {{$editData->team_name}} @endif">
              @if ($errors->has('team_name'))
              <span class="invalid-feedback" role="alert">
                  <span class="messages"><strong>{{ $errors->first('team_name') }}</strong></span>
              </span>
              @endif
            </div>

            <div class="form-group">
                <label class="form-label">Description</label>
                <textarea class="form-control {{ $errors->has('description') ? ' is-invalid' : '' }}" value="" placeholder="Description" name="description">{{isset($editData)? $editData->description : ''}}</textarea>
                @if ($errors->has('description'))
                <span class="invalid-feedback" role="alert">
                  <span class="messages"><strong>{{ $errors->first('description') }}</strong></span>
                </span>
                @endif
            </div>



                          <div class="form-group row pt-3">
                            <div class="col-sm-12 ml-sm-auto">
                              <button type="submit" class="col-lg-5 btn btn-success dtb_custom_btn_default button_middle">Submit</button>
                            </div>
                          </div>

                        </div>
                      </div>
                    </div>
                  </div>
                </div>
                {{ Form::close()}}
              </div>
            </div>
          </div>
          @endsection
