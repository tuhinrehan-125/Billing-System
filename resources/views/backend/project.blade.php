@extends('layouts.dashboard-layouts')
@section('content')
 <!-- Counts Section -->
 <div class="breadcrumb-holder">
        <div class="container-fluid">
          <ul class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{route('dashboard')}}">Home</a></li>
            <li class="breadcrumb-item active">Projects</li>
            <li class=" offset-10"> <button class=" btn btn-sm btn-success project-create">Create</button></li>
          </ul>
        </div>
      </div>
 <section class="dashboard-counts section-padding">
        <div class="container-fluid">
          <div class="row justify-content-center">
            <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                  <h4>Project Table</h4>
                 
                </div>
                <div class="card-body">
                  <div class="table-responsive">
                    <table class="table table-striped">
                      <thead>
                        <tr>
                          <th>SL</th>
                          <th> Image</th>
                          <th>Project Name</th>
                          <th> Project Value</th>
                          <th> Start Date</th>
                          <th> End Date</th>
                          <th> Company Nam</th>
                          <th> Phone</th>
                          <th> Email</th>
                          <th> Address</th>
                          <th> Action</th>
                        </tr>
                      </thead>
                      <tbody>
                          @foreach($project as $key=>$data)
                        <tr>
                          <th scope="row">{{$loop->iteration}}</th>
                          <td><img src="{{asset($data->image) ?? ''}}" alt="person" class="img-fluid rounded-circle mCS_img_loaded" height="50px" width="50px"></td>
                          <td>{{$data->project_name ?? ''}}</td>
                          <!-- <td>{{$data->project_details ?? ''}}</td> -->
                          <td>{{$data->project_value ?? ''}}</td>
                          <td>{{$data->start_day ?? ''}}</td>
                          <td>{{$data->end_day ?? ''}}</td>
                          <td>{{$data->company_name ?? ''}}</td>
                          <td>{{$data->phone ?? ''}}</td>
                          <td>{{$data->email ?? ''}}</td>
                          <td>{{$data->address ?? ''}}</td>
                          <!-- <td>{{$data->joining_date ?? ''}}</td> -->
                          <td>
                              <table>
                                  <tr>
                                      <td><button class="btn btn-sm btn-primary edit" data-id="{{$data->id ?? ''}}" data-company_name="{{$data->company_name ?? ''}}" 
                                       data-project_name="{{$data->project_name ?? ''}}"
                                       data-project_details="{{$data->project_details ?? ''}}"
                                       data-project_value="{{$data->project_value ?? ''}}"
                                       data-start_day="{{$data->start_day ?? ''}}"
                                       data-end_day="{{$data->end_day ?? ''}}"
                                       data-phone="{{$data->phone ?? ''}}"
                                       data-email="{{$data->email ?? ''}}"
                                       data-address="{{$data->address ?? ''}}"
                                       ><i class="fa fa-edit"></i>Edit</button></td>
                                      <td><a class="btn btn-sm btn-danger delete" onclick="return confirm('do you want to delete')" href="{{route('project.delete',$data->id)}}"><i class="fa fa-trash"></i>Delete</a></td>
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
                          <th>Project Name</th>
                          <th> Project Value</th>
                          <th> Start Date</th>
                          <th> End Date</th>
                          <th> Company Nam</th>
                          <th> Phone</th>
                          <th> Email</th>
                          <th> Address</th>
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
                <form id="project-form" method="post" enctype="multipart/form-data">
                    @csrf
                    <input type="hidden" id="project_id" name="id" value="">
                    <div class="form-group">
                    <label>Project Name</label>
                    <input type="text" id="project_name" name="project_name" placeholder="project project name" class="form-control @error('project_name') is-invalid @enderror" required>
                    @error('project_name')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                        </div>
                        <div class="form-group">
                    <label> Project Description</label>
                    <input type="text" id="project_details" name="project_details" placeholder="project project name" class="form-control @error('project_details') is-invalid @enderror" required>
                    @error('project_details')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                </div>
                        <div class="form-group">
                            <label>Project Value</label>
                            <input type="text" id="project_value" name="project_value" placeholder="project project value" class="form-control @error('project_value') is-invalid @enderror" required>
                            @error('project_value')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label>Project Start Date</label>
                            <input type="date" id="start_day" name="start_day" placeholder="project start date" class="form-control @error('start_day') is-invalid @enderror" required>
                            @error('start_day')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label>Project End Date</label>
                            <input type="date" id="end_day" name="end_day" placeholder="project start date" class="form-control @error('end_day') is-invalid @enderror" required>
                            @error('end_day')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label>Company Name</label>
                            <input type="text" id="company_name" name="company_name" placeholder="project company name" class="form-control @error('company_name') is-invalid @enderror" required>
                            @error('company_name')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label>Company Phone</label>
                            <input type="text" id="phone" name="phone" placeholder="Company phone" class="form-control @error('phone') is-invalid @enderror" required>
                            @error('phone')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label>Company email</label>
                            <input type="text" id="email" name="email" placeholder="Company email" class="form-control @error('email') is-invalid @enderror" required>
                            @error('email')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label>Company address</label>
                            <input type="text" id="address" name="address" placeholder="Company address" class="form-control @error('address') is-invalid @enderror" required>
                            @error('address')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label>project Image</label>
                            <input type="file" id="image" name="image" placeholder="project image" class="form-control @error('image') is-invalid @enderror" >
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
    $(document).ready(function(){
        
        $('.project-create').click(function(e){
            $("#myModal").modal('show')
            $("#project-form").attr('action',"{{route('project.store')}}")
            $('.modal-title').html('Create project')
            FormResetData();
        })
        $('.edit').click(function(e){
            FormResetData();
            $("#myModal").modal('show')
            $("#project_id").val($(this).data('id'))
            $("#company_name").val($(this).data('company_name'))
            $("#phone").val($(this).data('phone'))
            $("#email").val($(this).data('email'))
            $("#address").val($(this).data('address'))
            $("#start_day").val($(this).data('start_day'))
            $("#end_day").val($(this).data('end_day'))
            $("#project_name").val($(this).data('project_name'))
            $("#project_details").val($(this).data('project_details'))
            $("#project_value").val($(this).data('project_value'))
            $('.modal-title').html('Update project')
            $("#project-form").attr('action',"{{route('project.update')}}")
        })
        function FormResetData(){
            $("#project_id").val('');
            $("#project_name").val('');
            $('#projectDegId').val('').prop('selected', false);
            $("#phone").val('')
            $("#email").val('')
            $("#address").val('')
            $("#project_value").val('')
            $("#project_details").val('')
            $("#company_name").val('')
            $("#start_day").val('')
            $("#end_day").val('')
        }
    })
</script>
@endsection