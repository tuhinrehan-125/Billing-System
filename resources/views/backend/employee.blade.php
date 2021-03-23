@extends('layouts.dashboard-layouts')
@section('content')
<!-- Counts Section -->
<div class="breadcrumb-holder">
  <div class="container-fluid">
    <ul class="breadcrumb">
      <li class="breadcrumb-item"><a href="{{route('dashboard')}}">Home</a></li>
      <li class="breadcrumb-item active">Employee</li>
      <li class=" offset-10"> <button class=" btn btn-sm btn-success employee-create">Create</button></li>
    </ul>
  </div>
</div>
<section class="dashboard-counts section-padding">
  <div class="container-fluid">
    <div class="row justify-content-center">
      <div class="col-md-12">
        <div class="card">
          <div class="card-header">
            <h4>Employee Table</h4>

          </div>
          <div class="card-body">
            <div class="table-responsive">
              <table class="table table-striped">
                <thead>
                  <tr>
                    <th>SL</th>
                    <th> Image</th>
                    <th> Name</th>
                    <th> Designation</th>
                    <th> Phone</th>
                    <th> Email</th>
                    <th> Address</th>
                    <th> Joining Date</th>
                    <th> Action</th>
                  </tr>
                </thead>
                <tbody>
                  @foreach($employee as $key=>$data)
                  <tr>
                    <th scope="row">{{$loop->iteration}}</th>
                    <td><img src="{{asset($data->image ?? '') }}" alt="person" class="img-fluid rounded-circle mCS_img_loaded" height="50px" width="50px"></td>
                    <td>{{$data->name ?? ''}}</td>
                    <td>{{$data->Designation->name ?? ''}}</td>
                    <td>{{$data->phone ?? ''}}</td>
                    <td>{{$data->email ?? ''}}</td>
                    <td>{{$data->address ?? ''}}</td>
                    <td>{{$data->joining_date ?? ''}}</td>
                    <td>
                      <table>
                        <tr>
                          <td><button class="btn btn-sm btn-primary edit" data-id="{{$data->id ?? ''}}" data-name="{{$data->name ?? ''}}" data-designation="{{$data->designation ?? ''}}" data-phone="{{$data->phone ?? ''}}" data-email="{{$data->email ?? ''}}" data-address="{{$data->address ?? ''}}" data-joining_date="{{$data->joining_date ?? ''}}"><i class="fa fa-edit"></i>Edit</button></td>
                          <td><a class="btn btn-sm btn-danger delete" onclick="return confirm('do you want to delete')" href="{{route('employee.delete',$data->id)}}"><i class="fa fa-trash"></i>Delete</a></td>
                        </tr>
                      </table>
                    </td>
                  </tr>
                  @endforeach
                </tbody>
                <tfoot>
                  <tr>
                    <th>SL</th>
                    <th> Image</th>
                    <th> Name</th>
                    <th> Designation</th>
                    <th> Phone</th>
                    <th> Email</th>
                    <th> Address</th>
                    <th> Joining Date</th>
                    <th> Action</th>
                  </tr>
                </tfoot>
              </table>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>
<!-- Modal-->
<div id="myModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true" class="modal fade text-left">
  <div role="document" class="modal-dialog" style="min-width:1000px">
    <div class="modal-content">
      <div class="modal-header">
        <h5 id="exampleModalLabel" class="modal-title"></h5>
        <button type="button" data-dismiss="modal" aria-label="Close" class="close"><span aria-hidden="true">×</span></button>
      </div>
      <div class="modal-body">
        <!-- <p>Lorem ipsum dolor sit amet consectetur.</p> -->
        <form id="employee-form" method="post" enctype="multipart/form-data">
          @csrf
          <input type="hidden" id="employee_id" name="id" value="">
          <div class="form-group">
            <label>Employee Name</label>
            <input type="text" id="name" name="name" placeholder="Employee Name" class="form-control @error('name') is-invalid @enderror" required>
            @error('name')
            <span class="invalid-feedback" role="alert">
              <strong>{{ $message }}</strong>
            </span>
            @enderror
          </div>
          <div class="form-group">
            <label> Employee Designation</label>
            <select name="designation" id="employeeDegId" class="employeeDegId form-control ">
              <option value="">Select</option>
              @foreach($designation as $data)
              <option value="{{ $data->id ?? ''}}">{{$data->name ?? ''}}</option>
              @endforeach
            </select>
            @error('name')
            <span class="invalid-feedback" role="alert">
              <strong>{{ $message }}</strong>
            </span>
            @enderror
          </div>
          <div class="form-group">
            <label>Employee Phone</label>
            <input type="text" id="phone" name="phone" placeholder="Employee phone" class="form-control @error('phone') is-invalid @enderror" required>
            @error('phone')
            <span class="invalid-feedback" role="alert">
              <strong>{{ $message }}</strong>
            </span>
            @enderror
          </div>
          <div class="form-group">
            <label>Employee email</label>
            <input type="text" id="email" name="email" placeholder="Employee email" class="form-control @error('email') is-invalid @enderror" required>
            @error('email')
            <span class="invalid-feedback" role="alert">
              <strong>{{ $message }}</strong>
            </span>
            @enderror
          </div>
          <div class="form-group">
            <label>Employee address</label>
            <input type="text" id="address" name="address" placeholder="Employee address" class="form-control @error('address') is-invalid @enderror" required>
            @error('address')
            <span class="invalid-feedback" role="alert">
              <strong>{{ $message }}</strong>
            </span>
            @enderror
          </div>
          <div class="form-group">
            <label>Employee joining date</label>
            <input type="date" id="joining_date" name="joining_date" placeholder="Employee joining date" class="form-control @error('joining_date') is-invalid @enderror" required>
            @error('joining_date')
            <span class="invalid-feedback" role="alert">
              <strong>{{ $message }}</strong>
            </span>
            @enderror
          </div>
          <div class="form-group">
            <label>Employee Image</label>
            <input type="file" id="image" name="image" placeholder="Employee image" class="form-control @error('image') is-invalid @enderror">
            @error('image')
            <span class="invalid-feedback" role="alert">
              <strong>{{ $message }}</strong>
            </span>
            @enderror
          </div>

          <div class="form-group">
            <button class="btn btn-primary">Submit</button>
          </div>
        </form>
      </div>
      <div class="modal-footer">
        <button type="button" data-dismiss="modal" class="btn btn-secondary">Close</button>
        <!-- <button type="button" class="btn btn-primary">Save changes</button> -->
      </div>
    </div>
  </div>
</div>
@endsection
@section('js')
<script>
  $(document).ready(function() {

    $('.employee-create').click(function(e) {
      $("#myModal").modal('show')
      $("#employee-form").attr('action', "{{route('employee.store')}}")
      $('.modal-title').html('Create Employee')
      FormResetData();
    })
    $('.edit').click(function(e) {
      FormResetData();
      $("#myModal").modal('show')
      $("#employee_id").val($(this).data('id'))
      $("#name").val($(this).data('name'))
      $("#phone").val($(this).data('phone'))
      $("#email").val($(this).data('email'))
      $("#address").val($(this).data('address'))
      $("#joining_date").val($(this).data('joining_date'))
      var desig = $(this).data('designation')
      $('#employeeDegId').val(desig).prop('selected', true);
      $('.modal-title').html('Update Employee')
      $("#employee-form").attr('action', "{{route('employee.update')}}")
    })

    function FormResetData() {
      $("#employee_id").val('');
      $("#name").val('');
      $("#description").val('');
      $('#employeeDegId').val('').prop('selected', false);
      $("#phone").val('')
      $("#email").val('')
      $("#address").val('')
      $("#joining_date").val('')
      $("#image").val('')
    }
  })
</script>
@endsection