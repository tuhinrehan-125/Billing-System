@extends('layouts.dashboard-layouts')
@section('content')
 <!-- Counts Section -->
 <div class="breadcrumb-holder">
        <div class="container-fluid">
          <ul class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{route('dashboard')}}">Home</a></li>
            <li class="breadcrumb-item active">Income</li>
            <li class=" offset-10"> <button class=" btn btn-sm btn-success income-create">Create</button></li>
          </ul>
        </div>
      </div>
 <section class="dashboard-counts section-padding">
        <div class="container-fluid">
          <div class="row justify-content-center">
            <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                  <h4>Income Table</h4>
                 
                </div>
                <div class="card-body">
                  <div class="table-responsive">
                    <table class="table table-striped">
                      <thead>
                      <tr>
                          <th>SL</th>
                          <th>Project Name</th>
                          <th>Employee Name</th>
                          <th>Amount</th>
                          <th>Working Days</th>
                          <th>Paid</th>
                          <th>Due</th>
                          <th>Date</th>
                          <th> Action</th>
                        </tr>
                      </thead>
                      <tbody>
                          @foreach($income as $key=>$data)
                        <tr>
                          <th scope="row">{{$loop->iteration}}</th>
                         <td>{{$data->Project->project_name ?? ''}}</td>
                         <td>{{$data->Employee->name ?? ''}}</td>
                          <td>{{$data->total_amount ?? '0'}}</td>
                          <td>{{$data->working_day ?? '0'}}</td>
                          <td>{{$data->paid ?? '0'}}</td>
                          <td>{{$data->due ?? '0'}}</td>
                          <td>{{$data->date ?? ''}}</td>
                          <td>
                              <table>
                                  <tr>
                                      <td><a href="{{route('income.edit',$data->id)}}" class="btn btn-sm btn-primary edit" data-id="{{$data->id ?? ''}}"
                                       ><i class="fa fa-edit"></i>Edit</a></td>
                                      <td><a class="btn btn-sm btn-danger delete" onclick="return confirm('do you want to delete')" href="{{route('income.delete',$data->id)}}"><i class="fa fa-trash"></i>Delete</a></td>
                                  </tr>
                              </table>
                          </td>
                        </tr>
                        @endforeach
                      </tbody>
                      <tfoot> 
                      <tr>
                          <th>SL</th>
                          <th>Project Name</th>
                          <th>Employee Name</th>
                          <th>Amount</th>
                          <th>Working Days</th>
                          <th>Paid</th>
                          <th>Due</th>
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