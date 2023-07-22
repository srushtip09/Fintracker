@extends('layouts.app')

@section('page-title', 'Transactions')

@section('page-styles')
    <link rel="stylesheet" href="{{ asset('assets/plugins/datatables/datatables.bundle.css') }}">
@endsection

@section('page-content')
    <div class="d-flex justify-content-between">
        <div class="form-group">
            <select name="category" id="category" class="px-5 form-category-select">
                <option></option>
                @foreach($categories as $category)
                    <option value="{{$category->id}}">{{$category->name}}</option>
                @endforeach
            </select>
            <select name="type" id="type" class="form-type-select">
                <option></option>
                @foreach($types as $type)
                    <option>{{$type}}</option>
                @endforeach
            </select>
        </div>

        <div class="">
            <a href="{{ route('transactions.externalCreate') }}" class="btn btn-outline-white btn-icon text-white" type="button">
                <span class=""><i class="fa fa-rupee"></i></span>
                <span class="btn-inner--text">Add External Transactions</span>
            </a>
            <a href="{{ route('transactions.create') }}" class="btn btn-outline-white btn-icon text-white" type="button">
                <span class=""><i class="fa fa-credit-card"></i></span>
                <span class="btn-inner--text">Add Transactions</span>
            </a>
        </div>
    </div>
    @include('masters.transactions.partials._index')
@endsection

@section('page-scripts')
    <script src="{{ asset('assets/plugins/datatables/datatables.bundle.js') }}"></script>
    <script src="{{asset('assets/js/masters/transactions/datatable.js')}}"></script>
    <script>
        let $data = {
            category:   "",
            type:   ""
        };
        $(document).ready(function () {
            initTransactionsTable("{{route('transactions.getTransactionJson')}}");
        });
        $(document).ready(function() {
            $('.form-category-select').select2({
                placeholder:    "Category",
                allowClear:     true
            });
            $('.form-type-select').select2({
                placeholder:    "Type",
                allowClear:     true
            });

            $('#type').on('change', function() {
                $data.type = $('#type').val();
                console.log($('#type').val())
                if($('#type').val() == 0)
                    console.log("true");
                else
                    console.log("false");
                table.destroy();
                initTransactionsTable("{{route('transactions.getTransactionJson')}}",$data);
                table.table().draw();
            });
            $('#category').on('change', function() {
                $data.category = $('#category').val();
                console.log($('#category').val())
                if($('#category').val() == 0)
                    console.log("true");
                else
                    console.log("false");
                table.destroy();
                initTransactionsTable("{{route('transactions.getTransactionJson')}}",$data);
                table.table().draw();
            });
        });
    </script>
@endsection
