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
              Add a Credit Amount     
              <div class="box-tools">
              </div>
            </div>
            <!-- /.box-header -->
            <form action="{{route('tyres.credits.store',['customer'=>$customer->id])}}" method="POST">
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
                          <input name="transaction_date" type="text" class="form-control pull-right" id="datepicker" >
                        </div>
                        <!-- /.input group -->
                      </div>
                      <div class="form-group">
                      <label >Description</label>
                      <input class="form-control" name="description" placeholder="Description" >
                    </div>

                  <!-- /.form-group -->
                </div>
                <!-- /.col -->
                <div class="col-md-6">              
                  <!-- /.form-group -->
                    <div class="form-group">
                      <label for="policy-id">Amount(Kshs)</label>
                      <input class="form-control" name="amount" id="amount" placeholder="Amount">
                    </div>
                    <div class="form-group">
                      <label>Type</label>
                      <select  class="form-control" name="type"  >
                      @foreach($paymentTypes as $paymentType)
                        <option>{{$paymentType->name}}</option>
                      @endforeach      
                      </select>
                    </div>
                    <div class="form-group">
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