@extends('layouts.app')

@section('page-title', 'Add Transactions')

@section('page-content')
    <div class="p-4 bg-white border-radius-xl">
        <form action="{{route('transactions.update', $transaction->id)}}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            {{-- <div class="form-group">
                <label for="bank">Select your Bank: <span class="text-danger">*</span></label>
                <select id="bank_select" class="form-select" name="bank_id" placeholder="Select your bank">
                    <option></option>
                    @foreach($banks as $bank)
                        <option value="{{$bank->id}}">{{ $bank->name }}</option>
                    @endforeach
                </select>
            </div> --}}

            {{-- <div id="bank_name_wrapper" class="form-group d-none">
                <label for="bank_name">Bank Name <span class="text-danger fw-light">* (Specify If Other)</span></label>
                <input type="text" class="form-control" id="bank_name" name="bank_name" placeholder="e.g: State Bank Of India">
            </div> --}}

            {{-- <div class="form-group">
                <label for="account_number" class="form-control-label">Account Number <span class="text-danger">*</span></label>
                <input class="form-control" type="number" name="account_number" id="account_number">
            </div> --}}



            <div class="form-group">
                <label for="ref_no" class="form-control-label">Reference no.<span class="text-danger">*</span></label>
                <input class="form-control" type="text" name="ref_no" id="ref_no" required placeholder="123" value="{{$transaction->reference_no}}">
            </div>
            <div class="form-group">
                <label for="date" class="form-control-label">Date<span class="text-danger">*</span></label>
                <input class="form-control" type="text" name="date" id="datepicker" placeholder="2023-04-26" required value="{{$transaction->date}}">
            </div>
            <div class="form-group">
                <label for="desc" class="form-control-label">Description<span class="text-danger">*</span></label>
                <input class="form-control" type="text" name="desc" id="desc" required placeholder="Transaction description" value="{{$transaction->description}}">
            </div>
            <div class="form-group">
                <label for="amountType" class="form-control-label">Amount Type<span class="text-danger">*</span></label>
                <select id="amountType_select" class="form-select" name="amountType" placeholder="Select your amount type">
                    <option></option>
                    @foreach($amtTypes as $amtType)
                        <option value="{{$amtType}}" {{$amtType == $transaction->amt_type ? 'selected' : ''}}>{{$amtType}}</option>
                    @endforeach
                </select>
            </div>
            <div class="form-group">
                <label for="category" class="form-control-label">Category<span class="text-danger">*</span></label>
                <select id="category_select" class="form-select" name="category" placeholder="Select your category">
                    <option></option>
                    @foreach($categories as $category)
                        <option value="{{$category->id}}" {{$category->id == $transaction->category_id ? 'selected' : ''}}>{{$category->name}}</option>
                    @endforeach
                </select>
            </div>

            <div class="form-group">
                <label for="amount" class="form-control-label">Amount<span class="text-danger">*</span></label>
                <input class="form-control" type="text" name="amount" id="amount" required placeholder="Transaction amount" value="{{$transaction->amt_debit != null ? $transaction->amt_debit: $transaction->amt_credit}}" readonly>
            </div>
            <button type="submit" class="btn bg-gradient-primary btn-lg">Submit</button>
        </form>
    </div>
@endsection

@section('page-scripts')
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/js/bootstrap-datepicker.min.js" ></script>
    <script>
        $(document).ready(function() {
            $('#bank_select').select2({
                placeholder: 'Select your bank'
            });
            $('#bank_select').on('change', function() {
                if($('#bank_select>option:selected').text() == 'Others')
                    $('#bank_name_wrapper').removeClass('d-none');
                else
                    $('#bank_name_wrapper').addClass('d-none');
            });

            $('#datepicker').datepicker();
            $('#datepicker').on('changeDate', function() {
                $('#my_hidden_input').val(
                    $('#datepicker').datepicker('getFormattedDate')
                );
            });
        });
    </script>
@endsection
