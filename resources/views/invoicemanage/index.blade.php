@extends('master_main')
@section('mainContent')
<style type="text/css">
  .project_details:hover{
      background-color: #FFD950;
  }




</style>

{{-- <link rel="stylesheet" href="https://cdn.datatables.net/1.10.21/css/jquery.dataTables.min.css">
<link rel="stylesheet" href="https://cdn.datatables.net/responsive/2.2.5/css/responsive.dataTables.min.css">
<script src="https://cdn.datatables.net/1.10.21/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/responsive/2.2.5/js/dataTables.responsive.min.js"></script> --}}

<div class="test mt-5">

<div class="card mb-4">
   <div class="card-datatable pt-3">
        <div class="row">
        <div class="col-sm-12 col-md-12">

<!-- ##########  PROFIT TABLE CODE STARTS ############## -->

            <table class="table card-table table-bordered table-striped dtb_custom_tbl_common" id="workingdaytbl">
            <h5>Porfit Table</h5>
            <thead>
                <tr>
                    <th></th>
                    <?php
                    for ($i = 12; $i > 0; $i--) { ?>
                    <th> <?php  echo $months[] = date("Y/m", strtotime( date( 'Y-m-01' )." -$i months")); ?></th>
                    <?php } ?>
                    <th>Total</th>
                </tr>
            </thead>
            <tbody>

            <?php
                $developer_id = Session::get('developer_id');

                $projectofdev = DB::select(DB::raw("
                    SELECT ii.project_id,pr.project_name
                    FROM dtb_invoice_items ii
                    LEFT JOIN dtb_projects pr ON ii.project_id = pr.id
                    LEFT JOIN dtb_invoices inv ON ii.invoice_id = inv.id
                    WHERE inv.developer_id = $developer_id group by ii.project_id"
                ));



            ?>

            @foreach($projectofdev as $devproject)

                    <?php

                    // dtb_invoices,dtb_invoice_items,dtb_costs
                    // invoice and item table have relation based on invoice id and item tbl invoice id,
                    // get invoice id with date then get item amount and projectid creating relation with invoice id and date
                    // then get cost tbl subtotal based on billing date project id creating relation between item tbl projectid and cost tbl project id
                    // scenarion : matching cost table project id and billing date with item tbl project id and invoice tbl date
                        // item table project id and date can mathed with cost table poroject id date
                        //  specific month item value can be found but can be emptuy cost amount
                        // reversly cost amount can be found but invoice amount can be empty
                        //both cannot can be empty

                    $total_profits = 0;
                    $finalprofitall=0;
                    $finalprofitrate=0;

                    $total_cost = 0;
                       $projectprofit = DB::select(DB::raw("SELECT
                        dtb_invoices.id, Date_format(dtb_invoices.invoice_date, '%Y/%m') as invoice_year_month,
                        dtb_invoice_items.invoice_id, dtb_invoice_items.project_id, sum(dtb_invoice_items.amount) as calculated_total
                        FROM dtb_invoices
                        LEFT JOIN dtb_invoice_items on dtb_invoices.id = dtb_invoice_items.invoice_id
                        WHERE dtb_invoice_items.project_id = $devproject->project_id
                        GROUP BY invoice_year_month"
                        ));
                    ?>

                    <tr>
                    <th class="titletd" width="190px">{{ $devproject->project_name ?? '' }}</th>
                        <?php if (isset($projectprofit)) {
                            for ($i = 12; $i > 0; $i--)
                            {
                            $monthgenerated = date("Y/m", strtotime( date( 'Y-m-01' )." -$i months")); ?>
                            <?php $j=0; ?>
                            @foreach ($projectprofit as $proprofit)

                                @if($monthgenerated == $proprofit->invoice_year_month)
                                    <?php $j++; ?>

                                    <th>
                                    <?php

                                        $costres = DB::select(DB::raw("SELECT dtb_costs.id, Date_format(dtb_costs.billing_date, '%Y/%m') as cost_year_month, dtb_costs.project_id, sum(dtb_costs.sub_total) as calculated_sub_total
                                        FROM dtb_costs
                                        where dtb_costs.project_id = $proprofit->project_id
                                        AND Date_format(dtb_costs.billing_date, '%Y/%m') = '$proprofit->invoice_year_month' GROUP BY cost_year_month"
                                        ));

                                        if (empty($costres)) { ?>

                                                <div class="dataholder">

                                                    @if($proprofit->calculated_total == 0)
                                                        {{-- both not found --}}
                                                        <span>0</span>
                                                        <span>0</span>
                                                    @else
                                                    {{-- cost not found but item amount found --}}
                                                    <?php
                                                        $total_profits = $total_profits + $proprofit->calculated_total;
                                                        $total_cost = $total_cost + 0;
                                                        $finalprofitall = $total_profits - $total_cost;
                                                        $finalprofitrate = $finalprofitall / $total_profits;
                                                    ?>

                                                        <span>{{$profit = ($proprofit->calculated_total - 0)}}</span>
                                                        <span>1</span>

                                                    @endif
                                                </div>


                                       <?php }else{

                                            //both matched

                                            foreach ($costres as $costresult){

                                                if(empty($proprofit->calculated_total)){
                                                    $finalinvtotal = 0;
                                                }else{
                                                    $finalinvtotal = $proprofit->calculated_total;
                                                }

                                                if(empty($costresult->calculated_sub_total)){
                                                    $finalcosttotal = 0;
                                                }else{
                                                    $finalcosttotal = $costresult->calculated_sub_total;
                                                }

                                            ?>
                                                <div class="dataholder">
                                                <?php
                                                    $total_profits = $total_profits + $finalinvtotal;
                                                    $total_cost = $total_cost + $finalcosttotal;
                                                    $finalprofitall = $total_profits - $total_cost;
                                                    $finalprofitrate = $finalprofitall / $total_profits;
                                                ?>
                                                    <span>{{$profit = ($finalinvtotal - $finalcosttotal)}}</span>
                                                    @if ($finalinvtotal == 0)
                                                         <span>0</span>
                                                    @else
                                                    <span>{{$profitrate = ($profit / $finalinvtotal)}}</span>
                                                    @endif
                                                </div>

                                           <?php


                                            }


                                        }
                                        ?>

                                        </th>
                                    @endif

                            @endforeach
                            <?php if( $j ==0){ ?>
                                <th></th>
                            <?php  }
                            }

                    } ?>


                    <th>
                     <div class="dataholder">
                        {{-- total data summery --}}
                        <span>{{ $finalprofitall }}</span>
                        <span>{{ $finalprofitrate }}</span>
                     </div>
                    </th>
                </tr>

            @endforeach

<!-- ##########  PROFIT TABLE CODE ENDS ############## -->

            </tbody>
            </table>



        </div>
        </div>
    </div>
</div>



<div class="card no_border mb-2">
   <div class="card-datatable">
     <div class="row">
      <div class="col-sm-12 col-md-8">

            <a class="btn btn-success btn-sm dtb_custom_btn_default" data-toggle="collapse" href="#collapseExample" role="button" aria-expanded="false" aria-controls="collapseExample">
                Import Invoice
            </a>


            @if(session()->has('message'))
                <div class="alert alert-info background-success" role="alert" style="float: right;width: 100%;margin-top: 12px;">
                    {{ session()->get('message') }}
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
            @endif


            <div class="collapse" id="collapseExample">
            <div class="card card-body mt-2" style="background: aliceblue">



                <div class="form-group">
                    <label>Choose CSV file </label>
                    {!! Form::open(['route' => ['invoiceimport'],'method' => 'POST','files' => true, 'enctype' => 'multipart/form-data','class' => 'upcsc','id' => 'upcsv']) !!}
                    @csrf

                    <div class="form-row align-items-center">
                        <div class="col-auto my-1">
                        <input type="file" required name="importcsv" class="form-control-file" id="exampleFormControlFile1" accept=".csv, application/vnd.openxmlformats-officedocument.spreadsheetml.sheet, application/vnd.ms-excel" >
                        </div>

                        <div class="col-auto my-1">
                        <input class="btn btn-secondary btn-flat" type='submit' name='submit' value='Import'>
                        </div>
                    </div>

                    {!! Form::close() !!}
                </div>
            </div>
            </div>


      </div>
      <div class="col-sm-12 col-md-4 " style="text-align:right">
                  <h5 class="ml-6" style="margin-right:35px">Project Invoice</h5>
      </div>
    </div>
</div>
</div>



<div class="card no_border " style="padding: 2px 10px;">
   <div class="card-datatable">
    <div id="tickets-list_wrapper" class="dataTables_wrapper dt-bootstrap4 no-footer">

    <div class="row">
      <div class="col-md-12 col-lg-12">

                        @if(session()->has('success'))
                            <div class="alert alert-success mb-10 background-success" role="alert">
                                {{ session()->get('success') }}
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                        @endif


            <table class="table table-bordered table-striped dtb_custom_tbl_common display nowrap" id="invoicetbl" cellspacing="0" width="100%">
              <thead>
                <tr>
                  <th style="width: 13.6px;">sl</th>
                  <th>Order ID</th>
                  <th>Order Name</th>
                  <th>Customer</th>
                  <th>Billing Date</th>
                  <th>Order Status</th>
                  <th>Total</th>
                  {{-- <th>Customer Branch</th>
                  <th>Customer Contact (Last Name)</th>
                  <th>Customer Contact (First Name)</th>
                  <th>Progress Status</th>
                  <th>Matter category 1</th>
                  <th>Matter category 2</th>
                  <th>Matter category 3</th>
                  <th>Group</th>
                  <th>Person in charge (last name)</th>
                  <th>Person in charge (first name)</th>
                  <th>Management number</th>
                  <th>Customer number</th>
                  <th>Subtotal</th>
                  <th>Consumption tax</th>
                  <th>Withholding tax</th>
                  <th>Summary</th>
                  <th>Quantity</th>
                  <th>Unit</th>
                  <th>Unit price</th>
                  <th>Internal tax</th>
                  <th>Amount</th>
                  <th>Reduced tax rate</th> --}}
                  {{-- <th></th> --}}

                  {{-- <th>order_id</th>
                  <th> order_name</th>
                  <th>customer_name</th>
                  <th>customer_branch</th>
                  <th>customer_charge_last_name</th>
                  <th>customer_charge_first_name</th>
                  <th>invoice_date</th>
                  <th>order_status_name</th>
                  <th>progress_status_name</th>
                  <th>kbn1</th>
                  <th>kbn2</th>
                  <th>kbn3</th>
                  <th>group</th>
                  <th>last_name</th>
                  <th>first_name</th>
                  <th>manage_no</th>
                  <th>customer_no</th>
                  <th>subtotal</th>
                  <th>tax</th>
                  <th>withholding_tax</th>
                  <th>total</th>
                  <th>memo</th>
                  <th>quantity</th>
                  <th>unit</th>
                  <th>unit_price</th>
                  <th>tax_rate</th>
                  <th>amount</th>
                  <th>reduced_tax_rate</th> --}}
                </tr>
              </thead>

              <tbody id="tablecontents">
                @php $i=1; @endphp
                @forelse ($invoices as $issuetype)

                <tr class="row1" data-id="{{ $issuetype->id }}" id="{{$issuetype->id}}">

                  <td class="sorted" data-value="">
                    <a href="{{route('invoiceimportedit',$issuetype->id)}}" style="font-size: 16px;">{{$i++}}</a>
                  </td>
                  <td><a href="{{route('invoiceimportedit',$issuetype->id)}}" style="font-size: 16px;">{{ $issuetype->order_id ?? '' }}</a></td>
                  <td><a href="{{route('invoiceimportedit',$issuetype->id)}}" style="font-size: 16px;">{{ $issuetype->order_name ?? '' }}</a></td>
                  <td><a href="{{route('invoiceimportedit',$issuetype->id)}}" style="font-size: 16px;">{{ $issuetype->customer_name ?? '' }}</a></td>
                  <td><a href="{{route('invoiceimportedit',$issuetype->id)}}" style="font-size: 16px;">{{ date( 'Y-m-d',strtotime($issuetype->invoice_date)) ?? '' }}</a></td>
                  <td><a href="{{route('invoiceimportedit',$issuetype->id)}}" style="font-size: 16px;">{{ $issuetype->order_status_name ?? '' }}</a></td>
                  <td><a href="{{route('invoiceimportedit',$issuetype->id)}}" style="font-size: 16px;">{{ $issuetype->total ?? '' }}</a></td>
                  {{-- <td>{{ $issuetype->customer_branch ?? '' }}</td>
                  <td>{{ $issuetype->customer_charge_last_name ?? '' }}</td>
                  <td>{{ $issuetype->customer_charge_first_name ?? '' }}</td>
                  <td>{{ $issuetype->progress_status_name ?? '' }}</td>
                  <td>{{ $issuetype->kbn1 ?? '' }}</td>
                  <td>{{ $issuetype->kbn2 ?? '' }}</td>
                  <td>{{ $issuetype->kbn3 ?? '' }}</td>
                  <td>{{ $issuetype->groups ?? '' }}</td>
                  <td>{{ $issuetype->last_name ?? '' }}</td>
                  <td>{{ $issuetype->first_name ?? '' }}</td>
                  <td>{{ $issuetype->manage_no ?? '' }}</td>
                  <td>{{ $issuetype->customer_no ?? '' }}</td>
                  <td>{{ $issuetype->subtotal ?? '' }}</td>
                  <td>{{ $issuetype->tax ?? '' }}</td>
                  <td>{{ $issuetype->withholding_tax ?? '' }}</td>
                  <td>{{ $issuetype->memo ?? '' }}</td>
                  <td>{{ $issuetype->quantity ?? '' }}</td>
                  <td>{{ $issuetype->unit ?? '' }}</td>
                  <td>{{ $issuetype->unit_price ?? '' }}</td>
                  <td>{{ $issuetype->tax_rate ?? '' }}</td>
                  <td>{{ $issuetype->amount ?? '' }}</td>
                  <td>{{ $issuetype->reduced_tax_rate ?? '' }}</td> --}}
                  {{-- <td><a href="{{route('invoiceimportedit',$issuetype->id)}}" style="font-size: 16px;"><span class="glyphicon glyphicon-edit" style="color: black"></span> Edit </a></td> --}}

                </tr>
                @empty
                <p>No data</p>
                @endforelse
              </tbody>
            </table>
    </div>
  </div>

</div>
</div>
</div>
</div>



{{-- ################################# COST MANAGE PORTION --}}

<div class="card no_border mb-2 mt-4">
   <div class="card-datatable">
     <div class="row">
      <div class="col-sm-12 col-md-8">

            <a class="btn btn-success btn-sm dtb_custom_btn_default" data-toggle="collapse" href="#costcollapsebar" role="button" aria-expanded="false" aria-controls="costcollapsebar">
                Import Cost
            </a>
            <a class="btn btn-success btn-sm dtb_custom_btn_default ml-2" href="{{route('addcost')}}">Add Cost</a>


            @if(session()->has('msg'))
                <div class="alert alert-info background-success" role="alert" style="float: right;width: 100%;margin-top: 12px;">
                    {{ session()->get('msg') }}
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
            @endif


            <div class="collapse" id="costcollapsebar">
            <div class="card card-body mt-2" style="background: aliceblue">



                <div class="form-group">
                    <label>Choose CSV file </label>
                    {!! Form::open(['route' => ['costimport'],'method' => 'POST','files' => true, 'enctype' => 'multipart/form-data','class' => 'upcsc','id' => 'upcsv']) !!}
                    @csrf

                    <div class="form-row align-items-center">
                        <div class="col-auto my-1">
                        <input type="file" required name="importcsv" class="form-control-file" id="exampleFormControlFile1"  accept=".csv, application/vnd.openxmlformats-officedocument.spreadsheetml.sheet, application/vnd.ms-excel"   >
                        </div>

                        <div class="col-auto my-1">
                        <input class="btn btn-secondary btn-flat" type='submit' name='submit' value='Import'>
                        </div>
                    </div>

                    {!! Form::close() !!}
                </div>
            </div>
            </div>


      </div>
      <div class="col-sm-12 col-md-4 " style="text-align:right">
                <h5 class="ml-6" style="margin-right:35px">Project Cost</h5>
      </div>
    </div>
</div>
</div>


<div class="card no_border " style="padding: 2px 10px;">
   <div class="card-datatable">
    <div id="costportion" class="dataTables_wrapper dt-bootstrap4 no-footer">

    <div class="row">
      <div class="col-md-12 col-lg-12">

                        @if(session()->has('scss'))
                            <div class="alert alert-success mb-10 background-success" role="alert">
                                {{ session()->get('scss') }}
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                        @endif


            <table class="table table-bordered table-striped dtb_custom_tbl_common display nowrap" id="costtable" cellspacing="0" width="100%">
              <thead>
                <tr>
                  <th style="width: 13.6px;">sl</th>
                  <th>Project</th>
                  <th>App</th>
                  <th>User</th>
                  <th>Work Time(h)</th>
                  <th>Subtotal</th>
                  <th>Tax</th>
                  <th>Billing Date</th>
                </tr>
              </thead>

              <tbody id="tablecontents">
                @php
                        $i=1;
                        $developer_id = Session::get('developer_id');
                        $usercosts = DB::table('dtb_costs')
                        ->leftjoin('dtb_apps','dtb_costs.app_id', '=', 'dtb_apps.id')
                        ->leftjoin('dtb_projects','dtb_costs.project_id', '=', 'dtb_projects.id')
                        ->leftjoin('dtb_users','dtb_costs.user_id', '=', 'dtb_users.id')
                        ->where('dtb_costs.developer_id',$developer_id)
                        ->select('dtb_costs.*','dtb_apps.app_name as apptitle','dtb_projects.project_name','dtb_users.name as username')
                        ->get();
                        //dd($usercosts);
                    @endphp

                @forelse ($usercosts as $usercost)

                <tr class="row1" data-id="{{ $usercost->id }}" id="{{$usercost->id}}">

                  <td class="sorted" data-value="">
                    <a href="{{route('editcost',$usercost->id)}}" style="font-size: 16px;">{{$i++}}</a>
                  </td>
                  <td><a href="{{route('editcost',$usercost->id)}}" style="font-size: 16px;">{{ $usercost->project_name ?? '' }}</a></td>
                  <td><a href="{{route('editcost',$usercost->id)}}" style="font-size: 16px;">{{ $usercost->apptitle ?? '' }}</a></td>
                  <td><a href="{{route('editcost',$usercost->id)}}" style="font-size: 16px;">{{ $usercost->username ?? '' }}</a></td>
                  <td><a href="{{route('editcost',$usercost->id)}}" style="font-size: 16px;">{{ $usercost->work_time ?? '' }}</a></td>

                  <td><a href="{{route('editcost',$usercost->id)}}" style="font-size: 16px;">{{ $usercost->sub_total ?? '' }}</a></td>
                  <td><a href="{{route('editcost',$usercost->id)}}" style="font-size: 16px;">{{ $usercost->tax ?? '' }}</a></td>
                  <td><a href="{{route('editcost',$usercost->id)}}" style="font-size: 16px;">{{ date( 'Y-m-d',strtotime($usercost->billing_date)) ?? '' }}</a></td>

                </tr>
                @empty
                <p>No data</p>
                @endforelse
              </tbody>
            </table>
    </div>
  </div>

</div>
</div>
</div>

    @if(session()->has('scss'))
        <script>
            $(document).ready(function () {
              // Handler for .ready() called.
              $('html, body').animate({
                  scrollTop: $('#costportion').offset().top
              }, 'slow');
          });
        </script>

      @endif
    @if(session()->has('msg'))
        <script>
            $(document).ready(function () {
              // Handler for .ready() called.
              $('html, body').animate({
                  scrollTop: $('#costportion').offset().top
              }, 'slow');
          });
        </script>

      @endif

<script>
$(document).ready(function() {


    $('#invoicetbl').DataTable( {
        responsive: {
            details: {
                renderer: function ( api, rowIdx, columns ) {
                    var data = $.map( columns, function ( col, i ) {
                        return col.hidden ?
                            '<tr data-dt-row="'+col.rowIndex+'" data-dt-column="'+col.columnIndex+'">'+
                                '<td>'+col.title+':'+'</td> '+
                                '<td>'+col.data+'</td>'+
                            '</tr>' :
                            '';
                    } ).join('');

                    return data ?
                        $('<table/>').append( data ) :
                        false;
                }
            }
        }
    } );



    $('#costtable').dataTable({  });



} );


//$(document).ready(function (){
 //   var table = $('#invoicetbl').DataTable({
 //       'responsive': true
 //   });

    // Handle click on "Expand All" button
 //   $('#btn-show-all-children').on('click', function(){
        // Expand row details
      //  table.rows(':not(.parent)').nodes().to$().find('td:first-child').trigger('click');
   // });

    // Handle click on "Collapse All" button
  //  $('#btn-hide-all-children').on('click', function(){
        // Collapse row details
    //    table.rows('.parent').nodes().to$().find('td:first-child').trigger('click');
  //  });
//});





</script>
<style>
table#invoicetbl a {
    color: #000000c4;
}

table#invoicetbl a {
    color: #000000c4;
    padding: 4px;
    width: 100% !important;
    float: left;
}
table#invoicetbl a:hover {
    color: #1e70cd;
}


table#costtable a {
    color: #000000c4;
}

table#costtable a {
    color: #000000c4;
    padding: 4px;
    width: 100% !important;
    float: left;
}
table#costtable a:hover {
    color: #1e70cd;
}
table#workingdaytbl tr th {
    width: 65px;
}

.dataholder {
    text-align: center;
    margin: 0 auto;
}


.dataholder span:last-child {
    float: right;
    width: auto;
    margin-right: 4px;
}
.dataholder span:first-child {
    float: left;
    margin-left: 4px;
}

table#workingdaytbl tbody tr th {
    padding: 5px 5px;
}

table#workingdaytbl.table-striped tbody tr:nth-of-type(odd) {
    background-color: rgb(203 218 235 / 74%) !important;
}
table#workingdaytbl thead tr {
    background: #38587d8f;
    color: #fff;
}
table#workingdaytbl.table-bordered th, .table-bordered td {
    border-right: 1px solid #03030314;
    border-left: 1px solid #03030314;
}

table#workingdaytbl tbody tr th {
    padding: 3px 4px;
    font-size: 14px;
}

table#workingdaytbl tbody tr th:last-child {
    background: #607d8b26;
    border-bottom: 1px solid #808080b5;
}
table#workingdaytbl tbody tr th {
    background: #607d8b14;
    border-bottom: 1px solid #808080b5;
}
</style>



@endsection
