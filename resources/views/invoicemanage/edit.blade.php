@extends('master_main')
@section('mainContent')
<style type="text/css">
    .project_details:hover{
        background-color: #FFD950;
    }
    table.dataTable>tbody>tr.child td {
        padding-left:0px !important;
    }
    table.dataTable>tbody>tr.child td:nth-child(2) {
        padding: 8px 12px !important;
        min-width: 234px;
    }
    table.dataTable>tbody>tr.child td:first-child{
    padding-left:1px !important;
    }
    .additemholder a {
        padding: 4px 3px !important;
        width: 133px;
    }
    .additemholder {
        padding: 22px;
    }
    form#invoiceitemaddform input {
        margin-bottom: 10px;
    }
tbody#showinvoiceitemlist tr td {
    color: blue;
    cursor: pointer;
}
form#invoiceitemaddform input {
    margin-bottom: 15px;
}
form#invoiceitemaddform select {
    margin-bottom: 15px;
}

form#invoiceitemeditform input {
    margin-bottom: 15px;
}
form#invoiceitemeditform select {
    margin-bottom: 15px;
}
.btngrp {
    float: right;
    width: auto;
    margin-top: 2px;
}
</style>

<link rel="stylesheet" href="https://cdn.datatables.net/1.10.21/css/jquery.dataTables.min.css">
<link rel="stylesheet" href="https://cdn.datatables.net/responsive/2.2.5/css/responsive.dataTables.min.css">
<script src="https://cdn.datatables.net/1.10.21/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/responsive/2.2.5/js/dataTables.responsive.min.js"></script>

<div class="test mt-5">

<div class="row">
    <div class="col-lg-12">
        <div class="card mb-4">

            <h6 class="card-header">
              Invoice Edit Form

              <a href="{{route('manageinvoices')}}" class="btn btn-success btn-sm dtb_custom_btn_default" style="float:right">All Invoices</a>
            </h6>

                      {!! Form::open(['route' => ['invoiceimportedit',$singleinvoice->id], 'method' => 'PUT','files' => true, 'enctype' => 'multipart/form-data','id' => 'invoiceupdateform','class' => 'form-horizontal'])!!}
                     {{-- {{ method_field('PATCH') }} --}}
                    <div class="card-body">
                        @if(session()->has('status'))
                            <div class="alert alert-success mb-10 background-success" role="alert">
                                {{ session()->get('status') }}
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                        @endif

                        @if(session()->has('message'))
                            <div class="alert alert-success mb-10 background-success" role="alert">
                                {{ session()->get('message') }}
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                        @endif


                        <div class="form-group">
                            <div class="form-row">

                                <div class="col">
                                <label class="form-label">Order ID</label>
                                <input type="text" class="form-control {{ $errors->has('order_id') ? ' is-invalid' : '' }}" value="{{ old('order_id') ?? $singleinvoice->order_id }}" name="order_id" required>
                                @if ($errors->has('order_id'))
                                <span class="invalid-feedback" role="alert">
                                    <span class="messages"><strong>{{ $errors->first('order_id') }}</strong></span>
                                </span>
                                @endif
                                </div>

                                 <div class="col">
                                <label class="form-label">Order Name</label>
                                <input type="text" class="form-control {{ $errors->has('order_name') ? ' is-invalid' : '' }}" value="{{ old('order_name') ?? $singleinvoice->order_name }}" name="order_name">
                                @if ($errors->has('order_name'))
                                <span class="invalid-feedback" role="alert">
                                    <span class="messages"><strong>{{ $errors->first('order_name') }}</strong></span>
                                </span>
                                @endif
                                </div>
                                
                                <div class="col">
                                <label class="form-label">Customer Name</label>
                                <input type="text" class="form-control {{ $errors->has('customer_name') ? ' is-invalid' : '' }}" value="{{ old('customer_name') ?? $singleinvoice->customer_name }}"  name="customer_name">
                                @if ($errors->has('customer_name'))
                                <span class="invalid-feedback" role="alert">
                                    <span class="messages"><strong>{{ $errors->first('customer_name') }}</strong></span>
                                </span>
                                @endif
                                </div>

                            </div>
                               
                        </div>

                        <div class="form-group">
                            <div class="form-row">

                                <div class="col">
                                <label class="form-label">Invoice Date</label>
                                <input type="date" class="form-control {{ $errors->has('invoice_date') ? ' is-invalid' : '' }}" value="{{ old('invoice_date') ?? date( 'yy-m-d',strtotime($singleinvoice->invoice_date))  }}" name="invoice_date" data-date="" data-date-format="YYY MMMM DD">
                                
                                @if ($errors->has('invoice_date'))
                                <span class="invalid-feedback" role="alert">
                                    <span class="messages"><strong>{{ $errors->first('invoice_date') }}</strong></span>
                                </span>
                                @endif
                                </div>

                                <div class="col">
                                <label class="form-label">Order Status Name</label>
                                <input type="text" class="form-control {{ $errors->has('order_status_name') ? ' is-invalid' : '' }}" value="{{ old('order_status_name') ?? $singleinvoice->order_status_name }}" name="order_status_name">
                                @if ($errors->has('order_status_name'))
                                <span class="invalid-feedback" role="alert">
                                    <span class="messages"><strong>{{ $errors->first('order_status_name') }}</strong></span>
                                </span>
                                @endif
                                </div>

                                 <div class="col">
                                <label class="form-label">Total</label>
                                <input type="text" id="invtotal" class="form-control {{ $errors->has('total') ? ' is-invalid' : '' }}" value="{{ old('total') ?? $singleinvoice->total }}" name="total">
                                @if ($errors->has('total'))
                                <span class="invalid-feedback" role="alert">
                                    <span class="messages"><strong>{{ $errors->first('total') }}</strong></span>
                                </span>
                                @endif
                                </div>

                            </div>
                        </div>




                        <div class="form-group">
                            <div class="form-row">

                                <div class="col">
                                <label class="form-label">Customer Branch</label>
                                <input type="text" class="form-control {{ $errors->has('customer_branch') ? ' is-invalid' : '' }}" value="{{ old('customer_branch') ?? $singleinvoice->customer_branch }}"  name="customer_branch">
                                @if ($errors->has('customer_branch'))
                                <span class="invalid-feedback" role="alert">
                                    <span class="messages"><strong>{{ $errors->first('customer_branch') }}</strong></span>
                                </span>
                                @endif
                                </div>


                                 <div class="col">
                                <label class="form-label">Customer Contact (First Name)</label>
                                <input type="text" class="form-control {{ $errors->has('customer_charge_first_name') ? ' is-invalid' : '' }}" value="{{ old('customer_charge_first_name') ?? $singleinvoice->customer_charge_first_name }}" name="customer_charge_first_name">
                                @if ($errors->has('customer_charge_first_name'))
                                <span class="invalid-feedback" role="alert">
                                    <span class="messages"><strong>{{ $errors->first('customer_charge_first_name') }}</strong></span>
                                </span>
                                @endif
                                </div>


                                <div class="col">
                                <label class="form-label">Customer Contact (Last Name)</label>
                                <input type="text" class="form-control {{ $errors->has('customer_charge_last_name') ? ' is-invalid' : '' }}" value="{{ old('customer_charge_last_name') ?? $singleinvoice->customer_charge_last_name }}"  name="customer_charge_last_name">
                                @if ($errors->has('customer_charge_last_name'))
                                <span class="invalid-feedback" role="alert">
                                    <span class="messages"><strong>{{ $errors->first('customer_charge_last_name') }}</strong></span>
                                </span>
                                @endif
                                </div>


                            </div>  
                        </div>


                        <div class="form-group">
                            <div class="form-row">

                                 <div class="col">
                                <label class="form-label">Order category 1</label>
                                <input type="text" class="form-control {{ $errors->has('kbn1') ? ' is-invalid' : '' }}" value="{{ old('kbn1') ?? $singleinvoice->kbn1 }}" name="kbn1">
                                @if ($errors->has('kbn1'))
                                <span class="invalid-feedback" role="alert">
                                    <span class="messages"><strong>{{ $errors->first('kbn1') }}</strong></span>
                                </span>
                                @endif
                                </div>

                                <div class="col">
                                <label class="form-label">Order category 2</label>
                                <input type="text" class="form-control {{ $errors->has('kbn2') ? ' is-invalid' : '' }}" value="{{ old('kbn2') ?? $singleinvoice->kbn2 }}" name="kbn2">
                                @if ($errors->has('kbn2'))
                                <span class="invalid-feedback" role="alert">
                                    <span class="messages"><strong>{{ $errors->first('kbn2') }}</strong></span>
                                </span>
                                @endif
                                </div>



                                 <div class="col">
                                <label class="form-label">Order category 3</label>
                                <input type="text" class="form-control {{ $errors->has('kbn3') ? ' is-invalid' : '' }}" value="{{ old('kbn3') ?? $singleinvoice->kbn3 }}" name="kbn3">
                                @if ($errors->has('kbn3'))
                                <span class="invalid-feedback" role="alert">
                                    <span class="messages"><strong>{{ $errors->first('kbn3') }}</strong></span>
                                </span>
                                @endif
                                </div>


                            </div>
                        </div>



                        <div class="form-group">
                            <div class="form-row">

                                <div class="col">
                                <label class="form-label">Progress Status</label>
                                <input type="text" class="form-control {{ $errors->has('progress_status_name') ? ' is-invalid' : '' }}" value="{{ old('progress_status_name') ?? $singleinvoice->progress_status_name }}"  name="progress_status_name">
                                @if ($errors->has('progress_status_name'))
                                <span class="invalid-feedback" role="alert">
                                    <span class="messages"><strong>{{ $errors->first('progress_status_name') }}</strong></span>
                                </span>
                                @endif
                                </div>


                                <div class="col">
                                <label class="form-label">Person in charge (first name)</label>
                                <input type="text" class="form-control {{ $errors->has('first_name') ? ' is-invalid' : '' }}" value="{{ old('first_name') ?? $singleinvoice->first_name }}"  name="first_name">
                                @if ($errors->has('first_name'))
                                <span class="invalid-feedback" role="alert">
                                    <span class="messages"><strong>{{ $errors->first('first_name') }}</strong></span>
                                </span>
                                @endif
                                </div>



                                <div class="col">
                                <label class="form-label">Person in charge (last name)</label>
                                <input type="text" class="form-control {{ $errors->has('last_name') ? ' is-invalid' : '' }}" value="{{ old('last_name') ?? $singleinvoice->last_name }}"  name="last_name">
                                @if ($errors->has('last_name'))
                                <span class="invalid-feedback" role="alert">
                                    <span class="messages"><strong>{{ $errors->first('last_name') }}</strong></span>
                                </span>
                                @endif
                                </div>

                            </div>
                               
                        </div>



                        <div class="form-group">
                            <div class="form-row">

                                <div class="col">
                                <label class="form-label">Group</label>
                                <input type="text" class="form-control {{ $errors->has('groups') ? ' is-invalid' : '' }}" value="{{ old('groups') ?? $singleinvoice->groups }}"  name="groups">
                                @if ($errors->has('groups'))
                                <span class="invalid-feedback" role="alert">
                                    <span class="messages"><strong>{{ $errors->first('groups') }}</strong></span>
                                </span>
                                @endif
                                </div>


                                <div class="col">
                                <label class="form-label">Manage Number</label>
                                <input type="text" class="form-control {{ $errors->has('manage_no') ? ' is-invalid' : '' }}" value="{{ old('manage_no') ?? $singleinvoice->manage_no }}"  name="manage_no">
                                @if ($errors->has('manage_no'))
                                <span class="invalid-feedback" role="alert">
                                    <span class="messages"><strong>{{ $errors->first('manage_no') }}</strong></span>
                                </span>
                                @endif
                                </div>



                                <div class="col">
                                <label class="form-label">Customer Number</label>
                                <input type="text" class="form-control {{ $errors->has('customer_no') ? ' is-invalid' : '' }}" value="{{ old('customer_no') ?? $singleinvoice->customer_no }}"  name="customer_no">
                                @if ($errors->has('customer_no'))
                                <span class="invalid-feedback" role="alert">
                                    <span class="messages"><strong>{{ $errors->first('customer_no') }}</strong></span>
                                </span>
                                @endif
                                </div>

                            </div>
                        </div>



                        <div class="form-group">
                            <div class="form-row">

                                <div class="col">
                                <label class="form-label">Subtotal</label>
                                <input type="text" class="form-control {{ $errors->has('subtotal') ? ' is-invalid' : '' }}" value="{{ old('subtotal') ?? $singleinvoice->subtotal }}"  name="subtotal">
                                @if ($errors->has('subtotal'))
                                <span class="invalid-feedback" role="alert">
                                    <span class="messages"><strong>{{ $errors->first('subtotal') }}</strong></span>
                                </span>
                                @endif
                                </div>


                                <div class="col">
                                <label class="form-label">Tax</label>
                                <input type="text" class="form-control {{ $errors->has('tax') ? ' is-invalid' : '' }}" value="{{ old('tax') ?? $singleinvoice->tax }}"  name="tax">
                                @if ($errors->has('tax'))
                                <span class="invalid-feedback" role="alert">
                                    <span class="messages"><strong>{{ $errors->first('tax') }}</strong></span>
                                </span>
                                @endif
                                </div>


                                <div class="col">
                                <label class="form-label">Witholding Tax</label>
                                <input type="text" class="form-control {{ $errors->has('withholding_tax') ? ' is-invalid' : '' }}" value="{{ old('withholding_tax') ?? $singleinvoice->withholding_tax }}"  name="withholding_tax">
                                @if ($errors->has('withholding_tax'))
                                <span class="invalid-feedback" role="alert">
                                    <span class="messages"><strong>{{ $errors->first('withholding_tax') }}</strong></span>
                                </span>
                                @endif
                                </div>

                            </div>
                        </div>


                        <div class="form-group">
                            <div class="form-row">


                                <div class="col">
                                <label class="form-label">Quantity</label>
                                <input type="text" class="form-control {{ $errors->has('quantity') ? ' is-invalid' : '' }}" value="{{ old('quantity') ?? $singleinvoice->quantity }}"  name="quantity">
                                @if ($errors->has('quantity'))
                                <span class="invalid-feedback" role="alert">
                                    <span class="messages"><strong>{{ $errors->first('quantity') }}</strong></span>
                                </span>
                                @endif
                                </div>



                                <div class="col">
                                <label class="form-label">Unit</label>
                                <input type="text" class="form-control {{ $errors->has('unit') ? ' is-invalid' : '' }}" value="{{ old('unit') ?? $singleinvoice->unit }}"  name="unit">
                                @if ($errors->has('unit'))
                                <span class="invalid-feedback" role="alert">
                                    <span class="messages"><strong>{{ $errors->first('unit') }}</strong></span>
                                </span>
                                @endif
                                </div>


                                <div class="col">
                                <label class="form-label">Amount</label>
                                <input type="text" class="form-control {{ $errors->has('amount') ? ' is-invalid' : '' }}" value="{{ old('amount') ?? $singleinvoice->amount }}"  name="amount">
                                @if ($errors->has('amount'))
                                <span class="invalid-feedback" role="alert">
                                    <span class="messages"><strong>{{ $errors->first('amount') }}</strong></span>
                                </span>
                                @endif
                                </div>




                            </div>
                        </div>



                        <div class="form-group">
                            <div class="form-row">

                                <div class="col">
                                <label class="form-label">Unit Price</label>
                                <input type="text" class="form-control {{ $errors->has('unit_price') ? ' is-invalid' : '' }}" value="{{ old('unit_price') ?? $singleinvoice->unit_price }}"  name="unit_price">
                                @if ($errors->has('unit_price'))
                                <span class="invalid-feedback" role="alert">
                                    <span class="messages"><strong>{{ $errors->first('unit_price') }}</strong></span>
                                </span>
                                @endif
                                </div>


                                <div class="col">
                                <label class="form-label">Tax Rate</label>
                                <input type="text" class="form-control {{ $errors->has('tax_rate') ? ' is-invalid' : '' }}" value="{{ old('tax_rate') ?? $singleinvoice->tax_rate }}"  name="tax_rate">
                                @if ($errors->has('tax_rate'))
                                <span class="invalid-feedback" role="alert">
                                    <span class="messages"><strong>{{ $errors->first('tax_rate') }}</strong></span>
                                </span>
                                @endif
                                </div>



                                <div class="col">
                                <label class="form-label">Reduced Tax Rate</label>
                                <input type="text" class="form-control {{ $errors->has('reduced_tax_rate') ? ' is-invalid' : '' }}" value="{{ old('reduced_tax_rate') ?? $singleinvoice->reduced_tax_rate }}"  name="reduced_tax_rate">
                                @if ($errors->has('reduced_tax_rate'))
                                <span class="invalid-feedback" role="alert">
                                    <span class="messages"><strong>{{ $errors->first('reduced_tax_rate') }}</strong></span>
                                </span>
                                @endif
                                </div>

                            </div>
                        </div>


                        <div class="form-group">
                            <div class="form-row">

                                <div class="col">
                                <label class="form-label">Memo</label>
                                <textarea type="text" class="form-control {{ $errors->has('memo') ? ' is-invalid' : '' }}" value="{{ old('memo') ?? $singleinvoice->memo }}"  name="memo">{{ old('memo') ?? $singleinvoice->memo }}</textarea>
                                @if ($errors->has('memo'))
                                <span class="invalid-feedback" role="alert">
                                    <span class="messages"><strong>{{ $errors->first('memo') }}</strong></span>
                                </span>
                                @endif
                                </div>

                            </div>
                        </div>
                        <br>
                        <div class="row mb-4">
                                <div class="col-md-1"></div>
                                    <div class="col-md-10 text-center">
                                   <input class="btn btn-success dtbbigbtn" type="submit" value="Submit">
                                </div>
                                <div class="col-md-1"></div>
                            </div>
                </div>
                {{ Form::close()}}



                <div class="additemholder" style="text-align:right">
                    <a href="#" data-toggle="modal" id="additemmodalbtn" data-target="#invoiceitemaddmodal" class="btn btn-success dtbbigbtn">Add Item </a>
                </div>


{{-- add item modal starts --}}
                <div class="modal fade" id="invoiceitemaddmodal">
                <div class="modal-dialog modal-lg">
                    <form method="POST" class="modal-content" id="invoiceitemaddform">

                        <div class="modal-header">
                            <h5 class="modal-title">
                                Add Invoice Item
                            </h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close"> – </button>
                        </div>
                        <div class="modal-body">
                            <div class="errmsg alert alert-danger" style="display:none">
                                <ul>
                                @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                                @endforeach
                                </ul>
                            </div>

                            <div class="form-row">
                                <div class="form-group col mb-0">
                                    <label class="form-label">Item Name</label>
                                    <input required type="text" id="item_name" name="item_name" value="" class="form-control required" placeholder="">
                                </div>
                            </div>
                            <div class="form-row">
                                <div class="form-group col mb-0">
                                    <label class="form-label">Projects</label>
                                    
                                        <select id="project_id" name="project_id" class="custom-select {{ $errors->has('project_id') ? ' is-invalid' : '' }}">
                                          <option value="0">Select Project</option>
                                          @foreach($projects as $project)
                                          <option value="{{ $project->id }}">{{ $project->project_name }}</option>
                                          @endforeach
                                        </select>
                                </div>

                                <div class="form-group col mb-0">
                                    <label class="form-label">Apps</label>
                                       <select id="app_id" name="app_id" class="custom-select {{ $errors->has('app_id') ? ' is-invalid' : '' }}">
                                        <option>Select App</option>
                                        </select>
                                </div>
                            </div>
                           <div class="form-row">
                                <div class="form-group col mb-0">
                                    <label class="form-label">Amount</label>
                                    <input type="number" id="amount" name="amount" value="" class="summable form-control required" placeholder="">
                                </div>
                                <div class="form-group col mb-0">
                                    <label class="form-label">Tax</label>
                                    <input type="number" id="tax" name="tax" value="" class="summable form-control required" placeholder="">
                                </div>
                            </div>
                            <div class="form-row">
                                <div class="form-group col mb-0">
                                    <label class="form-label">Total</label>
                                    <input type="number" id="total" name="total" value="" class="form-control required" placeholder="">
                                </div>

                            </div>
                            <input type="hidden" id="invoice_id" name="invoice_id" value="{{ $singleinvoice->id }}">
                        </div>
                        <div class="modal-footer">
                            <button id="checklistclosebtn" class="btn btn-default" data-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-primary updatechecklistsavebtn">Save</button>
                        </div>
                    </form>
                </div>
                </div>
{{-- add item modal ends --}}



        </div>
    </div>



</div>

</div>


<div class="row">
    <div class="col-md-12">
        <div class="card">
            <h5 class="px-4 mt-4 invitemtitle pb-0"> Invoice Item List </h5 class="p-4">
            
            <ul class="invoiceitemlistholder px-4">
                <table class="table table-striped table-bordered tbl_common dtb_custom_tbl_common ">
                    <thead>
                        <tr>
                            <th>Item Name</th>
                            <th>Project</th>
                            <th>App</th>
                            <th>Amount</th>
                            <th>Tax</th>
                            <th>Total</th>
                        </tr>
                    </thead>
                    <tbody id="showinvoiceitemlist">
                    </tbody>
                </table>
                
            </ul>
        </div>
    </div>
</div>
{{-- edit item modal starts --}}
                <div class="modal fade" id="editinvItemmodal">
                <div class="modal-dialog modal-lg">
                    <form method="POST" class="modal-content" id="invoiceitemeditform">

                        <div class="modal-header">
                            <h5 class="modal-title">
                                Edit Invoice Item
                            </h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close"> – </button>
                        </div>
                        <div class="modal-body">
                            <div class="errmsg alert alert-danger" style="display:none">
                                <ul>
                                @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                                @endforeach
                                </ul>
                            </div>

                            <div class="form-row">
                                <div class="form-group col mb-0">
                                    <label class="form-label">Item Name</label>
                                    <input required type="text" id="item_name_edit" name="item_name" value="" class="form-control required" placeholder="">
                                </div>
                            </div>
                            <div class="form-row">
                                <div class="form-group col mb-0">
                                    <label class="form-label">Projects</label>
                                    
                                        <select id="project_id_edit" name="project_id_edit" class="custom-select {{ $errors->has('project_id') ? ' is-invalid' : '' }}">
                                          <option value="">Select Project</option>
                                          @foreach($projects as $project)
                                          <option value="{{ $project->id }}">{{ $project->project_name }}</option>
                                          @endforeach
                                        </select>
                                </div>

                                <div class="form-group col mb-0">
                                    <label class="form-label">Apps</label>
                                        <select id="app_id_edit" name="app_id" class="custom-select {{ $errors->has('app_id') ? ' is-invalid' : '' }}">
                                          <option value="">Select App</option>
                                        </select>
                                </div>
                            </div>
                            <div class="form-row">
                                <div class="form-group col mb-0">
                                    <label class="form-label">Amount</label>
                                    <input type="number" id="amount_edit" name="amount" value="" class="summableedit form-control required" placeholder="">
                                </div>
                                <div class="form-group col mb-0">
                                    <label class="form-label">Tax</label>
                                    <input type="number" id="tax_edit" name="tax" value="" class="summableedit form-control required" placeholder="">
                                </div>
                            </div>
                            <div class="form-row">
                                <div class="form-group col mb-0">
                                    <label class="form-label">Total</label>
                                    <input type="number" id="total_edit" name="total" value="" class="form-control required" placeholder="">
                                </div>

                            </div>
                            <input type="hidden" id="invoiceitem_id" name="invoiceitem_id" value="">
                        </div>
                        <div class="modal-footer" style="display:block;text-align:center">
                            
                            <button type="submit" class="btn btn-primary updatechecklistsavebtn" style="position: absolute;left: 44%;right: 50%;width: 108px;">Save</button>

                            <div class="btngrp">
                            <button id="checklistclosebtn" class="btn btn-default" data-dismiss="modal" style="margin-right: 7px;">Close</button>
                            <button id="itemlitdelbtn" class="btn btn-default" data-itemid="" >Delete</button>
                            
                            </div>
                        </div>
                    </form>
                </div>
                </div>
{{-- edit item modal ends --}}




<script>
$(document).ready(function() {
    


                    getinvoiceitems();
                    function getinvoiceitems(){
                        $.ajax({
                           url: 'invoiceitemlist',
                           type: 'GET',
                           data: {
                           invoiceid:{{ $singleinvoice->id }},
                           _token: '{{csrf_token()}}'
                           },
                           success: function(response){
                           if (response) {

                            $("#showinvoiceitemlist").html(response);

                           var itemtotal = $(".itemtotal").val();
                           if(itemtotal === '0'){
                            $("#invtotal").val(<?php echo $singleinvoice->total ?>);
                           }else{
                            $("#invtotal").val(itemtotal); 
                           }
                           


                           }
                           },
                           error: function() {
                           alert('Error occurs!');
                           }
                        });
                    }


                    //reset form 
                    $('body').on('click','#additemmodalbtn',function(e){
                        document.getElementById("invoiceitemaddform").reset();
                    });

                    
                    //issue entry form submit process
                    $('body').on('submit','#invoiceitemaddform',function(e){

                                e.preventDefault();
                                 $.ajaxSetup({
                                 headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')}
                                 });
                                 

                                 var formdata = $(this).serialize();
                                 
                                 var url = '{{ url("invoiceitemsave") }}';
                                 
                                 $.ajax({
                                        url: 'invoiceitemsave',
                                        type: 'POST',
                                        data: formdata,
                                        success: function(data){

                                            document.getElementById("invoiceitemaddform").reset();
                                            $('#invoiceitemaddmodal').modal('toggle');
                                            $.iaoAlert({msg: "Invoice item added successfully ",
                                                   type: "success",
                                                   mode: "dark",});

                                           getinvoiceitems();
                                
                                        },
                                        error: function (request, checklist, error) {

                                        $.iaoAlert({msg: "Something went wrong!",
                                                   type: "warning",
                                                   mode: "dark",})
                                    
                                        json = $.parseJSON(request.responseText);
                                        $.each(json.errors, function(key, value){
                                               $('.errmsg').show();
                                               $('.alert-danger').append('<p>'+value+'</p>');
                                               setTimeout(function() {
                                                          $('.errmsg').hide();
                                                          $('.alert-danger').append('');
                                                          }, 2000);
                                        });
                                        //$("#result").html('');
                                        }
                                        
                                        
                                        
                                });
                                 
                                 
                                 });




                                //edit invoice item modal
                                  $('body').on('click','.editinvitem',function(e){
                                
                                    e.preventDefault();
                                    $.ajaxSetup({
                                    headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')}
                                    });

                                 
                                    var id = $(this).attr('data');
                                    var invitem_name = $(this).attr('data-name');
                                    var invitem_project = $(this).attr('data-project');
                                    var invitem_app = $(this).attr('data-app');
                                    //var invitem_appname = $(this).attr('data-appname');
                                    var invitem_amount = $(this).attr('data-amount');
                                    var invitem_total = $(this).attr('data-total');
                                    var invitem_tax = $(this).attr('data-tax');

                                    $("#invoiceitem_id").val(id);
                                    $("#item_name_edit").val(invitem_name);
                                    $("#project_id_edit").val(invitem_project);
                                    $("#app_id_edit").val(invitem_app);
                                    //$("#app_name_edit").val(invitem_appname);
                                    $("#amount_edit").val(invitem_amount);
                                    $("#total_edit").val(invitem_total);
                                    $("#tax_edit").val(invitem_tax);


                                    projectid = $("#project_id_edit").val();
                                    geteditapp(projectid)
                                    
                                    $('body').on('change','#project_id_edit',function(e){
                                        projectid = $(this).val();
                                        geteditapp(projectid)
                                    });


                                    function geteditapp(projectid){
                                    $.ajax({
                                    url: 'getprojectapp',
                                    type: 'GET',
                                    data: {
                                    projectid:projectid,
                                    _token: '{{csrf_token()}}'
                                    },
                                    success: function(response){
                                    if (response) {
                                    //alert(response);exit();
                                    $("#app_id_edit").html(response);
                                    
                                    }
                                    },
                                    error: function() {
                                    alert('Error occurs!');
                                    }
                                    });
                                    }



                                    //$("#project_id_edit select").val(invitem_project);
                                        $('#itemlitdelbtn').attr('data-itemid',id);
                                    });



                                    $('body').on('submit','#invoiceitemeditform',function(e){

                                        e.preventDefault();
                                        $.ajaxSetup({
                                        headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')}
                                        });



                                        var editformdata = $(this).serialize();
                                        var invoiceitem_id = $("#invoiceitem_id").val();
                                        var item_name_edit = $("#item_name_edit").val();
                                        var project_id_edit = $("#project_id_edit").val();
                                        var app_id_edit = $("#app_id_edit").val();
                                       // var app_name_edit = $("#app_name_edit").val();
                                        var amount_edit = $("#amount_edit").val();
                                        var total_edit = $("#total_edit").val();
                                        var tax_edit = $("#tax_edit").val();




                                        $.ajax({
                                            url: 'invoiceitemupdate',
                                            type: 'POST',
                                            data: {
                                            invoiceitem_id :invoiceitem_id,
                                            item_name_edit :item_name_edit,
                                            project_id_edit :project_id_edit,
                                            app_id_edit :app_id_edit,
                                            amount_edit :amount_edit,
                                            total_edit :total_edit,
                                            tax_edit :tax_edit
                                            },
                                            success: function(data){
                                                //alert(data);
                                                document.getElementById("invoiceitemeditform").reset();
                                                $('#editinvItemmodal').modal('toggle');
                                                $.iaoAlert({msg: "Invoice item updated successfully ",
                                                    type: "success",
                                                    mode: "dark",});

                                            getinvoiceitems();
                                    
                                            },
                                            error: function (request, checklist, error) {

                                            $.iaoAlert({msg: "Something went wrong!",
                                                    type: "warning",
                                                    mode: "dark",})
                                        
                                            json = $.parseJSON(request.responseText);
                                            $.each(json.errors, function(key, value){
                                                $('.errmsg').show();
                                                $('.alert-danger').append('<p>'+value+'</p>');
                                                setTimeout(function() {
                                                            $('.errmsg').hide();
                                                            $('.alert-danger').append('');
                                                            }, 2000);
                                            });
                                            //$("#result").html('');
                                            }
                                            
                                            
                                            
                                        });

                                        } );



                          //DELTE ITEM 
                                 $('body').on('click','#itemlitdelbtn',function(e){
                                 e.preventDefault();

                                    itemid = $(this).attr('data-itemid');


                                        $.ajax({
                                            url: 'invoiceitemdelete',
                                            type: 'DELETE',
                                            data: {
                                            itemid :itemid,
                                            },
                                            success: function(data){
                                                //alert(data);
                                                document.getElementById("invoiceitemeditform").reset();
                                                $('#editinvItemmodal').modal('toggle');
                                                $.iaoAlert({msg: "Invoice item deleted successfully ",
                                                    type: "success",
                                                    mode: "dark",});

                                            getinvoiceitems();
                                    
                                            },
                                            error: function (request, checklist, error) {
                                            //$("#result").html('');
                                            }


                                        });
                                });


                    getprojectapp();
                    function getprojectapp(){

                        $('body').on('change','#project_id',function(e){

                            projectid = $(this).val();

                            $.ajax({
                            url: 'getprojectapp',
                            type: 'GET',
                            data: {
                            projectid:projectid,
                            _token: '{{csrf_token()}}'
                            },
                            success: function(response){
                            if (response) {
                               //alert(response);exit();
                             $("#app_id").html(response);
                            
                            }
                            },
                            error: function() {
                            alert('Error occurs!');
                            }
                            });
                        });
                    }



    $(".summable").each(function() {
      $(this).keyup(function(){
        calculateSum();
      });
    });
  function calculateSum() {
    var sum = 0;
    $(".summable").each(function() {
      if(!isNaN(this.value) && this.value.length!=0) {
        sum += parseFloat(this.value);
      }
    });
    $("#total").val(sum.toFixed(2));
  }


//for edit form
    $(".summableedit").each(function() {
      $(this).keyup(function(){
        calculateSumforedit();
      });
    });
  function calculateSumforedit() {
    var sum = 0;
    $(".summableedit").each(function() {
      if(!isNaN(this.value) && this.value.length!=0) {
        sum += parseFloat(this.value);
      }
    });
    $("#total_edit").val(sum.toFixed(2));
  }






} );



</script>

@endsection
