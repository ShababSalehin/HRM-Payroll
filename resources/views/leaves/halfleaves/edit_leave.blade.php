
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
                <h3 class="card-title">Edit Half Leave</h3>
              </div>
              <!-- /.card-header -->
              <!-- form start -->
              <form method="post" action="{{ route('update_halfleave') }}"  onsubmit="return validateForm()">
                @csrf
                <div class="card-body">



                     <!-- Dropdown to select and edit the employee name -->
                     <div class="form-group">
                        <label for="employeeId">Employee Name</label>

                        <input type="hidden"  class="form-control" id="id" name="id"  value="{{ $leave_info->id }}" >
                        
                        <select class="form-control" name="employeeId">
                           <option value="">Select Employee</option>
                           @foreach($employees as $emp)
                              <option value="{{ $emp->id }}" @if($emp->id == $leave_info->employeeId) selected @endif>{{ $emp->name }}</option>
                           @endforeach
                        </select>

                     </div>


                  <div class="form-group">
                    <label for="date">date</label>  
                    <input type="date" autocomplete="off" class="form-control" id="date" name="date" placeholder="Enter date" value="{{ $leave_info->date }}" >
                    <p id="dateError" class="text-danger"></p>

                  </div>  

                  <div class="form-group">
                  <label for="startTime">startTime</label>
                    <input type="datetime-local" autocomplete="off" class="form-control" id="startTime" name="startTime" placeholder="Enter startTime" value="{{ $leave_info->startTime }}">
                    <p id="startTimeError" class="text-danger"></p>

                  </div>  

                  <div class="form-group">
                    <label for="endTime">endTime</label>
                    <input type="datetime-local" autocomplete="off" class="form-control" id="endTime" name="endTime" placeholder="Enter endTime" value="{{ $leave_info->endTime }}">
                    <p id="endTimeError" class="text-danger"></p>

                  </div>  

                  <div class="form-group">
                    <label for="reason">reason</label>
                    <input type="text" autocomplete="off" class="form-control" id="reason" name="reason" placeholder="Enter reason" value="{{ $leave_info->reason }}">
                    <p id="reasonError" class="text-danger"></p>

                  </div>               
                  

                 
                </div>
                <!-- /.card-body -->

                <div class="card-footer">
                  <button type="submit" class="btn btn-success">Update</button>
                  <a href="{{ route('halfleave_list') }}">  <button type="button" class="btn btn-danger">Go Back</button> </a>
                  
                </div>
              </form>
            </div>
            <!-- /.card -->

               

          </div>
          <!--/.col (left) -->
            </div>

       
        </div>
        <!-- /.row -->
       
        
        <!-- /.row -->
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