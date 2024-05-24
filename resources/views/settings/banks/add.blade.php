
    @extends('layouts.app')  

    @section('content_header')
       <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0">Bank</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="">Home</a></li>
              <li class="breadcrumb-item active">Bank</li>
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
                <h3 class="card-title">Add Bank</h3>
              </div>
              <!-- /.card-header -->
              <!-- form start -->
              <form method="post" action="{{ route('bank_add_action') }}" >
                @csrf
                <div class="card-body">

                  
            
              <label for="name">Company Name</label>
                <select class="form-control" name="company_id">
                 <option value="">Select Company</option>
                 <?php 
                    if(!empty($companies)){
                    foreach($companies as $com){  ?>
                  
                    <option value="{{ $com->id}}">{{$com->name}}</option>
                    <?php } } ?>
                                        
                </select>
           

                <div class="form-group">
                    <label for="name">Name</label>
                    <input type="text" autocomplete="off" class="form-control" id="name" name="name" placeholder="Enter bank_name">
                  </div>  

                  <div class="form-group">
                    <label for="company_account">company_account</label>
                    <input type="text" autocomplete="off" class="form-control" id="company_account" name="company_account" placeholder="Enter company_account">
                  </div>  

                <div class="form-group">
                    <label for="branch_name">branch_name</label>
                    <input type="text" autocomplete="off" class="form-control" id="branch_name" name="branch_name" placeholder="Enter branch_name">
                  </div>  

                  <div class="form-group">
                    <label for="bank_type">bank_type</label>
                    <input type="bank_type" autocomplete="off" class="form-control" id="bank_type" name="bank_type" placeholder="Enter bank_type">
                  </div>

                  <div class="form-group">
                    <label for="routing_number">routing_number</label>
                    <input type="text" autocomplete="off" class="form-control" id="routing_number" name="routing_number" placeholder="Enter routing_number">
                  </div>     

            <!--
                  <div class="form-group">
                    <label for="exampleInputFile">bank Logo</label>
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
                  <button type="submit" class="btn btn-primary">Submit</button>
                   <a href="{{ route('bank_list') }}">  <button type="button" class="btn btn-primary">Go Back</button> </a>
                  
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