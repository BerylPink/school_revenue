@extends('layouts.master')
@section('title', 'Editing '.$expense->expense_name)
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
            <h5>Edit Expense</h5>
          <h6 class="sub-heading">Editing {{ $expense->expense_name }}</h6>
          </div>
        </div>
        <div class="col-xl-4 col-lg-4 col-md-4 col-sm-4">
            <div class="right-actions">
            <a href="{{ route('expenses.index') }}" class="btn btn-success float-right" data-toggle="tooltip" data-placement="left" title="Expense list">
                <i class="icon-tree"></i>
              </a>
            </div>
          </div>
      </div>
    </div>
  </header>
  <!-- END: .main-heading -->

  <div class="main-content">
  <!-- Row start -->
<div class="row gutters">
  <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12">
    <div class="card">
      <div class="card-header">Edit Expense</div>
      <div class="card-body">
        <form method="POST" action="{{ route('expenses.update', $expense->id) }}">
          @csrf @method('PUT')
        <div class="form-group row gutters">
          <label for="expense_name" class="col-sm-3 col-form-label">Name</label>
          <div class="col-sm-9">
            <input type="text" class="form-control" id="expense_name" placeholder="Name" class="form-control" name="expense_name" value="{{ old('expense_name') ?? $expense->expense_name }}">
          </div>
        </div>

        <div class="form-group row gutters">                        
          <label for="expense_categories_id" class="col-sm-3 col-form-label">Course Category</label>
          <div class="col-sm-9">
          <select id="expense_categories_id" name="expense_categories_id" class="form-control" required>
              <option>Choose</option>
              @foreach ($expenseCategories as $expenseCategory)
                  <option value="{{ $expenseCategory->id }}"  @if($expenseCategory->id  == $expense->id) selected @endif>{{ $expenseCategory->expense_cat_name }}</option>                                
              @endforeach
          </select>
          </div>
      </div>

      <div class="form-group row gutters">
        <label for="amount" class="col-sm-3 col-form-label">Amount</label>
        <div class="col-sm-9">
          <input type="amount" axlength="11" class="form-control" id="amount" placeholder="Amount" class="form-control" name="amount" value="{{ old('amount') ?? $expense->amount }}">
        </div>
      </div>

      <div class="form-group row gutters">
          <label for="expense_description" class="col-sm-3 col-form-label">Description</label>
          <div class="col-sm-9">
            <textarea id="expense_description" rows="3" class="form-control @error('expense_description') is-invalid @enderror" name="expense_description" required autocomplete="expense_description" autofocus>{{ old('expense_description') ?? $expense->expense_description }}</textarea>
            @error('expense_description')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
          </div>
        </div>

        <div class="form-group row gutters">
          <div class="col-sm-10">
            <a href="{{ route('expenses.index') }}" class="btn btn-danger">Back</a>
            <button type="submit" class="btn btn-primary">Update</button>
          </div>
        </div>
        </form>
      </div>
    </div>
  </div>
</div>
<!-- Row end -->
  </div>
@endsection
