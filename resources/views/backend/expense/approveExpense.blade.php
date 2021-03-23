@extends('layouts.dashboard-layouts')
@section('content')
 <!-- Counts Section -->
 <div class="breadcrumb-holder">
        <div class="container-fluid">
          <ul class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{route('dashboard')}}">Home</a></li>
            <li class="breadcrumb-item active">Expanse</li>
            <!-- <li class=" offset-10"> <button class=" btn btn-sm btn-success expense-create">Home</button></li> -->
          </ul>
        </div>
      </div>
 <section class="dashboard-counts section-padding">
        <div class="container-fluid">
          <div class="row justify-content-center">
            <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                  <h4>Expanse Table</h4>
                 
                </div>
                <div class="card-body">
                  <div class="table-responsive">
                    <table class="table table-striped">
                      <thead>
                        <tr>
                          <th>SL</th>
                          <th> Image</th>
                          <th>Employee Name</th>
                          <th>Category</th>
                          <th>Sub Category</th>
                          <th>Total Expense</th>
                          <th>Date</th>
                          <th> Action</th>
                        </tr>
                      </thead>
                      <tbody>
                          @foreach($expense as $key=>$data)
                        <tr>
                          <th scope="row">{{$loop->iteration}}</th>
                          <td><img src="{{asset($data->Employee->image ?? '') }}" alt="person" class="img-fluid rounded-circle mCS_img_loaded" height="50px" width="50px"></td>
                          <td>{{$data->Employee->name ?? ''}}</td>
                          <td>{{$data->Category->name ?? ''}}</td>
                          <td>{{$data->SubCategory->name ?? ''}}</td>
                          <td>{{$data->total_expense ?? '0'}}</td>
                          <td>{{$data->date ?? ''}}</td>
                          <td>
                             <a href="{{route('print.expense',$data->id)}}" class="btn btn-sm btn-danger"><i class="fa fa-print"></i>  Print Invoice</a>
                          </td>
                        </tr>
                        @endforeach
                      </tbody>
                      <tfoot> 
                        <tr>
                            <th>SL</th>
                            <th> Image</th>
                            <th>Employee Name</th>
                            <th>Category</th>
                            <th>Sub Category</th>
                            <th>Total Expense</th>
                            <th>Date</th>
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
@endsection