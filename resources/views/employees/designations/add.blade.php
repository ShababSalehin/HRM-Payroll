@extends('layouts.app')

@section('content_header')
<div class="container-fluid">
  <div class="row mb-2">
    <div class="col-sm-6">
      <h1 class="m-0">Designation</h1>
    </div><!-- /.col -->
    <div class="col-sm-6">
      <ol class="breadcrumb float-sm-right">
        <li class="breadcrumb-item"><a href="">Home</a></li>
        <li class="breadcrumb-item active">Designation</li>
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
          <h3 class="card-title">Add Designation</h3>
        </div>
        <!-- /.card-header -->
        <!-- form start -->
        <form method="post" action="{{ route('designation_add_action') }}" onsubmit="return validateForm()">
          @csrf
          <div class="card-body">
            <div class="form-group">
              <label for="desig_name">Designation Name</label>
              <input type="text" autocomplete="off" class="form-control" id="desig_name" name="desig_name" placeholder="Designation Name">
              <p id="desig_nameError" class="text-danger"></p>
            </div>
            <div class="form-group">
              <label for="desig_description">Designation Description</label>
              <input type="text" autocomplete="off" class="form-control" id="desig_description" name="desig_description" placeholder="Enter Designation Description">
              <p id="desig_descriptionError" class="text-danger"></p>
            </div>
            <div class="form-group">
              <label for="desig_short_name">Designation Short Name</label>
              <input type="text" autocomplete="off" class="form-control" id="desig_short_name" name="desig_short_name" placeholder="Enter Designation Short Name">
              <p id="desig_short_nameError" class="text-danger"></p>
            </div>
            <div class="form-group">
              <label for="desig_rank">Designation Rank</label>
              <input type="text" autocomplete="off" class="form-control" id="desig_rank" name="desig_rank" placeholder="Enter Designation Rank">
              <p id="desig_rankError" class="text-danger"></p>
            </div>
          </div>
          <!-- /.card-body -->

          <div class="card-footer">
            <button type="submit" class="btn btn-success">Submit</button>
            <a href="{{ route('designation_list') }}" class="btn btn-primary">Go Back</a>
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
    { id: "desig_name", name: "Designation Name" },
    { id: "desig_description", name: "Designation Description" },
    { id: "desig_short_name", name: "Designation Short Name" },
    { id: "desig_rank", name: "Designation Rank" }
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
