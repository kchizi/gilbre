@extends('layouts.master')
@section('content')
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Non Members
      </h1>
    </section>

    <!-- Main content -->
     <section class="content">
      <div class="row">
        <div class="col-xs-12">
          <div class="box">
            <div class="box-header">
              <h3 class="box-title"></h3>
              <a href="{{route('customers.create2')}}" class="btn btn-primary pull-right"><i class="fa fa-plus"></i>Add Non Member</a>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
              <table id="nonMembersDataTable" class="table table-bordered table-striped">
                <thead>
                <tr>
                 <th>Id</th>
                 <th>Name</th>
                 <th>Contact</th>
                 <th>Address</th>
                 <th class="pull-right">Action</th>
                </tr>
                </thead>
              </table>
            </div>
            <!-- /.box-body -->
          </div>
          <!-- /.box -->
        </div>
        <!-- /.col -->
      </div>
      <!-- /.row -->
    </section>
    <!-- /.content -->
</div>

@endsection