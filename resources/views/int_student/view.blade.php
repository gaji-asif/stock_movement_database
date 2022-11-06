@extends('master_main')
@section('mainContent')

    <style>
        body {
            /* background: -webkit-linear-gradient(left, #38587D, #718AA8); */
        }
        table {
    table-layout: fixed;
    }
        .BreakWord { word-break: break-all; }
        .emp-profile {
            padding: 3%;
            margin-top: 3%;
            margin-bottom: 3%;
            border-radius: 0.5rem;
            background: #fff;
        }

        .profile-img {
            text-align: center;
        }

        .profile-img img {
            width: 70%;
            height: 100%;
        }

        .profile-img .file {
            position: relative;
            overflow: hidden;
            margin-top: -20%;
            width: 70%;
            border: none;
            border-radius: 0;
            font-size: 15px;
            background: #212529b8;
        }

        .profile-img .file input {
            position: absolute;
            opacity: 0;
            right: 0;
            top: 0;
        }

        .profile-head h5 {
            color: #333;
            font-size: 25px;
        }

        .profile-head h6 {
            color: #0062cc;
        }

        /* .profile-edit-btn {
            border: none;
            border-radius: 1.5rem;
            width: 70%;
            padding: 2%;
            font-weight: 600;
            color: #6c757d;
            cursor: pointer;
            } */

        .proile-rating {
            font-size: 12px;
            color: #818182;
            margin-top: 5%;
        }

        .proile-rating span {
            color: #495057;
            font-size: 15px;
            font-weight: 600;
        }

        .profile-head .nav-tabs {
            margin-bottom: 5%;
        }

        .profile-head .nav-tabs .nav-link {
            font-weight: 600;
            border: none;
        }

        .profile-head .nav-tabs .nav-link.active {
            border: none;
            border-bottom: 2px solid #0062cc;
        }

        .profile-work {
            padding: 14%;
            margin-top: -25%;
        }

        .profile-work p {
            font-size: 14px;
            color: #495057;
            font-weight: 600;
            margin-top: 8%;
            margin-bottom: 1%;
        }

        .profile-work span {
            text-decoration: none;
            color: #818182;
            font-weight: 600;
            font-size: 12px;
        }

        .profile-work ul {
            list-style: none;
        }

        .profile-tab label {
            font-weight: 600;
        }

        .profile-tab p {
            font-weight: 600;
            color: #0062cc;
        }

        .number-span {
            font-size: 2rem;
            color: #0062cc;
            font-weight: 600;
        }

    </style>

    <!------ Include the above in your HEAD tag ---------->

    <div class="container emp-profile">
        <form method="post">
            <div class="row">
                <div class="col-md-4">
                    <div class="profile-img">
                        <style type="text/css">
                            .student_image {
                                border-radius: 12px;
                            }

                        </style>
                        <img class="student_image mb-4 pb-4" src="{{ asset('images/no-image.jpg') }}" alt="" />
                        <!-- <div class="file btn btn-lg btn-primary">
                                Change Photo
                                <input type="file" name="file" />
                            </div> -->
                    </div>
                </div>
                <div class="col-md-8">
                    <div class="row">
                        <div class="col-md-12 pull-right">
                            <a href="{{ route('int_student.edit', $editData->id) }}"
                                class="btn btn-success btn-sm dtb_custom_btn_default pull-right">Edit Profile</a>
                        </div>
                    </div>
                    <div class="row">
                        <div class="profile-head">
                            <h5>
                                {{ $editData->field_5 }}
                            </h5>
                            <h6>
                                Student
                            </h6>
                            <p class="proile-rating mb-1">EMAIL : <span>{{ $editData->email }}</span></p>
                            <p class="proile-rating mt-0">PHONE : <span>{{ $editData->phone }}</span></p>
                            <ul class="nav nav-tabs mt-4" id="myTab" role="tablist">
                                <li class="nav-item">
                                    <a class="nav-link active" id="home-tab" data-toggle="tab" href="#home" role="tab"
                                        aria-controls="home" aria-selected="true">About</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" id="profile-tab" data-toggle="tab" href="#profile" role="tab"
                                        aria-controls="profile" aria-selected="false">Education</a>
                                </li>
                                {{-- @if(Session::get('role') != 3 )
                                <li class="nav-item">
                                    <a class="nav-link" id="doc-tab" data-toggle="tab" href="#doc" role="tab"
                                        aria-controls="doc" aria-selected="false">Documents</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" id="notes-tab" data-toggle="tab" href="#notes" role="tab"
                                        aria-controls="notes" aria-selected="false">Notes</a>
                                </li>
                                @elseif(Session::get('role') == 3 )  --}}
                                <li class="nav-item">
                                    <a class="nav-link" id="doc-tab" data-toggle="tab" href="#doc" role="tab"
                                        aria-controls="doc" aria-selected="false">Documents</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" id="notes-tab" data-toggle="tab" href="#notes" role="tab"
                                        aria-controls="notes" aria-selected="false">Notes</a>
                                </li>
                                {{-- @endif --}}
                                @if($isIraqStudent)
                                <li class="nav-item">
                                    <a class="nav-link" id="cutome_notes-tab" data-toggle="tab" href="#cutome_notes" role="tab"
                                        aria-controls="cutome_notes" aria-selected="false">Custom Notes</a>
                                </li>
                                @endif
                            
                            </ul>
                        </div>
                    </div>

                </div>
            </div>
            <div class="row">
                <div class="col-md-4">
                    <div class="profile-work">
                        <p>ADDRESS</p>
                        <span>{{ $editData->address }}</span><br />
                        <p>DATE OF BIRTH</p>
                        <span>{{ $editData->field_6 }}</span><br />
                        <p>GENDER</p>
                        <span>{{ $editData->gender }}</span><br />
                        <p>FIRST LANGUAGE</p>
                        <span>{{ $editData->first_lang }}</span><br />
                        <p>COUNTRY OF CITIZENSHIP</p>
                        <span>{{ $editData->country }}</span><br />
                    </div>
                </div>
                <div class="col-md-8">
                    <div class="tab-content profile-tab" id="myTabContent">
                        <div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab">
                            <div class="row">
                                <div class="col-md-6">
                                    <label>Where do you Study ?</label>
                                </div>
                                <div class="col-md-6">
                                    <p>{{ $editData->field_1 }}</p>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <label>Subject Intersted in</label>
                                </div>
                                <div class="col-md-6">
                                    <p>{{ $editData->field_2 }}</p>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <label>Which Level</label>
                                </div>
                                <div class="col-md-6">
                                    <p>{{ $editData->field_3 }}</p>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <label>How did you hear about us</label>
                                </div>
                                <div class="col-md-6">
                                    <p>{{ $editData->field_4 }}</p>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <label>Language</label>
                                </div>
                                <div class="col-md-6">
                                    <p>{{ $editData->lang }}</p>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <label>Passport Number</label>
                                </div>
                                <div class="col-md-6">
                                    <p>{{ $editData->passport_num }}</p>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12 mt-2">
                                    <label>Note</label><br />
                                    <p>{{ $editData->note }}</p>
                                </div>
                            </div>
                        </div>

                        <div class="tab-pane fade" id="profile" role="tabpanel" aria-labelledby="profile-tab">

                            @php
                                $arr = json_decode($editData->edu_summary, true);
                                $i = 1;
                            @endphp
                            @if (isset($arr) && !empty($arr))
                                @foreach ($arr as $item)

                                    <div class="row mt-4">
                                        <div class="col-md-2"> <span
                                                class="number-span">{!! $i++ !!}</span></div>
                                        <div class="col-md-10">
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <label>Institution</label>
                                                </div>
                                                <div class="col-md-6">
                                                    <p>{{ $item['edu_institution'] }}</p>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <label>Address</label>
                                                </div>
                                                <div class="col-md-6">
                                                    <p>{{ $item['edu_address'] }}</p>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <label>Start Date</label>
                                                </div>
                                                <div class="col-md-6">
                                                    <p>{{ $item['edu_start_date'] }}</p>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <label>End Date</label>
                                                </div>
                                                <div class="col-md-6">
                                                    <p>{{ $item['edu_end_date'] }}</p>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <label>Result</label>
                                                </div>
                                                <div class="col-md-6">
                                                    <p>{{ $item['edu_result'] }}</p>
                                                </div>
                                            </div>

                                        </div>
                                    </div>
                                @endforeach
                            @endif
                        </div>

                   
                        <div class="tab-pane fade  " id="doc" role="tabpanel" aria-labelledby="doc-tab">
                          @include('int_student.documents.inner_div')
                        </div>

                        <div class="tab-pane fade " id="notes" role="tabpanel" aria-labelledby="notes-tab">
                            @include('int_student.notes.inner_div')
                        </div>
                     
                        <div class="tab-pane fade " id="cutome_notes" role="tabpanel" aria-labelledby="cutome_notes-tab">
                            @include('int_student.custome_note.inner_div')
                        </div>

         

                    </div>
                </div>
            </div>
        </form>
    </div>



@endsection
