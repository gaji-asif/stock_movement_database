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

<div class="card no_border mb-2">
   <div class="card-datatable">
     <div class="row">
      <div class="col-sm-12 col-md-8">

            <a class="btn btn-success btn-sm dtb_custom_btn_default" data-toggle="collapse" href="#collapseExample" role="button" aria-expanded="false" aria-controls="collapseExample">
                Import Invoice
            </a>

            <span class="alert p-2 mt-2" style="color:green">
                @if(Session::has('message'))
                    <p >{{ Session::get('message') }}</p>
                @endif
            </span>

            <div class="collapse" id="collapseExample">
            <div class="card card-body mt-2" style="background: aliceblue">



                <div class="form-group">
                    <label>Choose CSV file </label>
                    {!! Form::open(['route' => ['invoiceimport'],'method' => 'POST','files' => true, 'enctype' => 'multipart/form-data','class' => 'upcsc','id' => 'upcsv']) !!}
                    @csrf

                    <div class="form-row align-items-center">
                        <div class="col-auto my-1">
                        <input type="file" required name="importcsv" class="form-control-file" id="exampleFormControlFile1" accept="text/csv" >
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
                  <td><a href="{{route('invoiceimportedit',$issuetype->id)}}" style="font-size: 16px;">{{ date( 'yy-m-d',strtotime($issuetype->invoice_date)) ?? '' }}</a></td>
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
</style>
@endsection
