@extends('layouts.app')  

@section('content_header')
    <!-- Header code -->
@endsection

@section('main_content')
    <div class="container-fluid">
        <div class="row">
            <!-- left column -->
            <div class="col-md-8 m-auto">
                <!-- general form elements -->
                <div class="card card-primary">
                    <div class="card-header">
                        <h3 class="card-title">View Half Leave</h3>
                    </div>
                    <!-- /.card-header -->
                    <!-- form start -->
                    <form method="post" action="{{ route('update_halfleave') }}">
                        @csrf
                        <div class="card-body">
                           <div class="form-group">
                                <label for="employeeName">Employee Name</label>
                                <input type="hidden" class="form-control" id="id" name="id" value="{{ $leave_info->id }}" >
                                <input type="text" class="form-control" id="name" name="name" value="{{ $leave_info->id }}" readonly>
                            </div>

                            <div class="form-group">
                                <label for="date">date</label>  
                                <input type="date" autocomplete="off" class="form-control" id="date" name="date" placeholder="Enter date" value="{{ $leave_info->date }}" readonly>                   
                            </div>  

                            <div class="form-group">
                                <label for="startTime">startTime</label>
                                <input type="datetime-local" autocomplete="off" class="form-control" id="startTime" name="startTime" placeholder="Enter startTime" value="{{ $leave_info->startTime }}"readonly>
                            </div>  

                            <div class="form-group">
                                <label for="endTime">endTime</label>
                                <input type="datetime-local" autocomplete="off" class="form-control" id="endTime" name="endTime" placeholder="Enter endTime" value="{{ $leave_info->endTime }}"readonly>
                            </div>  

                            <div class="form-group">
                                <label for="reason">reason</label>
                                <input type="text" autocomplete="off" class="form-control" id="reason" name="reason" placeholder="Enter reason" value="{{ $leave_info->reason }}"readonly>
                            </div>                
                        </div>
                        <!-- /.card-body -->

                        <div class="card-footer">
                            <a href="{{ route('halfleave_list') }}">  <button type="button" class="btn btn-danger">Go Back</button> </a>
                        </div>
                    </form>
                </div>
                <!-- /.card -->
            </div>
            <!--/.col (left) -->
        </div>
    </div>
@endsection
