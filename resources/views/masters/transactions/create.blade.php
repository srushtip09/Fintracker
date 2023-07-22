@extends('layouts.app')

@section('page-title', 'Add Transactions')

@section('page-content')
    <div class="p-4 bg-white border-radius-xl">
        <form action="{{route('transactions.store')}}" method="POST" enctype="multipart/form-data">
            @csrf
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
                <label for="account_statement" class="form-control-label">Upload your account statement <span class="text-info">(PDF format only)</span> <span class="text-danger">*</span></label>
                <input class="form-control" type="file" name="account_statement" id="account_statement">
            </div>
            <div class="form-group">
                <label for="password" class="form-control-label">Password <span class="text-danger">(if any)</span></label>
                <input class="form-control" type="text" name="password" id="password">
            </div>

            <div class="form-group">
                <div>
                    <label class="form-label">Sample Format</label>
                    <div class="d-flex align-items-center border border-dashed border-gray-300 rounded p-3">
                        <!--begin::Item-->
                        <div class="d-flex flex-aligns-center pe-10 pe-lg-20">
                            <!--begin::Icon-->
                            <img alt="excel" class="w-30px me-3" src="{{asset('/assets/media/svg/doc.svg')}}">
                            <!--end::Icon-->
                            <!--begin::Info-->
                            <div class="ms-1 fw-semibold">
                                <!--begin::Desc-->
                                <a href="{{asset('demo-files/statement_excel_sample_format.xlsx')}}" class="fs-6 text-hover-primary fw-bold">Skeleton Excel</a>
                                <!--end::Desc-->

                                <!--begin::Number-->
                                <div>
                                    <div class="text-gray-400 d-flex">statement_excel_sample_format.xlsx</div>
                                    <div class="text-info d-flex">Table columns have to same as sample file. data may vary according to banks.</div>
                                </div>
                                <!--end::Number-->
                            </div>
                            <!--end::Info-->
                        </div>
                        <!--end::Item-->
                    </div>
                </div>
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
