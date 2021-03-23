@extends('layouts.dashboard-layouts')
@section('content')
 <!-- Counts Section -->
 <div class="breadcrumb-holder">
        <div class="container-fluid">
          <ul class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{route('dashboard')}}">Home</a></li>
            <li class="breadcrumb-item active">Expanse Details</li>
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
                  <h4 class="justify-content-center">Expnse Details Table</h4>
                <table class="table table-striped">
                      <thead>
                        <tr>
                          <th>Employee Name</th>
                          <td>{{$expense->Employee->name ?? ''}}</td>
                          <th>Total Expanse</th>
                          <td>{{$expense->total_expense ?? ''}}</td>
                        </tr>
                        <tr>
                          <th> Categorye</th>
                          <td>{{$expense->Category->name ?? ''}}</td>
                          <th>Expanse Date</th>
                          <td>{{$expense->date ?? ''}}</td>
                        </tr>
                        <tr>
                          <th> Sub Categorye</th>
                          <td>{{$expense->SubCategory->name ?? ''}}</td>
                        </tr>

                        <tr>
                          <th>Chairment Status</th>
                        <td>
                        @if($noteSheet->chairmen_status=='1')
                        <p class="text-success">Accepted</p>
                        @elseif($noteSheet->chairmen_status=='0')
                        <p class="text-danger">Rejected </p>
                         @else
                         <p class="text-info">Pendding</p> 
                        @endif</td> 
                         <th>Comments</th>
                          <td>{{$noteComments->where('admin_id',3)->first()->comments?? ''}}</td>
                        </tr>
                        <tr>
                          <th>Managing Director</th>
                          <td>
                          @if($noteSheet->managing_director_status=='1')
                        <p class="text-success">Accepted</p>
                        @elseif($noteSheet->managing_director_status=='0')
                        <p class="text-danger">Rejected </p>
                         @else
                         <p class="text-info">Pendding</p> 
                        @endif</td>
                         
                         <th>Comments</th>
                          <td>{{$noteComments->where('admin_id',5)->first()->comments?? ''}}</td>
                        </tr>
                        <tr>
                          <th>Director Finance Status</th>
                          <td>
                          @if($noteSheet->director_finance_status=='1')
                        <p class="text-success">Accepted</p>
                        @elseif($noteSheet->director_finance_status=='0')
                        <p class="text-danger">Rejected </p>
                         @else
                         <p class="text-info">Pendding</p> 
                        @endif
                        </td>
                          <th>Comments</th>
                          <td>{{$noteComments->where('admin_id',7)->first()->comments?? ''}}</td>
                        </tr>

                      </thead>
                    </table>
                </div>
                <div class="card-body">
                  <div class="table-responsive">
                    <table class="table table-striped">
                      <thead>
                        <tr>
                          <th>SL</th>
                          <th>Expense Description</th>
                          <th>Amount</th>
                        </tr>
                      </thead>
                      <tbody>
                          @foreach($expenseDetails as $key=>$data)
                        <tr>
                          <th scope="row">{{$loop->iteration}}</th>
                          <td>{{$data->expense ?? ''}}</td>
                          <td>{{$data->amount ?? ''}}</td>
                        </tr>
                        @endforeach
                      </tbody>
                      <tfoot> 
                        <tr>
                          <th></th>
                          <th>Total Amount</th>
                          <th>{{$expense->total_expense}}</th>
                        </tr>
                     </tfoot>
                    </table>
                  </div>
                  
                  @if(Auth::user()->role_id==3 && $noteSheet->managing_director_status==null && $noteSheet->managing_director_status!='0'  && $noteSheet->director_finance_status!=null)
                  <div class="row">
                    <div class="col-sm-6 col-md-2">
                      <button id="accept-btn" class="btn  btn-success">Accept</button>
                    </div>
                    <div class="col-sm-6 col-md-2">
                      <button id="reject-btn" class="btn  btn-danger">Reject</button>
                    </div>
                  </div>
                  @elseif(Auth::user()->role_id==4 && $noteSheet->director_finance_status==null && $noteSheet->director_finance_status!='0')
                  <div class="row">
                    <div class="col-sm-6 col-md-2">
                      <button id="accept-btn" class="btn  btn-success">Accept</button>
                    </div>
                    <div class="col-sm-6 col-md-2">
                      <button id="reject-btn" class="btn  btn-danger">Reject</button>
                    </div>
                  </div>
                  @elseif(Auth::user()->role_id==2 && $noteSheet->managing_director_status!=null  && $noteSheet->director_finance_status!=null && $noteSheet->chairmen_status==null)
                  <div class="row">
                    <div class="col-sm-6 col-md-2">
                      <button id="accept-btn" class="btn  btn-success">Accept</button>
                    </div>
                    <div class="col-sm-6 col-md-2">
                      <button id="reject-btn" class="btn  btn-danger">Reject</button>
                    </div>
                  </div> 
                 @endif
                 
                 <div class="d-none" id="cancel-form">
                    <h4>Reject comments</h4>
                    <form method="post" action="{{route('cancel.expense',$expense->id)}}" >
                        @csrf
                    <div class="form-group">
                        <label>Comments</label>
                        <input type="text" id="comments" name="comments" placeholder="comments" class="form-control">
                    </div>
                    <div class="form-group">       
                      <button class="btn btn-primary">Reject Confirm</button>
                      <button type="button" href="#" id="reject-cancel-btn" class="btn btn-danger">Cancel</button>
                    </div>
                    </form>
                </div>
                <div class="d-none" id="accept-form">
                  <h4>Accept comments</h4>
                  <form method="post" action="{{route('accept.expense',$expense->id)}}" >
                      @csrf
                      <input type="hidden" id="sub-category-id" name="id" value="">
                  <div class="form-group">
                      <label>Comments</label>
                      <input type="text" id="comments" name="comments" placeholder="comments" class="form-control">
                  </div>
                  <div class="form-group">       
                    <button class="btn btn-primary">Confirm</button>
                    <button type="button" id="cancel-btn" class="btn btn-danger">Cancel</button>
                  </div>
                </div>
               
            </div>
          </div>
        </div>
      </section>
@endsection
@section('js')

<script>
    $(document).ready(function(){
        $("#accept-btn").click(function(){
          $("#accept-form").removeClass('d-none');
          $("#accept-btn").addClass('d-none');
          $("#reject-btn").addClass('d-none');

        })
        $("#cancel-btn").click(function(){
          $("#accept-form").addClass('d-none');
          $("#accept-btn").removeClass('d-none');
          $("#reject-btn").removeClass('d-none');

        })
        $("#reject-btn").click(function(){
          console.log('paise');
          $("#cancel-form").removeClass('d-none');
          $("#accept-btn").addClass('d-none');
          $("#reject-btn").addClass('d-none');

        })
        $("#reject-cancel-btn").click(function(){
          $("#cancel-form").addClass('d-none');
          $("#accept-btn").removeClass('d-none');
          $("#reject-btn").removeClass('d-none');

        })
       
    })
</script>
@endsection