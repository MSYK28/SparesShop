@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="container mb-2">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb bg-transparent mb-1 pb-1 pt-1 px-0 me-sm-6 me-5">
                    <li class="breadcrumb-item text-sm">
                        <a class="opacity-5 text-dark" href="javascript:;">Analytics</a>
                    </li>
                    <li class="breadcrumb-item text-sm text-dark active text-capitalize" aria-current="page">
                        Summary
                    </li>
                </ol>
                <h6 class="font-weight-bolder mb-0 mt-2 text-capitalize">Sales Summary on
                    {{ date('F d, Y', strtotime($today)) }}
                </h6>
            </nav>
        </div>

        <div class="container">
            <div class="ms-3 mt-5">
                <div class="col-lg-12 position-relative z-index-2">
                    {{-- GENERAL STATISTICS --}}
                    <div class="general-statistics">
                        <div class="cards card-plain mb-4">
                            <div class="card-body p-3">
                                <div class="row">
                                    <div class="col-lg-6">
                                        <div class="d-flex flex-column h-100">
                                            <h2 class="font-weight-bolder mb-0 mt-2">Daily Statistics</h2>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row ms-5">
                            <div class="col-sm-3">
                                <div class="card  mb-4">
                                    <div class="card-body p-3">
                                        <div class="row">
                                            <div class="col-8">
                                                <div class="numbers">
                                                    <p class="text-sm mb-0 text-capitalize font-weight-bold">Sales</p>
                                                    <h5 class="font-weight-bolder mb-0 mt-2"> Ksh.
                                                        {{ number_format($total_sales, 2) }}
                                                    </h5>
                                                </div>
                                            </div>
                                            <div class="col-4 text-end">
                                                <div
                                                    class="icon icon-shape bg-gradient-primary shadow text-center border-radius-md">
                                                    <i class="ni ni-money-coins text-lg opacity-10" aria-hidden="true"></i>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-3">
                                <div class="card ">
                                    <div class="card-body p-3">
                                        <div class="row">
                                            <div class="col-8">
                                                <div class="numbers">
                                                    <p class="text-sm mb-0 text-capitalize font-weight-bold">Cash</p>
                                                    <h5 class="font-weight-bolder mb-0 mt-2">Ksh.
                                                        {{ number_format($cash_sales, 2) }}
                                                    </h5>
                                                </div>
                                            </div>
                                            <div class="col-4 text-end">
                                                <div
                                                    class="icon icon-shape bg-gradient-primary shadow text-center border-radius-md">
                                                    <i class="ni ni-world text-lg opacity-10" aria-hidden="true"></i>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-3">
                                <div class="card  mb-4">
                                    <div class="card-body p-3">
                                        <div class="row">
                                            <div class="col-8">
                                                <div class="numbers">
                                                    <p class="text-sm mb-0 text-capitalize font-weight-bold">Credit</p>
                                                    <h5 class="font-weight-bolder mb-0 mt-2">Ksh.
                                                        {{ number_format($total_sales - $cash_sales, 2) }}
                                                    </h5>
                                                </div>
                                            </div>
                                            <div class="col-4 text-end">
                                                <div
                                                    class="icon icon-shape bg-gradient-primary shadow text-center border-radius-md">
                                                    <i class="ni ni-paper-diploma text-lg opacity-10"
                                                        aria-hidden="true"></i>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-3">
                                <div class="card ">
                                    <div class="card-body p-3">
                                        <div class="row">
                                            <div class="col-8">
                                                <div class="numbers">
                                                    <p class="text-sm mb-0 text-capitalize font-weight-bold">Revenue</p>
                                                    <h5 class="font-weight-bolder mb-0 mt-2"> Ksh.
                                                        {{ $revenue }}
                                                        <span class="text-success text-sm font-weight-bolder"></span>
                                                    </h5>
                                                </div>
                                            </div>
                                            <div class="col-4 text-end">
                                                <div
                                                    class="icon icon-shape bg-gradient-primary shadow text-center border-radius-md">
                                                    <i class="ni ni-cart text-lg opacity-10" aria-hidden="true"></i>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    {{-- ACCOUNT STATISTICS --}}
                    <div class="account-statistics">
                        <div class="cards card-plain mb-4">
                            <div class="card-body p-3">
                                <div class="row">
                                    <div class="col-lg-6">
                                        <div class="d-flex flex-column h-100">
                                            <h2 class="font-weight-bolder mb-0 mt-2">Account Statistics</h2>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row ms-5">
                            <div class="col-sm-3">
                                <div class="card ">
                                    <div class="card-body p-3">
                                        <div class="row">
                                            <div class="col-8">
                                                <div class="numbers">
                                                    <p class="text-sm mb-0 text-capitalize font-weight-bold">Sales
                                                        {{ date('F, Y', strtotime($monthlySales[0]->month)) }}</p>
                                                    <h5 class="font-weight-bolder mb-0 mt-2">Ksh.
                                                        {{ number_format($monthlySales[0]->total_sales, 2) }}
                                                    </h5>
                                                </div>
                                            </div>
                                            <div class="col-4 text-end">
                                                <div
                                                    class="icon icon-shape bg-gradient-primary shadow text-center border-radius-md">
                                                    <i class="ni ni-world text-lg opacity-10" aria-hidden="true"></i>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-3">
                                <div class="card  mb-4">
                                    <div class="card-body p-3">
                                        <div class="row">
                                            <div class="col-8">
                                                <div class="numbers">
                                                    <p class="text-sm mb-0 text-capitalize font-weight-bold">Cash
                                                        {{ date('F, Y', strtotime($cashSales[0]->month)) }}</p>
                                                    <h5 class="font-weight-bolder mb-0 mt-2">Ksh.
                                                        {{ number_format($cashSales[0]->total_sales) }}
                                                    </h5>
                                                </div>
                                            </div>
                                            <div class="col-4 text-end">
                                                <div
                                                    class="icon icon-shape bg-gradient-primary shadow text-center border-radius-md">
                                                    <i class="ni ni-paper-diploma text-lg opacity-10"
                                                        aria-hidden="true"></i>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-3">
                                <div class="card ">
                                    <div class="card-body p-3">
                                        <div class="row">
                                            <div class="col-8">
                                                <div class="numbers">
                                                    <p class="text-sm mb-0 text-capitalize font-weight-bold">Credit
                                                        {{ date('F, Y', strtotime($cashSales[0]->month)) }}</p>
                                                    <h5 class="font-weight-bolder mb-0 mt-2"> Ksh.
                                                        {{ number_format($monthlySales[0]->total_sales - $cashSales[0]->total_sales, 2) }}
                                                    </h5>
                                                </div>
                                            </div>
                                            <div class="col-4 text-end">
                                                <div
                                                    class="icon icon-shape bg-gradient-primary shadow text-center border-radius-md">
                                                    <i class="ni ni-cart text-lg opacity-10" aria-hidden="true"></i>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-3">
                                <div class="card ">
                                    <div class="card-body p-3">
                                        <div class="row">
                                            <div class="col-8">
                                                <div class="numbers">
                                                    <p class="text-sm mb-0 text-capitalize font-weight-bold">Revenue</p>
                                                    <h5 class="font-weight-bolder mb-0 mt-2">
                                                        12345
                                                        <span class="text-success text-sm font-weight-bolder">+5%</span>
                                                    </h5>
                                                </div>
                                            </div>
                                            <div class="col-4 text-end">
                                                <div
                                                    class="icon icon-shape bg-gradient-primary shadow text-center border-radius-md">
                                                    <i class="ni ni-cart text-lg opacity-10" aria-hidden="true"></i>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-3">
                                <div class="card  mb-4">
                                    <div class="card-body p-3">
                                        <div class="row">
                                            <div class="col-8">
                                                <div class="numbers">
                                                    <p class="text-sm mb-0 text-capitalize font-weight-bold">Sum Credit
                                                        Sales</p>
                                                    <h5 class="font-weight-bolder mb-0 mt-2"> Ksh.
                                                        {{ number_format($all_credit_sales, 2) }}
                                                    </h5>
                                                </div>
                                            </div>
                                            <div class="col-4 text-end">
                                                <div
                                                    class="icon icon-shape bg-gradient-primary shadow text-center border-radius-md">
                                                    <i class="ni ni-money-coins text-lg opacity-10"
                                                        aria-hidden="true"></i>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-3">
                                <div class="card  mb-4">
                                    <div class="card-body p-3">
                                        <div class="row">
                                            <div class="col-8">
                                                <div class="numbers">
                                                    <p class="text-sm mb-0 text-capitalize font-weight-bold">Sum Credit
                                                        Paid</p>
                                                    <h5 class="font-weight-bolder mb-0 mt-2"> Ksh.
                                                        {{ number_format($all_credit_paid, 2) }}
                                                    </h5>
                                                </div>
                                            </div>
                                            <div class="col-4 text-end">
                                                <div
                                                    class="icon icon-shape bg-gradient-primary shadow text-center border-radius-md">
                                                    <i class="ni ni-money-coins text-lg opacity-10"
                                                        aria-hidden="true"></i>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-3">
                                <div class="card  mb-4">
                                    <div class="card-body p-3">
                                        <div class="row">
                                            <div class="col-8">
                                                <div class="numbers">
                                                    <p class="text-sm mb-0 text-capitalize font-weight-bold">Sum Owed</p>
                                                    <h5 class="font-weight-bolder mb-0 mt-2"> Ksh.
                                                        {{ number_format($owed, 2) }}
                                                    </h5>
                                                </div>
                                            </div>
                                            <div class="col-4 text-end">
                                                <div
                                                    class="icon icon-shape bg-gradient-primary shadow text-center border-radius-md">
                                                    <i class="ni ni-money-coins text-lg opacity-10"
                                                        aria-hidden="true"></i>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    {{-- VENDOR STATISTICS --}}
                    <div class="general-statistics">
                        <div class="cards card-plain mb-4">
                            <div class="card-body p-3">
                                <div class="row">
                                    <div class="col-lg-6">
                                        <div class="d-flex flex-column h-100">
                                            <h2 class="font-weight-bolder mb-0 mt-2">Supplier Statistics</h2>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row ms-5">
                            <div class="col-sm-3">
                                <div class="card  mb-4">
                                    <div class="card-body p-3">
                                        <div class="row">
                                            <div class="col-8">
                                                <div class="numbers">
                                                    <p class="text-sm mb-0 text-capitalize font-weight-bold">Sales</p>
                                                    <h5 class="font-weight-bolder mb-0 mt-2"> Ksh.
                                                        {{ number_format($total_sales, 2) }}
                                                    </h5>
                                                </div>
                                            </div>
                                            <div class="col-4 text-end">
                                                <div
                                                    class="icon icon-shape bg-gradient-primary shadow text-center border-radius-md">
                                                    <i class="ni ni-money-coins text-lg opacity-10"
                                                        aria-hidden="true"></i>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-3">
                                <div class="card ">
                                    <div class="card-body p-3">
                                        <div class="row">
                                            <div class="col-8">
                                                <div class="numbers">
                                                    <p class="text-sm mb-0 text-capitalize font-weight-bold">Cash</p>
                                                    <h5 class="font-weight-bolder mb-0 mt-2">Ksh.
                                                        {{ number_format($cash_sales, 2) }}
                                                    </h5>
                                                </div>
                                            </div>
                                            <div class="col-4 text-end">
                                                <div
                                                    class="icon icon-shape bg-gradient-primary shadow text-center border-radius-md">
                                                    <i class="ni ni-world text-lg opacity-10" aria-hidden="true"></i>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-3">
                                <div class="card  mb-4">
                                    <div class="card-body p-3">
                                        <div class="row">
                                            <div class="col-8">
                                                <div class="numbers">
                                                    <p class="text-sm mb-0 text-capitalize font-weight-bold">Credit</p>
                                                    <h5 class="font-weight-bolder mb-0 mt-2">Ksh.
                                                        {{ number_format($total_sales - $cash_sales, 2) }}
                                                    </h5>
                                                </div>
                                            </div>
                                            <div class="col-4 text-end">
                                                <div
                                                    class="icon icon-shape bg-gradient-primary shadow text-center border-radius-md">
                                                    <i class="ni ni-paper-diploma text-lg opacity-10"
                                                        aria-hidden="true"></i>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-3">
                                <div class="card ">
                                    <div class="card-body p-3">
                                        <div class="row">
                                            <div class="col-8">
                                                <div class="numbers">
                                                    <p class="text-sm mb-0 text-capitalize font-weight-bold">Revenue</p>
                                                    <h5 class="font-weight-bolder mb-0 mt-2">
                                                        $103,430
                                                        <span class="text-success text-sm font-weight-bolder">+5%</span>
                                                    </h5>
                                                </div>
                                            </div>
                                            <div class="col-4 text-end">
                                                <div
                                                    class="icon icon-shape bg-gradient-primary shadow text-center border-radius-md">
                                                    <i class="ni ni-cart text-lg opacity-10" aria-hidden="true"></i>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
