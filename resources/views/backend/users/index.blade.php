@extends('layouts.dashboard-layouts')
@section('content')
 <!-- Counts Section -->
 <div class="breadcrumb-holder">
        <div class="container-fluid">
          <ul class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{route('dashboard')}}">Home</a></li>
            <li class="breadcrumb-item active">admin</li>
            <li class=" offset-10"> <button class=" btn btn-sm btn-success admin-create">Create</button></li>
          </ul>
        </div>
      </div>
 <section class="dashboard-counts section-padding">
        <div class="container-fluid">
          <div class="row justify-content-center">
            <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                  <h4>Admin Table</h4>
                 
                </div>
                <div class="card-body">
                  <div class="table-responsive">
                    <table class="table table-striped">
                      <thead>
                        <tr>
                          <th>SL</th>
                          <th> Image</th>
                          <th> Name</th>
                          <th> Role</th>
                          <th> Phone</th>
                          <th> Email</th>
                          <th> Action</th>
                        </tr>
                      </thead>
                      <tbody>
                          @foreach($admin as $key=>$data)
                          @if($data->id!=Auth::user()->id)
                        <tr>
                          <th scope="row">{{$loop->iteration}}</th>    
                          <td><img src="{{asset($data->image ?? '') }}" alt="person" class="img-fluid rounded-circle mCS_img_loaded" height="50px" width="50px"></td>
                          <td>{{$data->name ?? ''}}</td>
                          <td>{{$data->role->name ?? ''}}</td>
                          <td>{{$data->phone ?? ''}}</td>
                          <td>{{$data->email ?? ''}}</td>
                          <td>
                              <table>
                                  <tr>
                                      <td><button class="btn btn-sm btn-primary edit" data-id="{{$data->id ?? ''}}" data-name="{{$data->name ?? ''}}" 
                                      data-phone="{{$data->phone ?? ''}}"
                                      data-role_id="{{$data->role_id ?? ''}}"
                                       data-email="{{$data->email ?? ''}}"
                                       ><i class="fa fa-edit"></i>Edit</button></td>
                                       <td><a href="{{route('admin.active',$data->id)}}" class="btn btn-sm btn-info"><i class="fa {{$data->status==1? 'fa-eye' : 'fa-eye-slash'}} "></i></a></td>
                                      <td><a class="btn btn-sm btn-danger delete" onclick="return confirm('do you want to delete')" href="{{route('admin.delete',$data->id)}}"><i class="fa fa-trash"></i>Delete</a></td>
                                  </tr>
                              </table>
                          </td>
                        </tr>
                        @endif
                        @endforeach
                      </tbody>
                      <tfoot> 
                        <tr>
                          <th>SL</th>
                          <th> Image</th>
                          <th> Name</th>
                          <th> Role</th>
                          <th> Phone</th>
                          <th> Email</th>
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
                <form id="admin-form" method="post" enctype="multipart/form-data">
                    @csrf
                    <input type="hidden" id="admin_id" name="id" value="">
                    <div class="form-group">
                    <label> Name</label>
                    <input type="text" id="name" name="name" placeholder="admin Name" class="form-control @error('name') is-invalid @enderror" required>
                    @error('name')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                        </div>
                        <div class="form-group">
                    <label>  Role</label>
                    <select name="role_id" id="adminDegId" class="adminDegId form-control ">
                        <option value="">Select</option>
                        @foreach($adminrole as $data)
                          <option value="{{ $data->id ?? ''}}">{{$data->name  ?? ''}}</option>
                          @endforeach
                        </select>
                    @error('name')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                </div>
                        <div class="form-group">
                            <label> Phone</label>
                            <input type="text" id="phone" name="phone" placeholder=" phone" class="form-control @error('phone') is-invalid @enderror" required>
                            @error('phone')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label> Email</label>
                            <input type="text" id="email" name="email" placeholder="admin email" class="form-control @error('email') is-invalid @enderror" required>
                            @error('email')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label> Password</label>
                            <input type="password" id="password" name="password" placeholder="Password" class="form-control @error('password') is-invalid @enderror" >
                            @error('password')
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
    $(document).ready(function(){
        
        $('.admin-create').click(function(e){
            $("#myModal").modal('show')
            $("#admin-form").attr('action',"{{route('admin-user-store')}}")
            $('.modal-title').html('Create Admin')
            FormResetData();
        })
        $('.edit').click(function(e){
            FormResetData();
            $("#myModal").modal('show')
            $("#admin_id").val($(this).data('id'))
            $("#name").val($(this).data('name'))
            $("#phone").val($(this).data('phone'))
            $("#email").val($(this).data('email'))
            var desig=$(this).data('role_id')
            $('#adminDegId').val(desig).prop('selected', true);
            $('.modal-title').html('Update admin')
            $("#admin-form").attr('action',"{{route('admin-user-update')}}")
        })
        function FormResetData(){
            $("#admin_id").val('');
            $("#name").val('');
            $("#description").val('');
            $('#adminDegId').val('').prop('selected', false);
            $("#phone").val('')
            $("#email").val('')
            $("#address").val('')
            $("#joining_date").val('')
            $("#image").val('')
        }
    })
</script>
@endsection