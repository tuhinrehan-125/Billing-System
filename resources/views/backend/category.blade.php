@extends('layouts.dashboard-layouts')
@section('content')
 <!-- Counts Section -->
 <div class="breadcrumb-holder">
        <div class="container-fluid">
          <ul class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{route('dashboard')}}">Home</a></li>
            <li class="breadcrumb-item active">Category</li>
            <li class=" offset-10"> <button class=" btn btn-sm btn-success create-category">Create</button></li>
          </ul>
        </div>
      </div>
 <section class="dashboard-counts section-padding">
        <div class="container-fluid">
          <div class="row justify-content-center">
            <div class="col-md-10">
            <div class="card">
                <div class="card-header">
                  <h4>Category Table</h4>
                 
                </div>
                <div class="card-body">
                  <div class="table-responsive">
                    <table class="table table-striped">
                      <thead>
                        <tr>
                          <th>SL</th>
                          <th> Name</th>
                          <th> Description</th>
                          <th> Action</th>
                        </tr>
                      </thead>
                      <tbody>
                          @foreach($category as $key=>$categ)
                        <tr>
                          <th scope="row">{{$loop->iteration}}</th>
                          <td>{{$categ->name ?? ''}}</td>
                          <td>{{$categ->description ?? ''}}</td>
                          <td>
                              <table>
                                  <tr>
                                      <td><button class="btn btn-sm btn-primary edit" data-id="{{$categ->id ?? ''}}" data-name="{{$categ->name ?? ''}}" data-description="{{$categ->description ?? ''}}"><i class="fa fa-edit"></i>Edit</button></td>
                                      <td><a class="btn btn-sm btn-danger delete" onclick="return confirm('do you want to delete')" href="{{route('category.delete',$categ->id)}}"><i class="fa fa-trash"></i>Delete</a></td>
                                  </tr>
                              </table>
                          </td>
                        </tr>
                        @endforeach
                      </tbody>
                      <tfoot> 
                        <tr>
                            <th>SL</th>
                            <th> Name</th>
                            <th> Description</th>
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
        <div role="document" class="modal-dialog">
            <div class="modal-content">
            <div class="modal-header">
                <h5 id="exampleModalLabel" class="modal-title"></h5>
                <button type="button" data-dismiss="modal" aria-label="Close" class="close"><span aria-hidden="true">×</span></button>
            </div>
            <div class="modal-body">
                <!-- <p>Lorem ipsum dolor sit amet consectetur.</p> -->
                <form id="category-form" method="post">
                    @csrf
                    <input type="hidden" id="category-id" name="id" value="">
                <div class="form-group">
                    <label>Category Name</label>
                    <input type="text" id="name" name="name" placeholder="Category Name" class="form-control @error('name') is-invalid @enderror">
                    @error('name')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                </div>
                <div class="form-group">
                    <label>Category Description</label>
                    <input type="text" id="description" name="description" placeholder="Category description" class="form-control @error('description') is-invalid @enderror">
                    @error('description')
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
        
        $('.create-category').click(function(e){
            $("#myModal").modal('show')
            $("#category-form").attr('action',"{{route('category.store')}}")
            $('.modal-title').html('Create Category');
            FormResetData();
        })
        $('.edit').click(function(e){
            FormResetData();
            $("#myModal").modal('show')
            $("#category-id").val($(this).data('id'))
            $("#name").val($(this).data('name'))
            $("#description").val($(this).data('description'))
            $('.modal-title').html('Update Category')
            
            $("#category-form").attr('action',"{{route('category.update')}}")
        })
        function FormResetData(){
            $("#sub-category-id").val('');
            $("#name").val('');
            $("#description").val('');
        }
    })
</script>
@endsection