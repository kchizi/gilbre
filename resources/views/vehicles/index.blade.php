@extends('layouts.master')
@section('content')
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      
    </section>

    <!-- Main content -->
    <section class="content">
      <!-- /.row -->
      @include('layouts.customer-menu') 
      <div class="row">
        <div class="col-xs-12">
          <div class="box">
            <div class="box-header">
              <a href="{{route('vehicles.create',['customer'=>$customer->id])}}" class="btn btn-sm btn-primary"><span class="glyphicon glyphicon-plus"></span> Add Vehicle </a>


              <div class="box-tools pull-right">
                <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
                 <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-remove"></i></button>
              </div>
            </div>
            <!-- /.box-header -->
            <div class="box-body table-responsive no-padding">
              <table class="table table-hover">
              <tr>
                  <th></th>
                  <th>Registration</th>
                  <th>Year</th>
                  <th>Make</th>
                  <th>Model</th>
                  <th>Capacity</th>
                  
                </tr>
              @foreach($customer->vehicles as $vehicle)
                <tr>
                  <td><a href="{{route('vehicles.show',['customer'=>$customer->id,'vehicle'=>$vehicle->id])}}" class="btn btn-xs btn-info">details</a></td>
                  <td>{{$vehicle->registration}}</td>
                  <td>{{$vehicle->year}}</td>
                  <td>{{$vehicle->make}}</td>
                  <td>{{$vehicle->model}}</td>
                  <td>{{$vehicle->capacity}}</td>
                   <td><a href="#" class="btn btn-xs btn-info">Edit</a></td>
                </tr>
              @endforeach
              </table>
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