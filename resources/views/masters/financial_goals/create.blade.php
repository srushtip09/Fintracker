@extends('layouts.app')

@section('page-title', 'Add Transactions')

@section('page-content')
    <div class="p-4 bg-white border-radius-xl">
        <form action="{{route('financial_goals.store')}}" method="POST" enctype="multipart/form-data">
            @csrf

            <div class="form-group">
                <label for="name" class="form-control-label">Name of the goal <span class="text-danger">*</span></label>
                <input class="form-control" type="text" name="name" id="name" placeholder="Car, House, etc">
            </div>
            <div class="form-group">
                <label for="amount" class="form-control-label">Amount required <span class="text-danger">*</span></label>
                <input class="form-control" type="text" name="amount" id="amount">
            </div>

            <div class="form-group">
                <label for="priority" class="form-control-label">Priority (1-high, 5-low)<span class="text-danger">*</span></label>
                <input class="form-control" type="number" min="1" max="5" name="priority" id="priority" value="1">
            </div>

            <button type="submit" class="btn bg-gradient-primary btn-lg">Submit</button>
        </form>
    </div>
@endsection

@section('page-scripts')
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
        });
    </script>
@endsection
