@extends('layouts.app')

@section('content_header')
<div class="container-fluid">
  <div class="row mb-2">
    <div class="col-sm-6">
      <h1 class="m-0">Half Leave</h1>
    </div><!-- /.col -->
    <div class="col-sm-6">
      <ol class="breadcrumb float-sm-right">
        <li class="breadcrumb-item"><a href="">Home</a></li>
        <li class="breadcrumb-item active">Half Leave</li>
      </ol>
    </div><!-- /.col -->
  </div><!-- /.row -->
</div><!-- /.container-fluid -->
@endsection

@section('main_content')
<div class="container-fluid">
  <div class="row">
    <!-- left column -->
    <div class="col-md-8 m-auto">
      <!-- general form elements -->
      <div class="card card-primary">
        <div class="card-header">
          <h3 class="card-title">Add Half Leave</h3>
        </div>
        <!-- /.card-header -->
        <!-- form start -->
        <form method="post" action="{{ route('halfleave_add_action') }}" onsubmit="return validateForm()">
          @csrf
          <div class="card-body">


             <label for="employeeId">Employee Name</label>
                <select class="form-control" name="employeeId">
                 <option value="">Select Employee</option>
                 <?php 
                    if(!empty($employees)){
                    foreach($employees as $emp){  ?>
                  
                    <option value="{{ $emp->id}}">{{$emp->name}}</option>
                    <?php } } ?>
                                        
                </select>

           
            <div class="form-group">
              <label for="date">Date</label>
              <input type="date" class="form-control" id="date" name="date" placeholder="Enter date">
              <p id="dateError" class="text-danger"></p>
            </div>
            <div class="form-group">
              <label for="startTime">Start Time</label>
              <input type="datetime-local" class="form-control" id="startTime" name="startTime" placeholder="Enter startTime">
              <p id="startTimeError" class="text-danger"></p>
            </div>
            <div class="form-group">
              <label for="endTime">End Time</label>
              <input type="datetime-local" class="form-control" id="endTime" name="endTime" placeholder="Enter endTime">
              <p id="endTimeError" class="text-danger"></p>
            </div>
            <div class="form-group">
              <label for="reason">Reason</label>
              <input type="text" class="form-control" id="reason" name="reason" placeholder="Enter reason">
              <p id="reasonError" class="text-danger"></p>
            </div>         
          </div>
          <!-- /.card-body -->
          <div class="card-footer">
            <button type="submit" class="btn btn-success">Submit</button>
            <a href="{{ route('halfleave_list') }}" class="btn btn-danger">Go Back</a>
          </div>
        </form>
      </div>
      <!-- /.card -->
    </div>
    <!--/.col (left) -->
  </div>
</div>
<!-- /.container-fluid -->

<script>
function validateForm() {
  var fields = [
    { id: "date", name: "date" },
    { id: "startTime", name: "startTime" },
    { id: "endTime", name: "endTime" },
    { id: "reason", name: "reason" }    
  ];

  var isValid = true;

  fields.forEach(function(field) {
    var value = document.getElementById(field.id).value.trim();
    var errorElement = document.getElementById(field.id + "Error");

    errorElement.innerText = "";

    if (value === "") {
      errorElement.innerText = "* Please enter the " + field.name;
      isValid = false;
      document.getElementById(field.id).classList.add("is-invalid");
    } else {
      document.getElementById(field.id).classList.remove("is-invalid");
    }
  });

  return isValid;
}
</script>
@endsection
