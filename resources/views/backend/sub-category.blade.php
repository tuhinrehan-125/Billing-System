@extends('layouts.dashboard-layouts')
@section('content')
 <!-- Counts Section -->
 <div class="breadcrumb-holder">
        <div class="container-fluid">
          <ul class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{route('dashboard')}}">Home</a></li>
            <li class="breadcrumb-item active">Sub Category</li>
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
                  <h4>Sub Category Table</h4>
                 
                </div>
                <div class="card-body">
                  <div class="table-responsive">
                    <table class="table table-striped">
                      <thead>
                        <tr>
                          <th>SL</th>
                          <th> Name</th>
                          <th>Category Name</th>
                          <th> Description</th>
                          <th> Action</th>
                        </tr>
                      </thead>
                      <tbody>
                          @foreach($SubCategory as $key=>$categ)
                        <tr>
                          <th scope="row">{{$loop->iteration}}</th>
                          <td>{{$categ->name ?? ''}}</td>
                          <td>{{$categ->Category->name ?? ''}}</td>
                          <td>{{$categ->description ?? ''}}</td>
                          <td>
                              <table>
                                  <tr>
                                      <td><button class="btn btn-sm btn-primary edit" data-id="{{$categ->id ?? ''}}" data-name="{{$categ->name ?? ''}}" data-description="{{$categ->description ?? ''}}" data-catg_id="{{$categ->category_id ?? ''}}"><i class="fa fa-edit"></i>Edit</button></td>
                                      <td><a class="btn btn-sm btn-danger delete" onclick="return confirm('do you want to delete')" href="{{route('subcategory.delete',$categ->id)}}"><i class="fa fa-trash"></i>Delete</a></td>
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
                          <th>Category Name</th>
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
                    <input type="hidden" id="sub-category-id" name="id" value="">
                <div class="form-group">
                    <label> Category Name</label>
                    <select name="category_id" id="categoryId" class="categoryId form-control ">
                        <option value="">Select</option>
                        @foreach($category as $data)
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
                    <label>Sub Category Name</label>
                    <input type="text" id="name" name="name" placeholder="Sub Category Name" class="form-control @error('name') is-invalid @enderror">
                    @error('name')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                </div>
                <div class="form-group">
                    <label>Sub Category Description</label>
                    <input type="text" id="description" name="description" placeholder="Sub Category description" class="form-control @error('description') is-invalid @enderror">
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
            $("#category-form").attr('action',"{{route('subcategory.store')}}")
            $('.modal-title').html('Create Sub Category')
            FormResetData();
        })
        $('.edit').click(function(e){
            FormResetData();
            $("#myModal").modal('show')
            $("#sub-category-id").val($(this).data('id'))
            $("#name").val($(this).data('name'))
            $("#description").val($(this).data('description'))
            var catego=$(this).data('catg_id')
           
            $('#categoryId').val(catego).prop('selected', true);
            // $('.categoryId').each(function() {
            //   console.log($(this).val())
            //         if($(this).val() == $(this).data('catg_id')) {
            //             $(this).attr('selected', 'selected').prop('selected', true);
            //         }
            //     });
            $('.modal-title').html('Update Sub Category')
            $("#category-form").attr('action',"{{route('subcategory.update')}}")
        })
        function FormResetData(){
            $("#sub-category-id").val('');
            $("#name").val('');
            $("#description").val('');
            $('#categoryId').val('').prop('selected', true);
        }
    })
</script>
@endsection