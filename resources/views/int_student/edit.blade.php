@extends('master_main')
@section('mainContent')

@php
$int_status_1 = '<button type="submit" class="btn btn-warning ">Pending</button>';
$int_status_2 = '<button type="submit" class="btn btn-info ">Applied</button>';
$int_status_3 = '<button type="submit" class="btn btn-success  ">Completed</button>';
@endphp

<div class="container pt-5">



    @if ( Session::get('role') != '1')
    <div class="row">
        <div class="col-lg-12 mx-auto settgs_right_content">
            <div class="card mb-4 no_border">

                <div class="card-body">
                    <div class="col-xl-12 col-lg-12 col-sm-12">
                        <div class=" border-0">
                            <div class="card-header pt-0">
                                <div class="">
                                    <h3 class="card-title">{{ __('Personal Information') }}</h3>
                                    <p class="mb-2 fs-14  mt-1">(As indicated on your passport)</p>

                                </div>



                            </div>
                            <div class="card-body pb-0">
                                {{ Form::open(['class' => '', 'files' => true, 'url' => 'int_student/'.$editData->id, 'method' => 'PUT', 'enctype' => 'multipart/form-data']) }}
                                @csrf

                                <div class="row">
                                    <div class="col-sm-6 col-md-3">
                                        <div class="input-box">
                                            <div class="form-group">
                                                <label
                                                    class="form-label font-weight-bold fs-14">{{ __('Where do you study?') }}
                                                    <span class="text-muted">{{ __('*') }}</span></label>
                                                <select name="field_1" class="form-control @if ($errors->has('field_1'))
                                                        is-danger
                                                    @endif  id=" field_1">
                                                    <option value="">Select Study</option>

                                                    <option value="Canada"
                                                        {{ old('field_1', $editData->field_1)   == "Canada" ? "selected" : ""  }}>
                                                        Canada
                                                    </option>

                                                    <option value="UK"
                                                        {{ old('field_1', $editData->field_1)   == "UK" ? "selected" : ""  }}>
                                                        UK
                                                    </option>

                                                    <option value="USA"
                                                        {{ old('field_1', $editData->field_1)  == "USA" ? "selected" : ""  }}>
                                                        USA
                                                    </option>

                                                    <option value="Europe"
                                                        {{ old('field_1', $editData->field_1)  == "Europe" ? "selected" : ""  }}>
                                                        Europe
                                                    </option>
                                                </select>

                                                @if ($errors->has('field_1'))
                                                <p class="text-danger font-weight-bold">{{ $errors->first('field_1') }}
                                                </p>
                                                @endif


                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-sm-6 col-md-3">
                                        <div class="input-box">
                                            <div class="form-group">
                                                <label
                                                    class="form-label font-weight-bold fs-14">{{ __('Subject Intersted in?') }}
                                                    <span class="text-muted">{{ __('*') }}</span></label>
                                                <input type="text" class="form-control 
                                                    
                                                    @if ($errors->has('field_2'))
                                                        is-danger
                                                    @endif" name="field_2"
                                                    value="{{ old('field_2', $editData->field_2)  }}">


                                                @if ($errors->has('field_2'))
                                                <p class="text-danger font-weight-bold">{{ $errors->first('field_2') }}
                                                </p>
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-sm-6 col-md-3">
                                        <div class="input-box">
                                            <div class="form-group">
                                                <label
                                                    class="form-label font-weight-bold fs-14">{{ __('Which Level?') }}
                                                    <span class="text-muted">{{ __('*') }}</span></label>


                                                <select name="field_3" class="form-control  @if ($errors->has('field_3'))
                                                        is-danger
                                                    @endif">
                                                    <option value="">Select Which Level</option>
                                                    <option value=" HNC"
                                                        {{  old('field_3', $editData->field_3)  == "HNC" ? "selected" : ""  }}>
                                                        HNC
                                                    </option>
                                                    <option value="HND"
                                                        {{  old('field_3', $editData->field_3) == "HND" ? "selected" : ""  }}>
                                                        HND
                                                    </option>
                                                    <option value="Top-Up"
                                                        {{  old('field_3', $editData->field_3)  == "Top-Up" ? "selected" : "" }}>
                                                        Top-Up
                                                    </option>
                                                    <option value="Undergraduate"
                                                        {{  old('field_3', $editData->field_3)  == "Undergraduate" ? "selected" : ""  }}>
                                                        Undergraduate</option>
                                                    <option value="Postgraduate"
                                                        {{  old('field_3', $editData->field_3)  == "Postgraduate" ? "selected" : ""  }}>
                                                        Postgraduate
                                                    </option>
                                                </select>

                                                @if ($errors->has('field_3'))
                                                <p class="text-danger font-weight-bold">{{ $errors->first('field_3') }}
                                                </p>
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-sm-6 col-md-3">
                                        <div class="input-box">
                                            <div class="form-group">
                                                <label
                                                    class="form-label font-weight-bold fs-12">{{ __('How did you hear about us ?') }}
                                                    <span class="text-muted">{{ __('*') }}</span></label>
                                                <input type="text" class="form-control  @if ($errors->has('field_4'))
                                                    is-danger
                                                @endif" name="field_4" value="{{ $editData->field_4  }}">


                                                @if ($errors->has('field_4'))
                                                <p class="text-danger font-weight-bold">{{ $errors->first('field_4') }}
                                                </p>
                                                @endif
                                            </div>
                                        </div>
                                    </div>

                                </div>


                                <div class="row">
                                    <div class="col-sm-6 col-md-3">
                                        <div class="input-box">
                                            <div class="form-group">
                                                <label class="form-label font-weight-bold fs-14">{{ __('Full Name') }}
                                                    <span class="text-muted">{{ __('*') }}</span></label>
                                                <input type="text" class="form-control  @if ($errors->has('field_5'))
                                                    is-danger
                                                @endif" name="field_5" value="{{ $editData->field_5  }}">


                                                @if ($errors->has('field_5'))
                                                <p class="text-danger font-weight-bold">{{ $errors->first('field_5') }}
                                                </p>
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-sm-6 col-md-3">
                                        <div class="input-box">
                                            <div class="form-group">
                                                <label
                                                    class="form-label font-weight-bold fs-14">{{ __('Date of Birth') }}
                                                    <span class="text-muted">{{ __('*') }}</span></label>
                                                <input type="date" class="form-control  @if ($errors->has('field_6'))
                                                    is-danger
                                                @endif" name="field_6" value="{{ $editData->field_6  }}">
                                                @if ($errors->has('field_6'))
                                                <p class="text-danger font-weight-bold">{{ $errors->first('field_6') }}
                                                </p>
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-sm-6 col-md-3">
                                        <div class="input-box">
                                            <div class="form-group">
                                                <label class="form-label font-weight-bold fs-14">{{ __('Address') }}
                                                    <span class="text-muted">{{ __('*') }}</span></label>
                                                <input type="text" class="form-control  @if ($errors->has('address'))
                                                    is-danger
                                                @endif" name="address" value="{{ $editData->address  }}">
                                                @if ($errors->has('address'))
                                                <p class="text-danger font-weight-bold">{{ $errors->first('address') }}
                                                </p>
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-sm-6 col-md-3">
                                        <div class="input-box">
                                            <div class="form-group">
                                                <label class="form-label font-weight-bold fs-14">{{ __('Phone') }} <span
                                                        class="text-muted">{{ __('*') }}</span></label>
                                                <input type="text" class="form-control  @if ($errors->has('phone'))
                                                    is-danger
                                                @endif" name="phone" value="{{ $editData->phone  }}">
                                                @if ($errors->has('phone'))
                                                <p class="text-danger font-weight-bold">{{ $errors->first('phone') }}
                                                </p>
                                                @endif
                                            </div>
                                        </div>
                                    </div>

                                </div>

                                <div class="row">
                                    <div class="col-sm-6 col-md-3">
                                        <div class="input-box">
                                            <div class="form-group">
                                                <label class="form-label font-weight-bold fs-14">{{ __('Email') }} <span
                                                        class="text-muted">{{ __('*') }}</span></label>
                                                <input type="text" class="form-control  @if ($errors->has('email'))
                                                    is-danger
                                                @endif" name="email" value="{{ $editData->email  }}">
                                                @if ($errors->has('email'))
                                                <p class="text-danger font-weight-bold">{{ $errors->first('email') }}
                                                </p>
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-sm-6 col-md-3">
                                        <div class="input-box">
                                            <div class="form-group">
                                                <label class="form-label font-weight-bold fs-14">{{ __('Gender') }}
                                                    <span class="text-muted">{{ __('*') }}</span></label>


                                                <div>
                                                    <div class="form-check form-check-inline">
                                                        <input class="form-check-input  " type="checkbox" value="Male"
                                                            name="gender"
                                                            {{ (($editData->gender)  == "Male" ? "checked" : "")  }}>
                                                        <label class="form-check-label fs-14">Male</label>
                                                    </div>

                                                    <div class="form-check form-check-inline">
                                                        <input class="form-check-input " type="checkbox" value="Female"
                                                            name="gender"
                                                            {{ (($editData->gender) == "Female" ? "checked" : "")  }}>
                                                        <label class="form-check-label fs-14">Female</label>
                                                    </div>

                                                </div>


                                                @if ($errors->has('gender'))
                                                <p class="text-danger font-weight-bold">{{ $errors->first('gender') }}
                                                </p>
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-sm-6 col-md-3">
                                        <div class="input-box">
                                            <div class="form-group">
                                                <label
                                                    class="form-label font-weight-bold fs-14">{{ __('First Language') }}
                                                    <span class="text-muted">{{ __('*') }}</span></label>
                                                <input type="text" class="form-control  @if ($errors->has('first_lang'))
                                                    is-danger
                                                @endif" name="first_lang" value="{{ $editData->first_lang}}">

                                                @if ($errors->has('first_lang'))
                                                <p class="text-danger font-weight-bold">
                                                    {{ $errors->first('first_lang') }}</p>
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-sm-6 col-md-3">
                                        <div class="input-box">
                                            <div class="form-group">
                                                <label
                                                    class="form-label font-weight-bold fs-14">{{ __('Country of Citizenship') }}
                                                    <span class="text-muted">{{ __('*') }}</span></label>

                                                <select class="form-control  @if ($errors->has('country'))
                                                        is-danger
                                                    @endif" name="country">
                                                    <option value=""> Select Country </option>

                                                    @foreach($countries as $country)
                                                    {{-- <option value="{{$country->name}}"> {{$country->name}}
                                                    </option> --}}


                                                    @if ($editData->country == $country->name)
                                                    <option value="{{ $country->name }}" selected>{{$country->name }}
                                                    </option>
                                                    @else
                                                    <option value="{{ $country->name }}">{{$country->name }}</option>
                                                    @endif
                                                    @endforeach
                                                </select>

                                                @if ($errors->has('country'))
                                                <p class="text-danger font-weight-bold">{{ $errors->first('country') }}
                                                </p>
                                                @endif
                                            </div>
                                        </div>
                                    </div>

                                </div>

                                <div class="row">
                                    <div class="col-sm-6 col-md-3">
                                        <div class="input-box">
                                            <div class="form-group">
                                                <label
                                                    class="form-label font-weight-bold fs-14">{{ __('Passport Number') }}
                                                    <span class="text-muted">{{ __('*') }}</span></label>
                                                <input type="text" class="form-control  @if ($errors->has('passport_num'))
                                                        is-danger
                                                    @endif" name="passport_num" value="{{ $editData->passport_num }}">


                                                @if ($errors->has('passport_num'))
                                                <p class="text-danger font-weight-bold">
                                                    {{ $errors->first('passport_num') }}</p>
                                                @endif
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-sm-6 col-md-3">
                                        <div class="input-box">
                                            <div class="form-group">
                                                <label
                                                    class="form-label font-weight-bold fs-14">{{ __('Select Intake') }}
                                                    <span class="text-muted">{{ __('*') }}</span></label>
                                                <select name="month" class="form-control  @if ($errors->has('month'))
                                                        is-danger
                                                    @endif">
                                                    <option value="">Select Intake</option>
                                                    {{-- <option value="January 21"
                                                        {{ (old("month",$editData->month) == "January 21" ? "selected" : "" ) }}>
                                                        January 21</option>
                                                    <option value="April 21"
                                                        {{ (old("month",$editData->month) == "April 21" ? "selected" : "" ) }}>
                                                        April 21</option>
                                                    <option value="September 21"
                                                        {{ (old("month",$editData->month) == "September 21" ? "selected" : "" ) }}>
                                                        September 21</option> --}}
                                                        <option value="January"{{ (old("month",$editData->month) == "January" ? "selected" : "" ) }}>January</option>
                                                        <option value="February"{{ (old("month",$editData->month) == "February" ? "selected" : "" ) }}>February</option>
                                                        <option value="March" {{ (old("month",$editData->month) == "March" ? "selected" : "" ) }}>March</option>
                                                        <option value="April" {{ (old("month",$editData->month) == "April" ? "selected" : "" ) }}>April</option>
                                                        <option value="May" {{ (old("month",$editData->month) == "May" ? "selected" : "" ) }}>May</option>
                                                        <option value="June"{{ (old("month",$editData->month) == "June" ? "selected" : "" ) }}>June</option>
                                                        <option value="July" {{ (old("month",$editData->month) == "July" ? "selected" : "" ) }}>July</option>
                                                        <option value="August" {{ (old("month",$editData->month) == "August" ? "selected" : "" ) }}>August</option>
                                                        <option value="Septembar" {{ (old("month",$editData->month) == "Septembar" ? "selected" : "" ) }}>Septembar</option>
                                                        <option value="Octobar" {{ (old("month",$editData->month) == "Octobar" ? "selected" : "" ) }}>Octobar</option>
                                                        <option value="Novembar" {{ (old("month",$editData->month) == "Novembar" ? "selected" : "" ) }}>Novembar</option>
                                                        <option value="Decembar" {{ (old("month",$editData->month) == "Decembar" ? "selected" : "" ) }}>Decembar</option>
                                                </select>
                                                @if ($errors->has('month'))
                                                <p class="text-danger font-weight-bold">{{ $errors->first('month') }}
                                                </p>
                                                @endif
                                            </div>
                                        </div>

                                    </div>

                                    <div class="col-sm-6 col-md-3">
                                        <div class="input-box">
                                            <div class="form-group">
                                                <label class="form-label font-weight-bold fs-14">{{ __('Year') }}
                                                    <span class="text-muted">{{ __('*') }}</span></label>
                                                {{-- <input type="text"
                                                    class="form-control  @if ($errors->has('year'))
                                                    is-danger
                                                @endif"
                                                    name="year" value="{{ old('year') }}"> --}}
                                                <select name="year" class="form-control  @if ($errors->has('year'))
                                                        is-danger
                                                    @endif">
                                                    <option value="">Select Year</option>
                                                    <option value="2015"
                                                        {{ (old("year" , $editData->year) == "2015" ? "selected" : "" ) }}>
                                                        2015</option>
                                                    <option value="2016"
                                                        {{ (old("year", $editData->year) == "2016" ? "selected" : "" ) }}>
                                                        2016</option>
                                                    <option value="2017"
                                                        {{ (old("year", $editData->year) == "2017" ? "selected" : "" ) }}>
                                                        2017</option>
                                                    <option value="2018"
                                                        {{ (old("year", $editData->year) == "2018" ? "selected" : "" ) }}>
                                                        2018</option>
                                                    <option value="2019"
                                                        {{ (old("year", $editData->year) == "2019" ? "selected" : "" ) }}>
                                                        2019</option>
                                                    <option value="2020"
                                                        {{ (old("year", $editData->year) == "2020" ? "selected" : "" ) }}>
                                                        2020</option>
                                                    <option value="2021"
                                                        {{ (old("year", $editData->year) == "2021" ? "selected" : "" ) }}>
                                                        2021</option>
                                                    <option value="2022"
                                                        {{ (old("year", $editData->year) == "2022" ? "selected" : "" ) }}>
                                                        2022</option>
                                                        <option value="2023" {{ (old("year") == "2023" ? "selected" : "" ) }}>2023</option>
                                                    <option value="2024" {{ (old("year", $editData->year) == "2024" ? "selected" : "" ) }}>2024</option>
                                                    <option value="2025" {{ (old("year", $editData->year) == "2025" ? "selected" : "" ) }}>2025</option>
                                                    <option value="2026" {{ (old("year", $editData->year) == "2026" ? "selected" : "" ) }}>2026</option>
                                                    <option value="2027" {{ (old("year", $editData->year) == "2027" ? "selected" : "" ) }}>2027</option>
                                                    <option value="2028" {{ (old("year", $editData->year) == "2028" ? "selected" : "" ) }}>2028</option>
                                                    <option value="2029" {{ (old("year", $editData->year) == "2029" ? "selected" : "" ) }}>2029</option>
                                                    <option value="2030" {{ (old("year", $editData->year) == "2030" ? "selected" : "" ) }}>2030</option>
                                                    <option value="2031" {{ (old("year", $editData->year) == "2031" ? "selected" : "" ) }}>2031</option>
                                                    <option value="2032" {{ (old("year", $editData->year) == "2032" ? "selected" : "" ) }}>2032</option>
                                                    <option value="2033" {{ (old("year", $editData->year) == "2033" ? "selected" : "" ) }}>2033</option>
                                                    <option value="2034" {{ (old("year", $editData->year) == "2034" ? "selected" : "" ) }}>2034</option>
                                                    <option value="2035" {{ (old("year", $editData->year) == "2035" ? "selected" : "" ) }}>2035</option>
                                                    <option value="2036" {{ (old("year", $editData->yearV) == "2036" ? "selected" : "" ) }}>2036</option>
                                                    <option value="2037" {{ (old("year", $editData->year) == "2037" ? "selected" : "" ) }}>2037</option>
                                                    <option value="2038" {{ (old("year", $editData->year) == "2038" ? "selected" : "" ) }}>2038</option>
                                                    <option value="2039" {{ (old("year", $editData->year) == "2039" ? "selected" : "" ) }}>2039</option>
                                                    <option value="2040" {{ (old("year", $editData->year) == "2040" ? "selected" : "" ) }}>2040</option>
                                                </select>

                                                @if ($errors->has('year'))
                                                <p class="text-danger font-weight-bold">{{ $errors->first('year') }}</p>
                                                @endif
                                            </div>
                                        </div>
                                    </div>

                                </div>

                                <div class="row border-top pt-4 mt-3">
                                    <div class="col-sm-6 col-md-3">
                                        <div class="input-box">
                                            <div class="form-group">
                                                <label class="form-label font-weight-bold ">{{ __('Language') }} <span
                                                        class="text-muted">{{ __('*') }}</span></label>
                                                <select class="form-control  @if ($errors->has('lang'))
                                                        is-danger
                                                    @endif" name="lang">
                                                    <option value="">Select Language</option>

                                                    <option value="I don't have this"
                                                        {{ $editData->lang == "I don't have this" ? "selected" : ""  }}>
                                                        I don't
                                                        have this</option>

                                                    <option value="IELTS"
                                                        {{ $editData->lang == "IELTS" ? "selected" : ""  }}>
                                                        IELTS</option>

                                                    <option value="TOEFL"
                                                        {{ $editData->lang == "TOEFL" ? "selected" : ""  }}>
                                                        TOEFL</option>

                                                    <option value="Duolingo English Test"
                                                        {{ $editData->lang == "Duolingo English Test" ? "selected" : ""  }}>
                                                        Duolingo English Test</option>

                                                </select>


                                                @if ($errors->has('lang'))
                                                <p class="text-danger font-weight-bold">{{ $errors->first('lang') }}</p>
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                </div>








                                <div class="row  ">
                                    <div class="col-sm-12 col-md-12">

                                        <div class="form-group ">
                                            <label
                                                class="form-label fs-14 font-weight-bold">{{ __('Education Summary') }}
                                            </label>
                                        </div>

                                        @php

                                        $arr = json_decode($editData->edu_summary,true);


                                        @endphp

                                        <div class="edu_wrapper">
                                            <div class="row">
                                                @if (isset($arr) && !empty($arr))
                                                @foreach ($arr as $item )

                                                <div class="col-sm-11 col-md-11">
                                                    <div class="row border pt-2 ">
                                                        <div class="col-sm-6 col-md-2">
                                                            <div class="input-box">
                                                                <div class="form-group">
                                                                    <label class="form-label fs-12">Institution
                                                                        <span class="text-muted">*</span></label>
                                                                    <textarea class="form-control pt-0 pb-1 pl-2 pr-2 "
                                                                        name="edu_institution[]"
                                                                        placeholder="Educational Instituation">{{ $item['edu_institution'] }} </textarea>

                                                                </div>
                                                            </div>
                                                        </div>

                                                        <div class="col-sm-6 col-md-2">
                                                            <div class="input-box">
                                                                <div class="form-group">
                                                                    <label class="form-label fs-12">Address <span
                                                                            class="text-muted">*</span></label>
                                                                    <textarea class="form-control pt-0 pb-1 pl-2 pr-2 "
                                                                        name="edu_address[]"
                                                                        placeholder="Enter Address">{{ $item['edu_address'] }} </textarea>

                                                                </div>
                                                            </div>
                                                        </div>

                                                        <div class="col-sm-6 col-md-3">
                                                            <div class="input-box">
                                                                <div class="form-group">
                                                                    <label class="form-label fs-12">Start Date <span
                                                                            class="text-muted">*</span></label>
                                                                    <input type="date"
                                                                        class="form-control pt-1 pb-1 pl-2 pr-2 "
                                                                        name="edu_start_date[]"
                                                                        value="{{$item['edu_start_date']}}">

                                                                </div>
                                                            </div>
                                                        </div>

                                                        <div class="col-sm-6 col-md-3">
                                                            <div class="input-box">
                                                                <div class="form-group">
                                                                    <label class="form-label fs-12">End Date <span
                                                                            class="text-muted">*</span></label>
                                                                    <input type="date"
                                                                        class="form-control pt-1 pb-1 pl-2 pr-2 "
                                                                        name="edu_end_date[]"
                                                                        value="{{ $item['edu_end_date']}}">

                                                                </div>
                                                            </div>
                                                        </div>

                                                        <div class="col-sm-6 col-md-2">
                                                            <div class="input-box">
                                                                <div class="form-group">
                                                                    <label class="form-label fs-12">Result <span
                                                                            class="text-muted">*</span></label>
                                                                    <textarea type="text"
                                                                        class="form-control pt-0 pb-1 pl-2 pr-2 "
                                                                        name="edu_result[]"
                                                                        placeholder="Enter Result">{{ $item['edu_result'] }} </textarea>

                                                                </div>
                                                            </div>
                                                        </div>

                                                    </div>
                                                </div>

                                                @endforeach

                                                @else

                                                <div class="col-sm-11 col-md-11">
                                                    <div class="row border pt-2 ">


                                                        <div class="col-sm-6 col-md-2">
                                                            <div class="input-box">
                                                                <div class="form-group">
                                                                    <label class="form-label fs-12">Institution
                                                                        <span class="text-muted">*</span></label>
                                                                    <textarea class="form-control pt-0 pb-1 pl-2 pr-2 "
                                                                        name="edu_institution[]"
                                                                        placeholder="Educational Instituation"></textarea>

                                                                </div>
                                                            </div>
                                                        </div>

                                                        <div class="col-sm-6 col-md-2">
                                                            <div class="input-box">
                                                                <div class="form-group">
                                                                    <label class="form-label fs-12">Address <span
                                                                            class="text-muted">*</span></label>
                                                                    <textarea class="form-control pt-0 pb-1 pl-2 pr-2 "
                                                                        name="edu_address[]"
                                                                        placeholder="Enter Address"></textarea>

                                                                </div>
                                                            </div>
                                                        </div>

                                                        <div class="col-sm-6 col-md-3">
                                                            <div class="input-box">
                                                                <div class="form-group">
                                                                    <label class="form-label fs-12">Start Date <span
                                                                            class="text-muted">*</span></label>
                                                                    <input type="date"
                                                                        class="form-control pt-1 pb-1 pl-2 pr-2 "
                                                                        name="edu_start_date[]">

                                                                </div>
                                                            </div>
                                                        </div>

                                                        <div class="col-sm-6 col-md-3">
                                                            <div class="input-box">
                                                                <div class="form-group">
                                                                    <label class="form-label fs-12">End Date <span
                                                                            class="text-muted">*</span></label>
                                                                    <input type="date"
                                                                        class="form-control pt-1 pb-1 pl-2 pr-2 "
                                                                        name="edu_end_date[]">

                                                                </div>
                                                            </div>
                                                        </div>

                                                        <div class="col-sm-6 col-md-2">
                                                            <div class="input-box">
                                                                <div class="form-group">
                                                                    <label class="form-label fs-12">Result <span
                                                                            class="text-muted">*</span></label>
                                                                    <textarea type="text"
                                                                        class="form-control pt-0 pb-1 pl-2 pr-2 "
                                                                        name="edu_result[]"
                                                                        placeholder="Enter Result"></textarea>

                                                                </div>
                                                            </div>
                                                        </div>

                                                    </div>
                                                </div>





                                                @endif
                                                <div class="col-sm-1 col-md-1">
                                                    <div class="btn btn-secondary add_edu_button">+</div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>


                                </div>


                                <div class="row pt-4 mt-3">
                                    <div class="col-sm-6 col-md-6">
                                        <div class="input-box">
                                            <div class="form-group">
                                                <label class="form-label font-weight-bold fs-14">{{ __('CV') }} <span
                                                        class="text-muted">{{ __('*') }}</span></label>
                                                <input type="file" class=" form-control-file" name="cv">
                                                @if ($errors->has('cv'))
                                                <p class="text-danger font-weight-bold">{{ $errors->first('cv') }}</p>
                                                @endif
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-sm-6 col-md-6">
                                        <div class="input-box">
                                            <div class="form-group">
                                                <label
                                                    class="form-label font-weight-bold fs-14">{{ __('Copy of passport') }}
                                                    <span class="text-muted">{{ __('*') }}</span></label>
                                                <input type="file" class=" form-control-file" name="cp_passport">
                                                @if ($errors->has('cp_passport'))
                                                <p class="text-danger font-weight-bold">
                                                    {{ $errors->first('cp_passport') }}</p>
                                                @endif
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-sm-6 col-md-6">
                                        <div class="input-box">
                                            <div class="form-group">
                                                <label
                                                    class="form-label font-weight-bold fs-14">{{ __('SSC/O Levels certificate & Transcript') }}
                                                    <span class="text-muted">{{ __('*') }}</span></label>
                                                <input type="file" class=" form-control-file" name="cer_1">
                                                @if ($errors->has('cer_1'))
                                                <p class="text-danger font-weight-bold">{{ $errors->first('cer_1') }}
                                                </p>
                                                @endif
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-sm-6 col-md-6">
                                        <div class="input-box">
                                            <div class="form-group">
                                                <label
                                                    class="form-label font-weight-bold fs-14">{{ __('HSC/A Levels certificate & Transcript') }}
                                                    <span class="text-muted">{{ __('*') }}</span></label>
                                                <input type="file" class=" form-control-file" name="cer_2">
                                                @if ($errors->has('cer_2'))
                                                <p class="text-danger font-weight-bold">{{ $errors->first('cer_2') }}
                                                </p>
                                                @endif
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-sm-12 col-md-12">
                                        <div class="input-box">
                                            <div class="form-group">
                                                <label
                                                    class="form-label font-weight-bold fs-14">{{ __('Bachelor degree certificate & Transcript For Master Application ') }}
                                                    <span class="text-muted">{{ __('*') }}</span></label>
                                                <input type="file" class=" form-control-file" name="cer_3">

                                                @if ($errors->has('cer_3'))
                                                <p class="text-danger font-weight-bold">{{ $errors->first('cer_3') }}
                                                </p>
                                                @endif
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-sm-6 col-md-6">
                                        <div class="input-box">
                                            <div class="form-group">
                                                <label
                                                    class="form-label font-weight-bold fs-14">{{ __('IELTS/ TOEFL/ Other') }}
                                                    <span class="text-muted">{{ __('*') }}</span></label>
                                                <input type="file" class=" form-control-file" name="cer_4">


                                                @if ($errors->has('field_1'))
                                                <p class="text-danger font-weight-bold">{{ $errors->first('cer_4') }}
                                                </p>
                                                @endif
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-sm-6 col-md-6">
                                        <div class="input-box">
                                            <div class="form-group">
                                                <label
                                                    class="form-label font-weight-bold fs-14">{{ __('Personal Statement') }}
                                                    <span class="text-muted">{{ __('*') }}</span></label>
                                                <input type="file" class=" form-control-file" name="cer_5">


                                                @if ($errors->has('cer_5'))
                                                <p class="text-danger font-weight-bold">{{ $errors->first('cer_5') }}
                                                </p>
                                                @endif
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-sm-12 col-md-12">
                                        <div class="input-box">
                                            <div class="form-group">
                                                <label
                                                    class="form-label font-weight-bold fs-14">{{ __('Job reference letter if there is any study gap upto 3 years') }}
                                                    <span class="text-muted">{{ __('*') }}</span></label>
                                                <input type="file" class=" form-control-file" name="cer_6">

                                                @if ($errors->has('cer_6'))
                                                <p class="text-danger font-weight-bold">{{ $errors->first('cer_6') }}
                                                </p>
                                                @endif
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-sm-12 col-md-12">
                                        <div class="input-box">
                                            <div class="form-group">
                                                <label
                                                    class="form-label font-weight-bold fs-14">{{ __('Two academic reference letters including the referees name, position, address, company email & phone number on the official letterhead.') }}
                                                    <span class="text-muted">{{ __('*') }}</span></label>
                                                <input type="file" class=" form-control-file  " name="cer_7">

                                                @if ($errors->has('cer_7'))
                                                <p class="text-danger font-weight-bold">
                                                    {{ $errors->first('cer_7') }}</p>
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-sm-6 col-md-6">
                                        <div class="input-box">
                                            <div class="form-group">
                                                <label class="form-label font-weight-bold ">{{ __('Note') }} </label>
                                                <textarea rows="4" cols="50" class="form-control 
                                                         @if ($errors->has('note'))
                                                        is-danger
                                                    @endif" name="note">{{ $editData->note}}</textarea>

                                                @if ($errors->has('note'))
                                                <p class="text-danger font-weight-bold">{{ $errors->first('note') }}</p>
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                {{-- <div class="row">
                                        <div class="col-sm-6 col-md-6">
                                            <div class="input-box">
                                                <div class="form-group">
                                                    <input type="checkbox" class="  @if ($errors->has('term_agree'))  is-danger @endif"
                                                        name="term_agree">
            
                                                    <label
                                                        class="form-label font-weight-bold ">{{ __('I agree to the terms and conditions & privacy policy') }}
                                </label>

                                @if ($errors->has('term_agree'))
                                <p class="text-danger font-weight-bold">{{ $errors->first('term_agree') }}</p>
                                @endif
                            </div>
                        </div>
                    </div>
                </div> --}}


                <div class="card-footer border-0 text-right mb-2 pr-0">
                    <a href="{{route('int_student.index')}}" class="btn btn-danger mr-2">{{ __('Return') }}</a>
                    <button type="submit" class="btn btn-success">{{ __('Update') }}</button>
                </div>
                {{ Form::close()}}
            </div>
        </div>
    </div>

    @elseif ( Session::get('role') == '1')
    <div class="row">
        <div class="col-lg-6 mx-auto settgs_right_content">
            <div class="card mb-4 no_border">
                <div class="card-body">
                    <div class="col-xl-12 col-lg-12 col-sm-12">
                        <div class=" border-0">
                            <div class="card-header pt-0">
                                <div class="">
                                    <h3 class="card-title">{{ __('Update student Information') }}</h3>
                                </div>
                            </div>

                            <div class=" mt-4 mb-4">
                                {{ Form::open(['class' => 'form-horizontal', 'files' => true, 'url' => 'student_status_change',
                                'method' => 'POST', 'enctype' => 'multipart/form-data']) }}


                                <input type="hidden" name="student_id" value="{{ $editData->id }}">

                                <div class="form-group row">
                                    <label for="" class="col-md-4 col-sm-6 mt-2 pl-4 ">Course Title</label>
                                    <div class="col-md-8 col-sm-6">
                                        <input type="text" class="form-control" name="course_title" value="{{ $editData->course_title }}">
                                    </div>
                                </div>

                                <div class="form-group row mt-4">
                                    <label for="" class="col-md-4 col-sm-6 mt-2 pl-4 ">Admission Date</label>
                                    <div class="col-md-8 col-sm-6">
                                        <input type="date" class="form-control" name="admission_date" value="{{ $editData->admission_date }}">
                                    </div>
                                </div>

                                <div class="form-group row mt-4">
                                    <label for="" class="col-md-4 col-sm-6 mt-2 pl-4 ">University</label>
                                    <div class="col-md-8 col-sm-6">
                                        <input type="text" name="uni_name" id="search_uni" class="form-control "
                                            placeholder="Select University" value="{{ $editData->university }}" />
                                        <div id="uniList"> </div>
                                        <input type="hidden" name="_token" id="csrf" value="{{csrf_token()}}">
                                        <p class="text-danger" id="added_status">
                                        </p>
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label for="" class="col-md-4 col-sm-6 mt-2 pl-4 ">Status</label>
                                    <div class="col-md-8 col-sm-6">
                                        <select class="form-control " name="new_status">
                                            <option value="">Select Status</option>
                                            <option value="1" {!! ( ( $editData->status == "1" ) ? "selected" : "" )
                                                !!}>Pending
                                            </option>
                                            <option value="2" {!! ( ( $editData->status == "2" ) ? "selected" : "" )
                                                !!}>Submitted </option>
                                            <option value="3" {!! ( ( $editData->status == "3" ) ? "selected" : "" )
                                                !!}>Offer
                                                Issued </option>
                                            <option value="4" {!! ( ( $editData->status == "4" ) ? "selected" : "" )
                                                !!}>Visa
                                                Received </option>
                                        </select>
                                    </div>
                                </div>


                            </div>
                            <div class="text-center ml-4">
                                <button type="submit" class="btn btn-success">{{ __('Submit') }}</button>
                                <a href="{{route('int_student.index')}}"
                                    class="btn btn-danger mr-2">{{ __('Return') }}</a>
                            </div>


                            {{ Form::close()}}

                        </div>

                    </div>
                </div>
            </div>
            @endif

        </div>
    </div>
</div>

</div>
</div>
</div>
</div>
@endsection

<script src="{{asset('assets/js/jquery.js')}}"></script>


<script>
    //    adding university
    $(document).on('click', '#add_uni', function () {
        var name = $('#search_uni').val();
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $.ajax({
            type: "post",
            url: "{{ url('/addUni') }}",
            data: {
                _token: $("#csrf").val(),
                name: name
            },
            cache: false,
            success: function (response) {
                if (response.success) {
                    //   alert(response.message) //Message come from controller
                    $('#added_status').html(response.message)
                } else {
                    $('#added_status').html('University not added')
                }
            },
            error: function (error) {
                $('#added_status').html('University not added')
                console.log(error)
            }
        });
    });


    $(document).ready(function () {
        $('#search_uni').keyup(function () {
            var query = $(this).val();
            if (query != '') {
                var _token = $('input[name="_token"]').val();
                $.ajax({
                    url: "{{ url('/autocomplete-search') }}",
                    method: "POST",
                    data: {
                        query: query,
                        _token: _token
                    },
                    success: function (data) {
                        $('#uniList').fadeIn();
                        $('#uniList').html(data);
                    }
                });
            }

        });


        $(document).on('click', 'li', function () {
            $('#search_uni').val($(this).text());
            $('#uniList').fadeOut();
        });


        var y = 1;
        var maxField = 6; //Input fields increment limitation


        $('.add_edu_button').click(function () {
            console.log('hi')
            if (y < maxField) {
                y++;

                $('.edu_wrapper').append(
                    ' <div class="row"> <div class="col-sm-11 col-md-11"> <div class="row border pt-2 "> <div class="col-sm-6 col-md-2"> <div class="input-box"> <div class="form-group"> <label class="form-label fs-12">Institution<span class="text-muted">*</span></label> <textarea class="form-control pt-0 pb-1 pl-2 pr-2 " name="edu_institution[]" placeholder="Educational Instituation"></textarea> </div> </div> </div> <div class="col-sm-6 col-md-2"> <div class="input-box"> <div class="form-group"> <label class="form-label fs-12">Address <span class="text-muted">*</span></label> <textarea class="form-control pt-0 pb-1 pl-2 pr-2 " name="edu_address[]" placeholder="Enter Address"></textarea> </div> </div> </div> <div class="col-sm-6 col-md-3"> <div class="input-box"> <div class="form-group"> <label class="form-label fs-12">Start Date <span class="text-muted">*</span></label> <input type="date" class="form-control pt-1 pb-1 pl-2 pr-2 " name="edu_start_date[]" > </div> </div> </div> <div class="col-sm-6 col-md-3"> <div class="input-box"> <div class="form-group"> <label class="form-label fs-12">End Date <span class="text-muted">*</span></label> <input type="date" class="form-control pt-1 pb-1 pl-2 pr-2 " name="edu_end_date[]" > </div> </div> </div> <div class="col-sm-6 col-md-2"> <div class="input-box"> <div class="form-group"> <label class="form-label fs-12">Result <span class="text-muted">*</span></label> <textarea type="text" class="form-control pt-0 pb-1 pl-2 pr-2 " name="edu_result[]" placeholder="Enter Result"></textarea> </div> </div> </div> </div> </div> <div class="col-sm-1 col-md-1"> <div class="btn btn-secondary remove_edu_button">-</div> </div> </div>'
                );

            }
        });

        $('.edu_wrapper').on('click', '.remove_edu_button', function (e) {
            // e.preventDefault();
            console.log('ji');
            $(this).parent('div').parent('div').remove(); //Remove field html
            y--; //Decrement field counter
        });

        // auto complete


    });

</script>
