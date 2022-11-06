@extends('master_main')
@section('mainContent')
    <!-- <h4 class="font-weight-bold py-3 mb-4">
      <span class="text-muted font-weight-light"></span> Dashboard
    </h4> -->

    @php
    $common_array = [
        'content_heading' => 'Dashboard',
    ];
    @endphp
    <link rel="stylesheet" href="{{ asset('tui-editor/css/tui-editor.css') }}" />
    <link rel="stylesheet" href="{{ asset('tui-editor/css/tui-editor-contents.css') }}" />
    <style type="text/css">
        .noticeboard_wrapper {
            margin: 0 auto;

        }

      /*  .noticeboard_wrapper h1,
        h2,
        h3,
        h4,
        h5,
        h6,
        p {
            color: #FFFFFF !important;
            padding: 0px 35px;
            line-height: 20px;
        }*/

    </style>
    <div class=" mt-4">
        <div class="row">

            @if (Session::get('role') != '3')
                <div class="col-md-4">
                    <div id="accordion2 mb-2 text-center">
                        <div class="card mb-5 no_border">
                            <div id="all_projects" class="collapse show" data-parent="#accordion2" style="">
                                <ul class="list-group list-group-flush">
                                    <li class="list-group-item"
                                        style="font-weight: bold; text-align: center; font-size: 26px; padding: 15px; background-color: #fff3cd;">Total
                                        Items</li>
                                    <li class="list-group-item py-3 projectlists">

                                        <a href="{{ route('int_student.index') }}"
                                            style="display: block; font-weight: bold; text-align: center; font-size: 20px;">
                                            <div class="font-weight-semibold black_font_color text-center">
                                                {{ $items->count() }}</div>
                                        </a>
                                    </li>
                                    <a href="{{ route('items.index') }}"
                                        class="card-footer d-block text-center text-body small font-weight-semibold gray_button">VIEW
                                        ALL</a>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>


               

            @endif
            <div class="col-md-4">
                <div id="accordion2 mb-2 text-center">
                    <div class="card mb-5 no_border">
                        <div id="all_projects" class="collapse show" data-parent="#accordion2" style="">
                            <ul class="list-group list-group-flush">
                                <li class="list-group-item"
                                    style="font-weight: bold; text-align: center; font-size: 26px; padding: 15px; background-color: #fff3cd;">Total
                                    SKU</li>
                                <li class="list-group-item py-3 projectlists">

                                    <a href="#"
                                        style="display: block; font-weight: bold; text-align: center; font-size: 20px;">
                                        <div class="font-weight-semibold black_font_color text-center">
                                            {{ $all_skus->count() }}</div>
                                    </a>
                                </li>
                                <a href="{{ url('all-skus') }}"
                                    class="card-footer d-block text-center text-body small font-weight-semibold gray_button">VIEW
                                    ALL</a>
                            </ul>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
  

        @if (Session::get('role') == '0')

        @endif
  
    <!-- @if (Session::get('role') != '3')
            <div class="col-md-4">
                <div id="accordion2 mb-5 text-center">
                    <div class="card mb-5 no_border">
                        <div id="all_projects" class="collapse show" data-parent="#accordion2" style="">
                            <ul class="list-group list-group-flush">
                                <li class="list-group-item"
                                    style="font-weight: bold; text-align: center; font-size: 26px; padding: 15px;">Total
                                    Students</li>
                                <li class="list-group-item py-3 projectlists">

                                    <a href="#" style="display: block; font-weight: bold; text-align: center; font-size: 20px;">
                                        <div class="font-weight-semibold black_font_color text-center">{{ $IntStudent }}</div>
                                    </a>
                                </li>
                                <a href="{{ route('int_student.index') }}"
                                    class="card-footer d-block text-center text-body small font-weight-semibold gray_button">VIEW
                                    ALL</a>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
            @endif -->

    <style type="text/css">
        .noticeboard {
            text-align: center;
            width: 100%;
            background: #718AA8 !important;
            color: #FFFFFF !important;
            border-radius: 4px;
            margin: 0 auto;
            /* display: table; */
            padding: 11px 0px 1px;


            border-radius: 5px;


        }

        .sidenav-horizontal-next,
        .sidenav-horizontal-prev {
            display: none;
        }

    </style>
    <script>
        $(document).ready(function() {
            $(".new-datatables-demo").dataTable({
                order: [
                    [0, "desc"]
                ]
            });
        });
    </script>
@endsection
