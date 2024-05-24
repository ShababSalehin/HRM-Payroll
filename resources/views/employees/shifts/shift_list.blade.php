
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

      <div class="col-md-1">
          <a style="" href="{{ route('shift_add') }}"><button type="button" class="btn btn-block btn-primary">Add</button></a>
      </div> 
      <br />
       <div class="container-fluid">
        <div class="row">
          <div class="col-12">
            <div class="card">
              <div class="card-header">
                <h3 class="card-title">Shift List</h3>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                <table id="example2" class="table table-bordered table-hover">
                  <thead>
                  <tr>
                    <th>Shift</th>
                    <th>Shift Code</th>
                    <th>Start Time</th>
                    <th>End Time</th>
                    <th>Weekend</th>
                    <th>To Shift</th>
                    <th>Intime Range</th>
                    <th>Outtime Range</th>
                    <th>Action</th>
                  </tr>
                  </thead>
                  <tbody>
                    <?php 
                    if(!empty($shifts)){
                    foreach($shifts as $sft){  ?>
                        <tr>
                          <td>{{ $sft->shift }}</td>
                          <td>{{ $sft->shiftCode }}</td>
                          <td>{{ $sft->startTime }}</td>
                          <td>{{ $sft->endTime }}</td>
                          <td>{{ $sft->weekend }}</td>
                          <td>{{ $sft->toShift }}</td>
                          <td>{{ $sft->intimeRange }}</td>
                          <td>{{ $sft->outtimeRange }}</td>
                          <td>
                            <a href="{{route('view_shift', $sft->id)}}"><button type="button" class="btn  btn-sm btn-primary">View</button></a>
                            <a href="{{route('edit_shift', $sft->id)}}"><button type="button" class="btn  btn-sm btn-success">Edit</button></a>
                            <a href="{{route('shift_delete', $sft->id)}}"><button type="button" class="btn  btn-sm btn-danger">Delete</button></a>
                          </td>
                        </tr>
                    <?php 
                      }
                    } ?>    
                  
                  </tfoot>
                </table>
              </div>
              <!-- /.card-body -->
            </div>
            <!-- /.card -->

           
          </div>
          <!-- /.col -->
        </div>
        <!-- /.row -->
      </div>
      <!-- /.container-fluid -->
@endsection   