
    @extends('layouts.app')  

    @section('content_header')
       <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0">leave</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="">Home</a></li>
              <li class="breadcrumb-item active">leave</li>
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
                <h3 class="card-title">Edit leave</h3>
              </div>
              <!-- /.card-header -->
              <!-- form start -->
              <form method="post" action="{{ route('update_leave') }}"  onsubmit="return validateForm()">
                @csrf
                <div class="card-body">

                <div class="form-group">
                    <label for="name">leave name</label>
                    <input type="hidden"  class="form-control" id="id" name="id"  value="{{ $leave_info->id }}" >
                    <input type="text" autocomplete="off" class="form-control" id="name" name="name" placeholder=" Name" value="{{ $leave_info->name }}" >
                    <p id="nameError" class="text-danger"></p>

                  </div>  

                  <div class="form-group">
                  <label for="short_name">Short Name</label>
                    <input type="text" autocomplete="off" class="form-control" id="short_name" name="short_name" placeholder="Enter branch Name" value="{{ $leave_info->short_name }}">
                    <p id="short_nameError" class="text-danger"></p>

                  </div>  

                  <div class="form-group">
                    <label for="description">Description</label>
                    <input type="text" autocomplete="off" class="form-control" id="description" name="description" placeholder="Enter leave Type" value="{{ $leave_info->description }}">
                    <p id="descriptionError" class="text-danger"></p>

                  </div>  

                  <div class="form-group">
                    <label for="allowedLeave">Allow Type</label>
                    <input type="text" autocomplete="off" class="form-control" id="allowedLeave" name="allowedLeave" placeholder="Enter Allow Type" value="{{ $leave_info->allowedLeave }}">
                    <p id="allowedLeaveError" class="text-danger"></p>

                  </div>
                  

                 
                </div>
                <!-- /.card-body -->

                <div class="card-footer">
                  <button type="submit" class="btn btn-success">Update</button>
                  <a href="{{ route('leave_list') }}">  <button type="button" class="btn btn-danger">Go Back</button> </a>
                  
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
    { id: "name", name: "Name" },
    { id: "short_name", name: "Short Name" },
    { id: "description", name: "Description" },
    { id: "allowedLeave", name: "Allow Type" }
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