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
                        <h4>Payment By Cash</h4>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-striped">
                                <thead>
                                    <tr>
                                        <th>Serial</th>
                                        <th>Employee Id</th>
                                        <th>Employee Name</th>
                                        <th>Amount</th>
                                        <th>Paid</th>
                                        <th>Due</th>
                                        <th>Status</th>
                                        <th>Delete_Status</th>

                                        <th>Payments</th>

                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($expense as $key=>$data)
                                    <tr>
                                        <th scope="row">{{$loop->iteration}}</th>
                                        <td>{{$data->Employee->id ?? ''}}</td>
                                        <td>{{$data->Employee->name ?? ''}}</td>
                                        <td>{{$data->total_expense ?? '0'}}</td>
                                        <td>{{$data->paid ?? '0'}}</td>
                                        <!-- <td>{{$data->due ?? '0'}}</td> -->
                                        <td> {{$data->total_expense - $data->paid}} </td>
                                        <td>{{$data->status ?? ''}}</td>
                                        <td>{{$data->delete_status ?? ''}}</td>
                                        @if( $data->total_expense != $data->paid && Auth::user()->role_id==5 )
                                        <td>

                                            <button action="{{route('payment.edit',$data->id)}}" class="btn btn-sm btn-warning payment" data-id="{{$data->id ?? ''}}"><i class="fa fa-edit"></i>Pay Now</button>
                                        </td>

                                        @else
                                        <td><button class="btn btn-sm btn-success btn-block "><i class="fa "></i>Paid</button></td>
                                        @endif

                                    </tr>
                                    @endforeach
                                </tbody>
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

                <!-- action = route('paymentCash.store') -->
                <form id="payment-form" method="post" enctype="multipart/form-data">
                    @csrf
                    <input type="hidden" id="expense_id" name="id" value="">

                    <h1 style="text-align: center; color:blueviolet;">CASH:</h1>
                    <div class="form-group">
                        <label>Amount</label>
                        <input type="number" id="amount" name="amount" placeholder="Put the amount you want to pay" class="form-control @error('amount') is-invalid @enderror">
                    </div>
                    <div class="form-group">
                        <label>Payment Date</label>
                        <input type="date" id="payment_date" name="payment_date" placeholder="Payment date" class="form-control @error('payment_date') is-invalid @enderror">
                        @error('payment_date')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>
                    <div class="form-group">
                        <button class="btn btn-primary">Submit</button>
                    </div>

                    <h1 style="margin-top: 75px; text-align: center; color:blueviolet;">BANK:</h1>
                    <div class="form-group">
                        <label>Bank Name </label>
                        <select name="bank_id" id="bankID" class="bankID form-control ">
                            <option value="">Select</option>
                            @foreach($bank as $data)
                            <!-- <option value="{{ $data->id ?? ''}}">{{$data->bank_name ?? ''}}</option> -->
                            <option value="{{ $data->id ?? ''}}">{{$data->bank_name ?? ''}}</option>
                            @endforeach
                        </select>
                        @error('name')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label>Branch Name </label>
                        <select name="branch_id" id="branchID" class="branchID form-control ">
                            <option value="">Select</option>
                            @foreach($branch as $data)
                            <option value="{{ $data->id ?? ''}}">{{$data->branch_name ?? ''}}</option>
                            @endforeach
                        </select>
                        @error('name')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label>Amount</label>
                        <input type="number" id="name" name="amounts" placeholder="Put the amount you want to pay" class="form-control @error('amount') is-invalid @enderror">
                    </div>
                    <div class="form-group">
                        <label>Account No.</label>
                        <input type="text" id="name" name="account_no" placeholder="Put your account no" class="form-control @error('acc_no') is-invalid @enderror">
                    </div>

                    <div class="form-group">
                        <button class="btn btn-primary">Submit</button>
                    </div>
                </form>

                <!-- <form id="payment-form-2" method="post" enctype="multipart/form-data">
                    @csrf

                    <h1 style="margin-top: 75px; text-align: center; color:blueviolet;">BANK:</h1>
                    <div class="form-group">
                        <label>Bank Name </label>
                        <select name="bank_id" id="bankID" class="bankID form-control ">
                            <option value="">Select</option>
                            @foreach($bank as $data)
                            <option value="{{ $data->id ?? ''}}">{{$data->bank_name ?? ''}}</option>
                            <option value="{{ $data->id ?? ''}}">{{$data->bank_name ?? ''}}</option>
                            @endforeach
                        </select>
                        @error('name')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label>Branch Name </label>
                        <select name="branch_id" id="branchID" class="branchID form-control ">
                            <option value="">Select</option>
                            @foreach($branch as $data)
                            <option value="{{ $data->id ?? ''}}">{{$data->branch_name ?? ''}}</option>
                            @endforeach
                        </select>
                        @error('name')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label>Amount</label>
                        <input type="number" id="name" name="amounts" placeholder="Put the amount you want to pay" class="form-control @error('amount') is-invalid @enderror">
                    </div>
                    <div class="form-group">
                        <label>Account No.</label>
                        <input type="text" id="name" name="account_no" placeholder="Put your account no" class="form-control @error('acc_no') is-invalid @enderror">
                    </div>

                    <div class="form-group">
                        <button class="btn btn-primary">Submit</button>
                    </div>
                </form> -->
            </div>
            <div class="modal-footer">
                <button type="button" data-dismiss="modal" class="btn btn-secondary">Close</button>
            </div>
        </div>
    </div>
</div>

@endsection


@section('js')
<script>
    $(document).ready(function() {

        $('.payment').click(function(e) {
            $("#myModal").modal('show')
            $("#expense_id").val($(this).data('id'))
            $("#payment-form").attr('action', "{{route('paymentCash.store')}}")

            $('.modal-title').html('Payment By Cash')
            //FormResetData();
        })
        // $('.payment').click(function(e) {
        //     FormResetData();
        //     $("#myModal").modal('show')
        //     // $("#employee_id").val($(this).data('id'))
        //     // $("#name").val($(this).data('name'))
        //     // $("#phone").val($(this).data('phone'))
        //     // $("#email").val($(this).data('email'))
        //     // $("#address").val($(this).data('address'))
        //     // $("#joining_date").val($(this).data('joining_date'))
        //     // var desig = $(this).data('designation')
        //     // $('#employeeDegId').val(desig).prop('selected', true);
        //     // $('.modal-title').html('Payment By Cash/Bank')
        //     // $("#employee-form").attr('action', "{{route('employee.update')}}")
        // })

        function FormResetData() {
            // $("#employee_id").val('');
            // $("#name").val('');
            // $("#description").val('');
            // $('#employeeDegId').val('').prop('selected', false);

            // $("#joining_date").val('')
        }
    })
</script>
@endsection