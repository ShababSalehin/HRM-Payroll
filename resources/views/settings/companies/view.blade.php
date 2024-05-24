
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
          <div class="col-md-6">
            <!-- general form elements -->
            <div class="card card-primary">
              <div class="card-header">
                <h3 class="card-title">View Company</h3>
              </div>
              <!-- /.card-header -->
              <!-- form start -->
              <form method="post" action="{{ route('update_company') }}" >
                @csrf
                <div class="card-body">

                <div class="form-group">
                    <label for="name">Name</label>
                    <input type="hidden"  class="form-control" id="id" name="id"  value="{{ $company_info->id }}" >
                    <input type="text" autocomplete="off" class="form-control" id="name" name="name" placeholder="Company Name" value="{{ $company_info->name }}" >
                  </div>  

                  <div class="form-group">
                    <label for="code">Code</label>
                    <input type="text" autocomplete="off" class="form-control" id="code" name="code" placeholder="Enter Code" value="{{ $company_info->code }}">
                  </div>  

                <div class="form-group">
                    <label for="address">Address</label>
                    <input type="text" autocomplete="off" class="form-control" id="address" name="address" placeholder="Enter Address" value="{{ $company_info->address }}">
                  </div>  

                  <div class="form-group">
                    <label for="exampleInputEmail1">Email address</label>
                    <input type="email" autocomplete="off" class="form-control" id="exampleInputEmail1" name="email" placeholder="Enter Email" value="{{ $company_info->email }}">
                  </div>

                  <div class="form-group">
                    <label for="exampleInputEmail1">Phone</label>
                    <input type="text" autocomplete="off" class="form-control" id="phone" name="phone" placeholder="Enter Phone" value="{{ $company_info->phone }}">
                  </div>     

            <!--
                  <div class="form-group">
                    <label for="exampleInputFile">Company Logo</label>
                    <div class="input-group">
                      <div class="custom-file">
                        <input type="file" class="custom-file-input" id="exampleInputFile">
                        <label class="custom-file-label" for="exampleInputFile">Choose file</label>
                      </div>
                      <div class="input-group-append">
                        <span class="input-group-text">Upload</span>
                      </div>
                    </div>
                  </div>
            -->      
                 
                </div>
                <!-- /.card-body -->

                <div class="card-footer">
                  
                  <a href="{{ route('company_list') }}">  <button type="button" class="btn btn-primary">Go Back</button> </a>
                  
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
@endsection   