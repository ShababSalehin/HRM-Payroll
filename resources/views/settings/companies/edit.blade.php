@extends('layouts.app')

@section('content_header')
<div class="container-fluid">
  <div class="row mb-2">
    <div class="col-sm-6">
      <h1 class="m-0">Company</h1>
    </div><!-- /.col -->
    <div class="col-sm-6">
      <ol class="breadcrumb float-sm-right">
        <li class="breadcrumb-item"><a href="">Home</a></li>
        <li class="breadcrumb-item active">Company</li>
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
          <h3 class="card-title">Edit Company</h3>
        </div>
        <!-- /.card-header -->
        <!-- form start -->
        <form method="post" action="{{ route('update_company') }}" onsubmit="return validateForm()">
          @csrf
          <div class="card-body">
            <div class="form-group">
              <label for="name">Name</label>
              <input type="hidden" class="form-control" id="id" name="id" value="{{ $company_info->id }}">
              <input type="text" autocomplete="off" class="form-control" id="name" name="name" placeholder="Company Name" value="{{ $company_info->name }}">
              <p id="nameError" class="text-danger"></p>
            </div>
            <div class="form-group">
              <label for="code">Code</label>
              <input type="text" autocomplete="off" class="form-control" id="code" name="code" placeholder="Enter Code" value="{{ $company_info->code }}">
              <p id="codeError" class="text-danger"></p>
            </div>
            <div class="form-group">
              <label for="address">Address</label>
              <input type="text" autocomplete="off" class="form-control" id="address" name="address" placeholder="Enter Address" value="{{ $company_info->address }}">
              <p id="addressError" class="text-danger"></p>
            </div>
            <div class="form-group">
              <label for="email">Email address</label>
              <input type="email" autocomplete="off" class="form-control" id="email" name="email" placeholder="Enter Email" value="{{ $company_info->email }}">
              <p id="emailError" class="text-danger"></p>
            </div>
            <div class="form-group">
              <label for="phone">Phone</label>
              <input type="text" autocomplete="off" class="form-control" id="phone" name="phone" placeholder="Enter Phone" value="{{ $company_info->phone }}">
              <p id="phoneError" class="text-danger"></p>
            </div>
          </div>
          <!-- /.card-body -->

          <div class="card-footer">
            <button type="submit" class="btn btn-success">Update</button>
            <a href="{{ route('company_list') }}"><button type="button" class="btn btn-danger">Go Back</button></a>
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
    { id: "name", name: "Name" },
    { id: "code", name: "Code" },
    { id: "address", name: "Address" },
    { id: "email", name: "Email address" },
    { id: "phone", name: "Phone" }
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
