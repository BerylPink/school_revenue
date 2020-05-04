@extends('layouts.master')
@section('title', 'Staff Payment')
@section('content')
@include('partials._messages')

<header class="main-heading">
    <div class="container-fluid">
      <div class="row">
        <div class="col-xl-8 col-lg-8 col-md-8 col-sm-8">
          <div class="page-icon">
            <i class="icon-library"></i>
          </div>
          <div class="page-title">
            <h5>Staff Payment</h5>
            <h6 class="sub-heading">Make payment for a particular Staff</h6>
          </div>
        </div>
        <div class="col-xl-4 col-lg-4 col-md-4 col-sm-4">
            <div class="right-actions">
            <a href="{{ route('payments.index') }}" class="btn btn-success float-right" data-toggle="tooltip" data-placement="left" title="Payments list">
                <i class="icon-credit-card"></i>
              </a>
            </div>
          </div>
      </div>
    </div>
  </header>
  <!-- END: .main-heading -->

  <div class="main-content">
  <!-- Row start -->
  <div class="main-content">
    <form method="POST" action="{{ route('payments.store') }}" id="make-payment">
    @csrf
        <div class="row gutters">
            <div class="col-xl-8 col-lg-8 col-md-8 col-sm-8">
                <div class="card">
                    <div class="card-header">Make Staff Payment</div>
                    <div class="card-body">
                        <div class="form-group">
                            <label for="staff_category">Staff Category</label>
                            <select class="form-control" id="staff_category" name="staff_category">
                                <option>Choose</option>
                                <option value="Academic">Academic Staff</option>                                
                                <option value="NonAcademic">Non-Academic Staff</option>                                
                            </select>
                        </div>

                        <div class="form-group d-none" id="employee_name_one">
                            <label for="academic_staff_id">Academic Staff Name</label>
                            <select class="form-control employee_number" id="academic_staff_id" name="academic_staff_id">
                                <option value="">Choose</option>
                                @foreach ($academicStaffs as $academicStaff)
                                <option value="{{ $academicStaff->id }}">{{ $academicStaff->firstname.' '.$academicStaff->lastname }} ({{ $academicStaff->employee_number }})</option> 
                                @endforeach
                            </select>
                        </div>

                        <div class="form-group d-none" id="employee_name_two">
                            <label for="non_academic_staff_id">Non-Academic Staff Name</label>
                            <select class="form-control employee_number_2" id="non_academic_staff_id" name="non_academic_staff_id">
                                <option value="">Choose</option>
                                @foreach ($nonAcademicStaffs as $nonAcademicStaff)
                                <option value="{{ $nonAcademicStaff->id }}">{{ $nonAcademicStaff->firstname.' '.$nonAcademicStaff->lastname }} ({{ $nonAcademicStaff->employee_number }})</option> 
                                @endforeach
                            </select>
                        </div>

                        <div class="d-none" id="payment_options">
                            <div class="form-group">
                                <label for="payment_category">Payment Category</label>
                                <select class="form-control" id="payment_category" name="payment_category">
                                    <option>Choose</option>
                                    @foreach ($paymentCategories as $paymentCategory)
                                <option value="{{ $paymentCategory->id }}" title="{{ $paymentCategory->payment_category_description }}">{{ $paymentCategory->payment_category_name }}</option>                                
                                    @endforeach
                                </select>
                            </div>

                            <div class="form-group">
                                <label for="payment_gateway">Payment Gateway</label>
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
            </div>
            <div class="col-xl-4 col-lg-4 col-md-4 col-sm-4 d-none" id="payment_details">
                <div class="card">
                    <div class="card-body">
                        <div class="panel panel-default">
                            <div class="panel-heading">
                                <h3 class="panel-title">Payment Details</h3>
                                <small class="text-danger">*Card details will not be saved</small>
                            </div><hr>
                            <div class="panel-body">
                                <div class="form-group">
                                    <label for="amount">Amount</label>
                                    <div class="input-group">
                                        <input type="tel" class="form-control" id="amount" name="amount" placeholder="Amount" maxlength="8" autocomplete="off" required autofocus />
                                        <span class="input-group-addon"><span class="icon-dial-pad"></span></span>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label for="cardNumber">Card Number</label>
                                    <div class="input-group">
                                        <input type="tel" class="form-control" id="card_number" name="card_number" placeholder="Valid Card Number" maxlength="16" autocomplete="off" required autofocus />
                                        <span class="input-group-addon"><span class="icon-lock"></span></span>
                                    </div>
                                </div>
                                <div class="row gutters">
                                    <div class="form-group col-xl-6 col-lg-6 col-md-6 col-sm-12">
                                        <label for="expiry_month">Expiry Date</label>
                                        <div class="row gutters">
                                            <div class="col-md-6 col-xs-3">
                                                <input type="tel" class="form-control" id="expiry_month" name="expiry_month" placeholder="MM" autocomplete="off" maxlength="2" required>
                                            </div>
                                            <div class="col-md-6 col-xs-3">
                                                <input type="tel" class="form-control" id="expiry_year" name="expiry_year" placeholder="YY" autocomplete="off" maxlength="2" required>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-5 col-5 pull-right">
                                        <div class="form-group">
                                            <label for="cvCode">
                                                CCV Code</label>
                                            <input type="tel" class="form-control" id="ccv_code" name="ccv_code" placeholder="CCV" maxlength="3" autocomplete="off" required />
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <ul class="list-group">
                            <li class=" list-group-item active">
                            Final Payment
                            <span class="badge badge-primary badge-pill float-right">₦<span id="final_amount"></span></span>
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
  <!-- Row end -->
  </div>

  <script>
    $('#staff_category').on('change',function () {

        let staff_category = $('#staff_category').find('option:selected').val();
        $('#payment_details').addClass('d-none');

        if(staff_category === 'Academic'){
            $('#employee_name_one').removeClass('d-none');
            $('#employee_name_two').addClass('d-none');

        }else if(staff_category === 'NonAcademic'){
            $('#employee_name_two').removeClass('d-none');
            $('#employee_name_one').addClass('d-none');
        
        }else{
            $('#payment_options').addClass('d-none');
            $('#employee_name_one').addClass('d-none');
            $('#employee_name_two').addClass('d-none');
            $('#make-payment').trigger('reset');
        }

    });

    $('.employee_number').on('change', function () {
        let employee_number = $('.employee_number').find('option:selected').val();

        if(employee_number === ''){
            $('#payment_options').addClass('d-none');
        }else{
            $('#payment_options').removeClass('d-none');
        }
    });

    $('.employee_number_2').on('change', function () {
        let employee_number = $('.employee_number_2').find('option:selected').val();

        if(employee_number === ''){
            $('#payment_options').addClass('d-none');
        }else{
            $('#payment_options').removeClass('d-none');
        }
    });

  
    $('#payment_gateway').on('change',function () {
        $('#payment_details').removeClass('d-none');
    });

    $(document).on('keyup', '#amount', function() {
        $('#final_amount').text(thousands_separators($('#amount').val()));
    });

    function thousands_separators(num)
    {
        var num_parts = num.toString().split(".");
        num_parts[0] = num_parts[0].replace(/\B(?=(\d{3})+(?!\d))/g, ",");
        return num_parts.join(".");
    }
</script>

@endsection