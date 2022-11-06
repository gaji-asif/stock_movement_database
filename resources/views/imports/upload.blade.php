@extends('master_main')
@section('mainContent')
<div class="container pt-5">
  <div class="row">
    <div class="col-lg-12 settgs_right_content">
      @if(isset($editData))
      {{ Form::open(['class' => '', 'files' => true, 'url' => 'role/'.$editData->id, 'method' => 'PUT', 'enctype' => 'multipart/form-data']) }}
      @else
      {{ Form::open(['class' => 'form-horizontal', 'files' => true, 'url' => 'storeImportExcel',
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
          <h6 class="card_body_header">Upload File from Excel
            <a href="{{route('all-skus.index')}}" class="pull-right btn btn-success btn-sm dtb_custom_btn_default">Go to Sku List</a>
          </h6>
          <hr class="border-light m-0">
          <div class="pb-2 pt-3">
            <div class="form-group">
              <label class="form-label">File Upload</label>
              <input type="file" class="form-control {{ $errors->has('ud_id') ? ' is-invalid' : '' }}" name="file" required="">
              @if ($errors->has('file'))
              <span class="invalid-feedback" role="alert">
                <span class="messages"><strong>{{ $errors->first('file') }}</strong></span>
              </span>
              @endif
            </div>
            
            <div class="pb-2 pt-3">
                <!-- <h5 class="mb-4">Language & Timezone</h5> -->
                <!-- <div class="form-group">
                  <label class="form-label">Language</label>
                  <select class="custom-select" name="language_id">
                    @if(isset($languages))
                    <option value="">Select a Language</option>
                    @foreach($languages as $language)
                    <option value="{{$language->id}}"
                      @if(isset($editData))
                      @if($editData->language_id == $language->id)
                      selected
                      @endif
                      @endif
                      >{{$language->name}}</option>
                      @endforeach
                      @endif
                    </select>
                  </div> -->
                  <!-- <div class="form-group">
                    <label class="form-label">Timezone</label>


                    <?php

                    function tz_list() {
                      $zones_array = array();
                      $timestamp = time();
                      foreach(timezone_identifiers_list() as $key => $zone) {
                        date_default_timezone_set($zone);
                        $zones_array[$key]['zone'] = $zone;
                        $zones_array[$key]['diff_from_GMT'] = 'UTC/GMT ' . date('P', $timestamp);
                      }
                      return $zones_array;
                    }
                    ?>

                    <select class="form-control custom-select {{ $errors->has('timezone_id') ? ' is-invalid' : '' }}" name="timezone_id" style="width: 100%">
                      <option value="0">Please, select timezone</option>
                      <?php foreach(tz_list() as $t) { ?>
                        <option value="<?php print $t['zone'] ?>">
                          <?php print $t['diff_from_GMT'] . ' - ' . $t['zone'] ?>
                        </option>
                      <?php } ?>
                    </select>


                    </div> -->

                    <!-- <hr class="border-light m-0"> -->
                    <div class="pb-2 pt-3">
                     <!--  <h5 class="mb-4">Teams</h5>
                      <div class="form-group">
                        <label class="form-label">Assign in a Team</label>
                        <select class="custom-select" name="team_id">
                          @if(isset($developer_teams))
                          <option value="">Select a Team</option>
                          @foreach($developer_teams as $developer_team)
                          <option value="{{$developer_team->id}}"
                            @if(isset($editData))
                            @if($editData->language_id == $language->id)
                            selected
                            @endif
                            @endif
                            >{{$developer_team->team_name}}</option>
                            @endforeach
                            @endif
                          </select>
                        </div> -->

                        <!-- <hr class="border-light m-0"> -->
                        <!-- <div class="pb-2 pt-3">
                          <h5 class="mb-4">Projects</h5>
                          <div class="form-group">
                            <label class="form-label">Please Select the Projects to have this user join</label>
                            <select class="user-edit-multiselect form-control w-100" multiple name="projects[]">
                              @if(isset($projects))
                              @foreach($projects as $project)
                              <option value="{{$project->id}}"
                                @if(isset($editData))
                                @if($editData->language_id == $language->id)
                                selected
                                @endif
                                @endif
                                >{{$project->project_name}}</option>
                                @endforeach
                                @endif
                              </select>
                            </div>
                          </div> -->

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
