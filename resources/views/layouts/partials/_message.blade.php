
@if(session()->has('success'))
<div class="alert alert-success text-white" role="alert">
    <strong>Success:</strong> {{ session()->get('success') }}
</div>
@endif

@if(session()->has('error'))
<div class="alert alert-danger text-white" role="alert">
    <strong>Error:</strong> {{ session()->get('error') }}
</div>
@endif
