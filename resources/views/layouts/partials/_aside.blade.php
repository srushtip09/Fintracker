<aside class="sidenav bg-white navbar navbar-vertical navbar-expand-xs border-0 border-radius-xl my-2 fixed-start ms-4 " id="sidenav-main">
    <div class="sidenav-header">
        <i class="fas fa-times p-3 cursor-pointer text-secondary opacity-5 position-absolute end-0 top-0 d-none d-xl-none" aria-hidden="true" id="iconSidenav"></i>
        <a class="navbar-brand  align-items-center mb-5" href="{{ route('home') }}" target="_blank">
            <div class="d-flex w-100 justify-content-center ">
                <img style="max-height: 80px;" src="{{asset("./assets/img/budget-buddha-logo.png")}}" class="navbar-brand-img img-responsive" alt="main_logo" width="45%">
            </div>
            <div class="d-flex w-100 justify-content-center">
                <span class="ms-2 fs-5 fw-bolder text-center">FinTracker</span>
            </div>
        </a>
    </div>
    <hr class="horizontal dark mb-5">
    <div class="collapse navbar-collapse  w-auto " id="sidenav-collapse-main">
        <ul class="navbar-nav">
            <li class="nav-item my-2">
                <a class="nav-link active" href="{{route('dashboard')}}">
                    <div class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
                        <i class="ni ni-paper-diploma fa-2x text-primary opacity-10"></i>
                    </div>
                    <span class="nav-link-text fs-5 ms-1">Dashboard</span>
                </a>
            </li>
            <li class="nav-item my-2">
                <a class="nav-link active" href="{{ route('transactions.index') }}">
                    <div class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
                        <i class="ni ni-ungroup fa-2x text-primary opacity-10"></i>
                    </div>
                    <span class="nav-link-text fs-5 ms-1">Transactions</span>
                </a>
            </li>
            <li class="nav-item my-2">
                <a class="nav-link active" href="{{ route('financial_goals.index') }}">
                    <div class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
                        <i class="fa fa-bullseye fa-2x text-primary opacity-10"></i>
                    </div>
                    <span class="nav-link-text fs-5 ms-1">Financial Goals</span>
                </a>
            </li>
        </ul>
    </div>
</aside>
