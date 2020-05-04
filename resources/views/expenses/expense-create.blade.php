@extends('layouts.master')
@section('title', 'Add Expenses')
@section('content')
@include('partials._messages')
<!-- BEGIN .main-heading -->
  <header class="main-heading">
    <div class="container-fluid">
      <div class="row">
        <div class="col-xl-8 col-lg-8 col-md-8 col-sm-8">
          <div class="page-icon">
            <i class="icon-library"></i>
          </div>
          <div class="page-title">
            <h5>Add Expenses</h5>
            <h6 class="sub-heading">Create a new Expenses</h6>
          </div>
        </div>
        <div class="col-xl-4 col-lg-4 col-md-4 col-sm-4">
            <div class="right-actions">
            <a href="{{ route('expenses.index') }}" class="btn btn-success float-right" data-toggle="tooltip" data-placement="left" title="Expenses list">
                <i class="icon-calculator"></i>
              </a>
            </div>
          </div>
      </div>
    </div>
  </header>
  <!-- END: .main-heading -->

  <div class="main-content">
    <div class="row gutters">
      <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6">
        <div class="card">
          <div class="card-body">
            <div class="stats-widget">
              <div class="stats-widget-header">
                <i class="icon-note_add"></i>
              </div>
              <div class="stats-widget-body">
                <!-- Row start -->
                <ul class="row no-gutters">
                  <li class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col">
                    <h6 class="title">Current Expenses</h6>
                  </li>
                  <li class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col">
                  <h4 class="total">&#8358;{{ number_format($expenses) }}</h4>
                  </li>
                </ul>
              </div>
            </div>
          </div>
        </div>
      </div>
      <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6">
        <div class="card">
          <div class="card-body">
            <div class="stats-widget">
              <div class="stats-widget-header">
                <i class="icon-note_add"></i>
              </div>
              <div class="stats-widget-body">
                <!-- Row start -->
                <ul class="row no-gutters">
                  <li class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col">
                    <h6 class="title">Expenses Balance</h6>
                  </li>
                  <li class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col">
                  <h4 class="total">&#8358;{{ number_format($balance) }}</h4>
                  </li>
                </ul>
              </div>
            </div>
          </div>
        </div>
      </div>
      <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6">
        <div class="card">
          <div class="card-body">
            <div class="stats-widget">
              <div class="stats-widget-header">
                <i class="icon-clipboard"></i>
              </div>
              <div class="stats-widget-body">
                <!-- Row start -->
                <ul class="row no-gutters">
                  <li class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col">
                    <h6 class="title">Expenses Budget</h6>
                  </li>
                  <li class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col">
                    <h4 class="total">&#8358;{{ number_format($finances->expenses_budget) }}</h4>
                  </li>
                </ul>
              </div>
            </div>
          </div>
        </div>
      </div>

      <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6">
        <div class="card">
          <div class="card-body">
            <div class="stats-widget">
              <div class="stats-widget-header">
                <i class="icon-calculator"></i>
              </div>
              <div class="stats-widget-body">
                <!-- Row start -->
                <ul class="row no-gutters">
                  <li class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col">
                    <h6 class="title">School Fund</h6>
                  </li>
                  <li class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col">
                    <h4 class="total">&#8358;{{ number_format($finances->school_fund) }}</h4>
                  </li>
                </ul>
              </div>
            </div>
          </div>
        </div>
      </div>
      
    </div>
  <!-- Row start -->
<div class="row gutters">
  <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12">
    <div class="card">
      <div class="card-header">Create Expense</div>
      <div class="card-body">
        <form method="POST" action="{{ route('expenses.store') }}">
          @csrf
        <div class="form-group row gutters">
          <label for="expense_name" class="col-sm-3 col-form-label">Name</label>
          <div class="col-sm-9">
            <input type="text" class="form-control" id="expense_name" placeholder="" class="form-control @error('expense_name') is-invalid @enderror" name="expense_name" value="{{ old('expense_name') }}" required autocomplete="expense_name" autofocus>
            @error('expense_name')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
          </div>
        </div>

        <div class="form-group row gutters">                        
          <label for="expense_categories_id" class="col-sm-3 col-form-label">Expense Category</label>
          <div class="col-sm-9">
          <select id="expense_categories_id" name="expense_categories_id" class="form-control @error('expense_categories_id') is-invalid @enderror" required>
              <option>Choose</option>
              @foreach ($expenseCategories as $expenseCategory)
                  <option value="{{ $expenseCategory->id }}">{{ $expenseCategory->expense_cat_name }}</option>                                
              @endforeach
          </select>
          @error('expense_categories_id')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
          </div>
      </div>

      <div class="form-group row gutters">
        <label for="amount" class="col-sm-3 col-form-label">Amount</label>
        <div class="col-sm-9">
          <input type="amount" maxlength="11" class="form-control" id="amount" placeholder="" class="form-control @error('amount') is-invalid @enderror" name="amount" value="{{ old('amount') }}" required autocomplete="amount" autofocus>
        <input type="hidden" id="balance" value="{{ $balance }}">
        <span class="invalid-feedback d-none" id="error-output" role="alert">
            <strong>Amount entered cannot be greater than the Expenses Balance</strong>
        </span>
          @error('amount')
              <span class="invalid-feedback" role="alert">
                  <strong>{{ $message }}</strong>
              </span>
          @enderror
        </div>
      </div>

      <div class="form-group row gutters">
          <label for="expense_description" class="col-sm-3 col-form-label">Description</label>
          <div class="col-sm-9">
            <textarea id="expense_description" rows="3" class="form-control @error('expense_description') is-invalid @enderror" name="expense_description" required autocomplete="expense_description" autofocus>{{ old('expense_description') }}</textarea>
            @error('expense_description')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
          </div>
        </div>

        <div class="form-group row gutters">
          <div class="col-sm-10">
            <button type="submit" class="btn btn-primary">Create</button>
          </div>
        </div>
        </form>
      </div>
    </div>
  </div>
</div>
<!-- Row end -->
  </div>

  <script>
    $(document).ready(function(){

      $(document).on('focusout', '#amount', function(){

        let balance = $('#balance').val();
        let amount = $('#amount').val();

        if(parseFloat(amount) > parseFloat(balance)){
          $('#amount').val('').addClass('is-invalid')
          $('#error-output').removeClass('d-none');
        }
        if(parseFloat(amount) < parseFloat(balance)){
          $('#amount').val(amount).removeClass('is-invalid')
          $('#error-output').addClass('d-none');
        }

      });

    });
    </script>
@endsection
