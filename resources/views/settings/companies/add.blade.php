@extends('layouts.app')

@section('content_header')
<div class="container-fluid">
  <div class="row mb-2">
    <div class="col-sm-6">
      <h1 class="m-0">Company</h1>
    </div><!-- /.col -->
    <div class="col-sm-6">
      <ol class="breadcrumb float-sm-right">
        <li class="breadcrumb-item"><a href="#">Home</a></li>
        <li class="breadcrumb-item active">Company</li>
      </ol>
    </div><!-- /.col -->
  </div><!-- /.row -->
</div><!-- /.container-fluid -->
@endsection

@section('main_content')
<div class="container-fluid">
  <div class="row  d-flex  justify-content-center m-auto">
    <!-- left column -->
    <div class="col-md-8">
      <!-- general form elements -->
      <div class="card card-info">
        <div class="card-header">
          <h3 class="card-title">Add Company</h3>
        </div>
        <!-- /.card-header -->
        <!-- form start -->
        <form method="post" action="{{ route('company_add_action') }}" onsubmit="return validateForm()">
          @csrf
          <div class="card-body">
          <div class="form-group">
              <label for="code">Code</label>
              <input type="text" autocomplete="off" class="form-control" id="code" name="code" placeholder="Enter Code">
              <p id="codeError" class="text-danger"></p>
            </div>
            <div class="form-group">
              <label for="name">Name</label>
              <input type="text" autocomplete="off" class="form-control" id="name" name="name" placeholder="Company Name">
              <p id="nameError" class="text-danger"></p>
            </div>
           
            <div class="form-group">
              <label for="address">Address</label>
              <input type="text" autocomplete="off" class="form-control" id="address" name="address" placeholder="Enter Address">
              <p id="addressError" class="text-danger"></p>
            </div>
            <div class="form-group">
              <label for="phone">Phone</label>
              <input type="text" autocomplete="off" class="form-control" id="phone" name="phone" placeholder="Enter Phone">
              <p id="phoneError" class="text-danger"></p>
            </div>
            <div class="form-group">
              <label for="exampleInputEmail1">Email address</label>
              <input type="email" autocomplete="off" class="form-control" id="email" name="email" placeholder="Enter Email">
              <p id="emailError" class="text-danger"></p>
            </div>
            
          </div>
          <!-- /.card-body -->
          <div class="card-footer">
            <button type="submit" class="btn btn-success">Submit</button>
            <a href="{{ route('company_list') }}" class="btn btn-danger">Go Back</a>
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
    
    { id: "code", name: "Code" },
    { id: "name", name: "Name" },
    { id: "address", name: "Address" },
    
    { id: "phone", name: "Phone" },
    { id: "email", name: "Email address" },
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
