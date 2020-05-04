
@extends('layouts.master')
@section('title', 'Make Payment')
@section('content')
@include('partials._messages')
<style>
    .panel-title {
        display: inline;font-weight: bold;
    }
    .checkbox.pull-right { 
        margin: 0; 
    }
    .pl-ziro { 
        padding-left: 0px; 
    }
</style>

<header class="main-heading">
    <div class="container-fluid">
      <div class="row">
        <div class="col-xl-8 col-lg-8 col-md-8 col-sm-8">
          <div class="page-icon">
            <i class="icon-library"></i>
          </div>
          <div class="page-title">
            <h5>Dahboard</h5>
            <h6 class="sub-heading">Make payment for different fees</h6>
          </div>
        </div>
        <div class="col-xl-4 col-lg-4 col-md-4 col-sm-4">
        {{-- <div class="right-actions">
            <a href="{{ route('students.index') }}" class="btn btn-success float-right" data-toggle="tooltip" data-placement="left" title="Students list">
            <i class="icon-users"></i>
            </a>

        </div> --}}
        </div>
      </div>
    </div>
  </header>

<div class="main-content">
    <form method="POST" action="{{ route('payments.student_payment') }}">
    @csrf
        <div class="row gutters">
            <div class="col-xl-8 col-lg-8 col-md-8 col-sm-8">
                <div class="card">
                    <div class="card-header">Make Payment</div>
                    <div class="card-body">
                        <div class="form-group">
                            <label for="fee_type">Fee Type</label>
                            <select class="form-control" id="fee_type" name="fee_type">
                                <option>Choose</option>
                                @foreach ($feeTypes as $feeType)
                                    <option value="{{ $feeType->id }}">{{ $feeType->fee_type_name }}</option>                                
                                @endforeach
                            </select>
                        </div>

                        <div class="form-group">
                            <label for="fee_category">Fee Category</label>
                            <select class="form-control" id="fee_category" name="fee_category">
                                <option>Choose</option>
                            </select>
                        </div>

                        <div class="form-group">
                            <label for="selectTwo">Payment Gateway</label>
                            <select class="form-control" id="payment_gateway" name="payment_gateway">
                                <option>Choose</option>
                                @foreach ($paymentGateways as $paymentGateway)
                                    <option value="{{ $paymentGateway->id }}">{{ $paymentGateway->payment_gateway_name }}</option>                                
                                @endforeach
                            </select>
                        </div>

                    </div>
                </div>
            </div>
            <div class="col-xl-4 col-lg-4 col-md-4 col-sm-4 d-none" id="fee_interface">
                <div class="card">
                    <div class="card-header"><span id="fee_name">Sample</span> Fee</div>
                    <div class="card-body">
                        ₦<span id="fee_amount">35,000</span>
                    </div>
                </div>

                <div class="card d-none" id="payment_details">
                    <div class="card-body">
                        <div class="panel panel-default">
                            <div class="panel-heading">
                                <h3 class="panel-title">Payment Details</h3>
                                <small class="text-danger">*Card details will not be saved</small>
                            </div><hr>
                            <div class="panel-body">
                                <form role="form">
                                <div class="form-group">
                                    <label for="cardNumber">CARD NUMBER</label>
                                    <div class="input-group">
                                        <input type="tel" class="form-control" id="card_number" name="card_number" placeholder="Valid Card Number" maxlength="16" required autofocus />
                                        <span class="input-group-addon"><span class="icon-lock"></span></span>
                                    </div>
                                </div>
                                <div class="row gutters">
                                    <div class="form-group col-xl-6 col-lg-6 col-md-6 col-sm-12">
                                        <label for="expiry_month">EXPIRY DATE</label>
                                        <div class="row gutters">
                                            <div class="col-md-6 col-xs-3">
                                                <input type="tel" class="form-control" id="expiry_month" name="expiry_month" placeholder="MM" maxlength="2" required>
                                            </div>
                                            <div class="col-md-6 col-xs-3">
                                                <input type="tel" class="form-control" id="expiry_year" name="expiry_year" placeholder="YY" maxlength="2" required>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-5 col-5 pull-right">
                                        <div class="form-group">
                                            <label for="cvCode">
                                                CCV CODE</label>
                                            <input type="tel" class="form-control" id="ccv_code" name="ccv_code" placeholder="CCV" maxlength="3" required />
                                        </div>
                                    </div>
                                </div>
                                </form>
                            </div>
                        </div>
                        <ul class="list-group">
                            <li class=" list-group-item active">
                            Final Payment
                            <span class="badge badge-primary badge-pill float-right">₦<span id="final_amount" >35,000</span></span>
                            <input type="hidden" id="amount_paid" name="amount_paid">
                            </li>                       
                        </ul>
                        <br/>
                        <button class="btn btn-success btn-lg btn-block" type="submit">Make Payment</button>
                    </div>
                    </div>
                </div>
            </div>
        </div>
    </form>
</div>

<script>
    $('#fee_type').on('change',function () {
        let fee_type = $('#fee_type').find('option:selected').val();

        $('#fee_interface').addClass('d-none');
        $('#payment_details').addClass('d-none');

        $.ajaxSetup({
            headers: {
                'X-CSRF_TOKEN':$('meta[name="csrf-token"]').attr('content')
            }
        });

        $.ajax({
            url: "{{ route('students.fee_category') }}",
            method: "GET",
            dataType: "JSON",
            data: {fee_type:fee_type},
            success: function(data){
                if(data){
                    $('#fee_category').html(data.feeCategoryRenderer);
                }
            },
        })
    });

    $('#fee_category').on('change',function () {
        let fee_category = $('#fee_category').find('option:selected').val();
        // console.log(state);
        $.ajaxSetup({
            headers: {
                'X-CSRF_TOKEN':$('meta[name="csrf-token"]').attr('content')
            }
        });

        $.ajax({
            url: "{{ route('students.fee_category_amount') }}",
            method: "GET",
            dataType: "JSON",
            data: {fee_category:fee_category},
            success: function(data){
                console.log(data);
                if(data){

                    $('#fee_interface').removeClass('d-none').addClass('fadeIn');
                    $('#fee_name').html(data.fee_name);
                    $('#fee_amount, #final_amount').html(data.amount);
                    $('#amount_paid').val(data.amount);
                }
            },
        })
    });

    $('#payment_gateway').on('change',function () {
        $('#payment_details').removeClass('d-none').addClass('fadeIn');
    });

</script>
@endsection