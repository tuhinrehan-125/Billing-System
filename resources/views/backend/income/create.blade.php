@extends('layouts.dashboard-layouts')
@section('content')
<!-- Counts Section -->
<div class="breadcrumb-holder">
    <div class="container-fluid">
        <ul class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{route('dashboard')}}">Home</a></li>
            <li class="breadcrumb-item active">Income</li>
            <li class=" offset-10"> <button class=" btn btn-sm btn-success create-category">Create</button></li>
        </ul>
    </div>
</div>
<!-- Only director admin can create noteSheet -->
@if(Auth::user()->role_id==5)
<section class="dashboard-counts section-padding">
    <div class="container-fluid">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <h4>Income Create Form</h4>
                    </div>
                    <div class="card-body">
                        <form id="income-form" action="{{route('income.store')}}" method="post">
                            @csrf
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Project </label>
                                        <select name="project_id" id="projectID" class="projectID form-control ">
                                            <option value="">Select</option>
                                            @foreach($project as $data)
                                            <option value="{{ $data->id ?? ''}}">{{$data->project_name ?? ''}}</option>
                                            @endforeach
                                        </select>
                                        @error('name')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Employee </label>
                                        <select name="employee_id" id="employeId" class="employeId form-control ">
                                            <option value="">Select</option>
                                            @foreach($employee as $data)
                                            <option value="{{ $data->id ?? ''}}">{{$data->name ?? ''}}</option>
                                            @endforeach
                                        </select>
                                        @error('name')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Total Working Day</label>
                                        <input type="text" id="total" name="working_day" placeholder="Total Working Day" class="form-control @error('working_day') is-invalid @enderror">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Amount</label>
                                        <input type="text" id="total_amount" name="total_amount" placeholder="total_amount Working Day" class="form-control @error('total_amount') is-invalid @enderror" readonly>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Paid </label>
                                        <input type="text" id="paid" name="paid" placeholder="Paid" class="form-control @error('paid') is-invalid @enderror">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Due </label>
                                        <input type="text" id="due" name="due" placeholder="due" class="form-control @error('due') is-invalid @enderror" readonly>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Comments </label>
                                        <input type="text" id="description" name="comments" placeholder="due" class="form-control @error('comments') is-invalid @enderror">
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <button class="btn btn-primary">Create</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endif
@endsection
@section('js')
<script>
    $(document).ready(function() {
        $("#projectID").on('change', function(e) {
            e.preventDefault();
            var id = $(this).val();
            if (id) {
                $.ajax({
                    url: 'income-project/' + id,
                    metho: "get",
                    success: function(data) {
                        if (data) {
                            $("#total_amount").val(data.project_value)
                            $("#due").val(data.project_value)
                        }
                    }
                })
            } else {
                $("#total_amount").val(0)
                $("#due").val(0)
            }
        })

        function totalAmount() {
            var t = 0;
            $('.amount').each(function(i, e) {
                var amt = $(this).val() - 0;
                t += amt;
            });
            $("#total_amount").val(t)
        }

        var i = 1;
        $(".add-new-field").click(function(e) {
            e.preventDefault();
            var new_item = `
                        <div class="row">
                        <div class="col-md-5 col-md-5">
                                    <div class="form-group">
                                    <input type="text"  name="income[]" placeholder="income Name" class="income form-control ">
                                    
                                </div>
                            </div>
                            <div class="col-md-5 col-md-5">
                                    <div class="form-group">
                                    <input type="text"  name="amount[]" placeholder="income amount" class="amount form-control ">
                                    
                                </div>
                            </div>
                            <div class="col-md-1 col-md-1 ">
                                    <a href="#" class="btn btn-sm btn-danger remove-field text-light" style="margin-top:0px"><i class="fa fa-trash"></i></a>
                            </div>
                        </div>
                        `;
            $('.new-item-add').append(new_item);
        })
        $('.new-item-add').delegate('.remove-field', 'click', function() {
            $(this).parent().parent().remove();
            totalAmount();
        });
        $('.new-item-add').delegate('.amount ', 'keyup', function() {
            var t = 0;
            $('.amount').each(function(i, e) {
                var amt = $(this).val() - 0;
                t += amt;
            });
            $("#total_amount").val(t)
            var total = $("#due").val(t);
            $("#paid").attr('readonly', false);
        })
        $("#paid").keyup(function(e) {
            var total = $("#total_amount").val();
            var paid = $("#paid").val();
            // if(total==paid){
            //     $("#paid").attr('readonly',true);
            //     $("#paid").attr('max',total);
            //     // $("#paid").val('0');
            // }
            // else{
            //     $("#paid").attr('readonly',false);
            // }
            var due = total - paid;
            $("#due").val(due);
        })

    })
</script>
@endsection