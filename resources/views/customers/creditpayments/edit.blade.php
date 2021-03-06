@extends('layouts.master')
@section('content')
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
       
      </h1>
      
    </section>

    <!-- Main content -->
    <section class="content">
    
      <!-- /.row --> 
      <div class="row">
        <div class="col-xs-12">
          <div class="box">
            <div class="box-header">
              Edit a Payment     
              <div class="box-tools">
              </div>
            </div>
            <!-- /.box-header -->
            <form action="{{route('creditpayments.update',['creditPayment'=>$creditPayment->id])}}" method="POST">
            {{ csrf_field() }}
            <div class="box-body">
              <div class="row">
                <div class="col-md-6">
                 
                  <!-- /.form-group -->
                    <div class="form-group">
                        <label>Transaction Date:</label>

                        <div class="input-group date">
                          <div class="input-group-addon">
                            <i class="fa fa-calendar"></i>
                          </div>
                          <input name="transaction_date" type="text" class="form-control pull-right" id="datepicker" value="{{Carbon\Carbon::parse($creditPayment->transaction_date)->format('m/d/Y')}}">
                        </div>
                        <!-- /.input group -->
                      </div>
                    <div class="form-group">
                      <label for="policy-id">Total Amount(Kshs)</label>
                      <input class="form-control" disabled="disabled" value="{{$creditPayment->customer->credits()->sum('amount')}}">
                    </div>
                    <div class="form-group">
                      <label for="policy-id">Paid Amount(Kshs)</label>
                      <input class="form-control" disabled="disabled" value="{{$creditPayment->customer->creditPayments()->sum('amount')}}">
                    </div>
                    <div class="form-group">
                      <label for="policy-id">Balance Amount(Kshs)</label>
                      <input class="form-control" disabled="disabled" value="{{$creditPayment->customer->credits()->sum('amount')-$creditPayment->customer->creditPayments()->sum('amount')}}">
                    </div>

                  <!-- /.form-group -->
                </div>
                <!-- /.col -->
                <div class="col-md-6">              
                  <!-- /.form-group -->
                    <div class="form-group">
                      <label for="policy-id">Amount(Kshs)</label>
                      <input class="form-control" name="amount" id="amount" value="{{$creditPayment->amount}}">
                  <!-- /.form-group -->
                    </div>
                  <div class="col-md-12">
                    <div class="row">
                    @include('layouts.error') 
                  </div>
                  </div>
                <!-- /.col -->
              </div>
              <!-- /.row -->
            </div>
            <div class="box-footer">
              <button type="submit" class="btn btn-primary">Add</button>
            </div>
            </form>
            <!-- /.box-body -->
          </div>
          <!-- /.box -->
        </div>
      </div>
      
    </section>
    <!-- /.content -->
</div>
  
@endsection