
    @extends('layouts.app')  

    @section('content_header')
       <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0">Shift</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="">Home</a></li>
              <li class="breadcrumb-item active">Shift</li>
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
                <h3 class="card-title">Edit Shift</h3>
              </div>
              <!-- /.card-header -->
              <!-- form start -->
              <form method="post" action="{{ route('update_shift') }}" >
                @csrf
                <div class="card-body">

                <div class="form-group">
                    <label for="shift">shift</label>
                    <input type="hidden"  class="form-control" id="id" name="id"  value="{{ $shift_info->id }}" >
                    <input type="text" autocomplete="off" class="form-control" id="shift" name="shift" placeholder="Enter shift" value="{{ $shift_info->shift }}" >
                  </div>  

                  <div class="form-group">
                    <label for="shiftCode">shiftCode</label>
                    <input type="text" autocomplete="off" class="form-control" id="shiftCode" name="shiftCode" placeholder="Enter shiftCode" value="{{ $shift_info->shiftCode }}">
                  </div>  

                  <div class="form-group">
                    <label for="startTime">startTime</label>
                    <input type="text" autocomplete="off" class="form-control" id="startTime" name="startTime" placeholder="Enter startTime" value="{{ $shift_info->startTime }}">
                  </div>  

                  <div class="form-group">
                    <label for="endTime">endTime</label>
                    <input type="text" autocomplete="off" class="form-control" id="endTime" name="endTime" placeholder="Enter endTime" value="{{ $shift_info->endTime }}">
                  </div>  

                  <div class="form-group">
                    <label for="weekend">weekend</label>
                    <input type="text" autocomplete="off" class="form-control" id="weekend" name="weekend" placeholder="Enter weekend" value="{{ $shift_info->weekend }}">
                  </div>  

                  <div class="form-group">
                    <label for="to">toShift</label>
                    <input type="text" autocomplete="off" class="form-control" id="toShift" name="toShift" placeholder="Enter toShift" value="{{ $shift_info->toShift }}">
                  </div>  

                  <div class="form-group">
                    <label for="intimeRange">intimeRange</label>
                    <input type="text" autocomplete="off" class="form-control" id="intimeRange" name="intimeRange" placeholder="Enter intimeRange" value="{{ $shift_info->intimeRange }}">
                  </div>  

                  <div class="form-group">
                    <label for="outtimeRange">outtimeRange</label>
                    <input type="text" autocomplete="off" class="form-control" id="outtimeRange" name="outtimeRange" placeholder="Enter outtimeRange" value="{{ $shift_info->outtimeRange }}">
                  </div>  

          
            <!--
                  <div class="form-group">
                    <label for="exampleInputFile">shift Logo</label>
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
                  <button type="submit" class="btn btn-primary">Update</button>
                  <a href="{{ route('shift_list') }}">  <button type="button" class="btn btn-primary">Go Back</button> </a>
                  
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