@extends('master_main')
@section('mainContent')
<div class="container pt-5">
  <div class="row">
    {{-- <div class="col-lg-3">
      @include('settings.developerSettings.developer_settings_sidebar')
    </div> --}}
    <div class="col-lg-9 mx-auto settgs_right_content">
      @if(isset($editData))
      {{ Form::open(['class' => '', 'files' => true, 'url' => 'settings-users/'.$editData->id, 'method' => 'PUT', 'enctype' => 'multipart/form-data']) }}
      @else
      {{ Form::open(['class' => 'form-horizontal', 'files' => true, 'url' => 'settings-users',
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
       
        <div class="card-body padding_left_right">
          <h6 class="card_body_header">Edit User
            <a href="{{route('settings-users.index')}}" class="pull-right btn btn-success btn-sm dtb_custom_btn_default">User List</a>
          </h6>
          <div class="media align-items-center">
            @php $image_path = ""; @endphp
            @if(!empty($editData->icon_image_path))

           <img src="{{$editData->icon_image_path}}" alt="" class="d-block ui-w-80" id="profileDisplay" style="">
            @else
            <img src="{{asset('assets_/img/user_avatar.png')}}" alt="" class="d-block ui-w-80" id="profileDisplay">
            @endif
            <div class="media-body ml-3">
              <label class="form-label d-block mb-2">User Image</label>
              <label class="btn btn-outline-primary btn-sm">
                Upload
                <input type="file" class="user-edit-fileinput" name="userImage" id="userImage" onChange="displayImage(this)" accept="image/*">
              </label>&nbsp;
            </div>
          </div>
          <hr class="border-light m-0">
          <div class="pb-2 pt-3">
            <h5 class="mb-4">User Info</h5>
            <div class="form-group">
              <label class="form-label">User ID</label>
              <input type="text" class="form-control {{ $errors->has('ud_id') ? ' is-invalid' : '' }}" value="{{isset($editData)? $editData->ud_id : ''}}" placeholder="User ID" name="ud_id">
              @if ($errors->has('ud_id'))
              <span class="invalid-feedback" role="alert">
                <span class="messages"><strong>{{ $errors->first('ud_id') }}</strong></span>
              </span>
              @endif
            </div>
            <div class="form-group">
              <label class="form-label">Name</label>
              <input type="text" class="form-control {{ $errors->has('name') ? ' is-invalid' : '' }}" value="{{isset($editData)? $editData->name : ''}}" name="name">
              @if ($errors->has('name'))
              <span class="invalid-feedback" role="alert">
                <span class="messages"><strong>{{ $errors->first('name') }}</strong></span>
              </span>
              @endif
            </div>
            <div class="form-group">
              <label class="form-label">Email</label>
              <input type="email" class="form-control {{ $errors->has('email') ? ' is-invalid' : '' }}"  value="{{isset($editData)? $editData->email : ''}}" name="email" id="emailexist">
              <p class="error_message">Email Exist</p>
              @if ($errors->has('email'))
              <span class="invalid-feedback" role="alert">
                <span class="messages"><strong>{{ $errors->first('email') }}</strong></span>
              </span>
              @endif
              
              <input type="hidden" name="_token" id="token" value="{{ csrf_token() }}">
              <input type="hidden" name="url" id="url" value="{{URL::to('/')}}">
              <input type="hidden" name="emailCheck_url" id="emailCheck_url" value="emailCheck">
             
            </div>
          
           
            <div class="form-group">
              <label class="form-label">Role</label>
              <select class="custom-select {{ $errors->has('role') ? ' is-invalid' : '' }}" name="role">
                @if(isset($roles))
                <option value="">Select a Role</option>
                @foreach($roles as $role)
                <option value="{{$role->id}}"
                  @if(isset($editData))
                  @if($editData->role == $role->id)
                  selected
                  @endif
                  @endif
                  >{{$role->role_name}}</option>
                  @endforeach
                  @endif
                </select>
                @if ($errors->has('role'))
              <span class="invalid-feedback" role="alert">
                <span class="messages"><strong>{{ $errors->first('role') }}</strong></span>
              </span>
              @endif
              </div>
              <div class="pb-2 pt-3">
                <div class="pb-2 pt-3">
                 
                  <div class="form-group row pt-3">
                            <div class="col-sm-12 ml-sm-auto">
                              <button type="submit" class="col-lg-5 btn btn-success dtb_custom_btn_default button_middle">Update</button>
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
