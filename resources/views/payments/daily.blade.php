@extends('layouts.master')
@section('content')
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
    </section>


    <!-- Main content -->
    <section class="content">
      <!-- /.row -->      
      <div class="row">
        <div class="col-xs-12">
          <div class="box">
            <div class="box-header">
              <p>Payments</p>    
              
            </div>
            <!-- /.box-header -->
            <form action="{{route('payments.daily')}}" method="POST">
            <div class="box-body">
              <div class="row">
                <div class="col-md-6">
                      <div class="form-group">
                        <label>Date:</label>

                        <div class="input-group date">
                          <div class="input-group-addon">
                            <i class="fa fa-calendar"></i>
                          </div>
                          <input name="date" type="text" class="form-control pull-right" id="datepicker" >
                        </div>
                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                      </div>
                </div>
                <!-- /.col -->
                <div class="col-md-6">              
                  <!-- /.form-group -->
                  <div class="form-group" style="margin-top:25px">
                    <button type="submit" class="btn btn-primary">Submit</button>
                  </div>
                </div>
                <!-- /.col -->
              </div>
              <row>
                @include('layouts.error')
                
              </row>
              <!-- /.row -->
            </div>
            </form>
            <!-- /.box-body -->
          </div>
          <!-- /.box -->
        </div>
      </div>
      <div class="row">
        <div class="col-xs-12">
        <div class="box box-default">
          <div class="box-header with-border">
          Daily Payments      
            <div class="box-tools pull-right">
              <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
               <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-remove"></i></button>
            </div>
          </div>
          <!-- /.box-header -->
          
          <div class="box-body table-responsive no-padding">
            <table class="table table-hover">
            <tr>
                <th>Id</th>
                <th>Date</th>
                <th>Policy</th>
                <th>Customer</th>
                <th>Vehicle</th>
                <th>Amount</th>
                               
              </tr>
              @foreach($payments as $payment)
              <tr>
                <td>{{$payment->id}}</td>
                <td>{{$payment->created_at->toDateString()}}</td>
                <td>{{$payment->paymentSchedule->policy->policy_no}}</td>
                <td>{{$payment->paymentSchedule->policy->customer->firstname}} {{$payment->paymentSchedule->policy->customer->lastname}}</td>
                <td>{{$payment->paymentSchedule->policy->vehicle->registration}}</td>
                <td>{{$payment->amount}}</td>
                               
              </tr>
              @endforeach
            </table>
          </div>
          <div class="box-footer">
           <button type="button" class="btn btn-primary pull-right">Total Kshs:{{$payments->sum('amount')}}</button>
          </div>
        
          <!-- /.box-body -->
        </div>
        <!-- /.box -->
        </div>
      </div>
     
    </section>
    <!-- /.content -->
</div>
  
@endsection