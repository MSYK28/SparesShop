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
            </nav>
        </div>

        <ul class="nav nav-tabs" id="myTab" role="tablist">
            <li class="nav-item" role="presentation">
                <button class="nav-link active" id="home-tab" data-bs-toggle="tab" data-bs-target="#home-tab-pane"
                    type="button" role="tab" aria-controls="home-tab-pane" aria-selected="true">Account</button>
            </li>
            <li class="nav-item" role="presentation">
                <button class="nav-link" id="profile-tab" data-bs-toggle="tab" data-bs-target="#profile-tab-pane"
                    type="button" role="tab" aria-controls="profile-tab-pane"
                    aria-selected="false">Transactions</button>
            </li>
        </ul>
        <div class="tab-content" id="myTabContent">
            <div class="tab-pane fade show active" id="home-tab-pane" role="tabpanel" aria-labelledby="home-tab">
                <div class="container">
                    <div class="ms-3">
                        <div class="col-lg-12 position-relative z-index-2">
                            {{-- GENERAL STATISTICS --}}
                            <div class="general-statistics">
                                <div class="cards card-plain mb-4">
                                    <div class="card-body p-3">
                                        <div class="row">
                                            <div class="col-lg-6">
                                                <div class="d-flex flex-column h-100">
                                                    <h2 class="font-weight-bolder mb-0 mt-2">Daily Statistics</h2>
                                                    <h6 class="font-weight-bolder mb-0 mt-2 text-capitalize">Sales Summary on
                                                        {{ date('F d, Y', strtotime($today)) }}
                                                    </h6>
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
                                                                {{ number_format($revenue, 2) }}
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
                                                    <h2 class="font-weight-bolder mb-0 mt-2">Monthly Account Statistics</h2>
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
                                                            <h5 class="font-weight-bolder mb-0 mt-2"> Ksh. 
                                                                {{ number_format($totalMonthlyRevenue, 2) }}
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
                                    <div class="col-sm-4">
                                        <div class="card  mb-4">
                                            <div class="card-body p-3">
                                                <div class="row">
                                                    <div class="col-8">
                                                        <div class="numbers">
                                                            <p class="text-sm mb-0 text-capitalize font-weight-bold">Total Amount Owed</p>
                                                            <h5 class="font-weight-bolder mb-0 mt-2"> Ksh.
                                                                {{ number_format($total_invoice, 2) }}
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
                                    <div class="col-sm-4">
                                        <div class="card ">
                                            <div class="card-body p-3">
                                                <div class="row">
                                                    <div class="col-8">
                                                        <div class="numbers">
                                                            <p class="text-sm mb-0 text-capitalize font-weight-bold">Total Paid</p>
                                                            <h5 class="font-weight-bolder mb-0 mt-2">Ksh.
                                                                {{ number_format($total_paid, 2) }}
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
                                    <div class="col-sm-4">
                                        <div class="card  mb-4">
                                            <div class="card-body p-3">
                                                <div class="row">
                                                    <div class="col-8">
                                                        <div class="numbers">
                                                            <p class="text-sm mb-0 text-capitalize font-weight-bold">Balance</p>
                                                            <h5 class="font-weight-bolder mb-0 mt-2">Ksh.
                                                                {{ number_format($total_invoice - $total_paid, 2) }}
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
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="tab-pane fade" id="profile-tab-pane" role="tabpanel" aria-labelledby="profile-tab">
                <div class="container m-3">
                    <div class="row ms-3">
                        <div class="col-md-12">
                            <h5 class="h3 mb-0">Filter Sales by Date</h5>
                            <div class="card m-3">
                                <div class="card-header">
                                    <form id="filterFrm" action="{{ route('analytics.filter') }}" method="GET">
                                        @csrf
                                        <div class="row">
                                            <div class="col-md-6 form-group">
                                                <label for="start_date">Start Date</label>
                                                <input type="date" id="start_date" name="start_date" class="form-control">
                                            </div>
                                            <div class="col-md-6 form-group">
                                                <label for="end_date">End Date</label>
                                                <input type="date" id="end_date" name="end_date" class="form-control">
                                            </div>
                                            <button class="btn btn-primary mt-4">Filter</button>
                                            <div class="col-md-4">
                                                {{-- <input type="hidden" name="_token" id="token" value="{{ csrf_token() }}"> --}}
                                            </div>
                                        </div>
                                    </form>
                                </div>
                                <div class="card-body">
                                    <h5 class="h3 mb-0">Filtered Sales Data</h5>
                                    <div class="table">
                                        <table id="products-table" class="table table-striped table-bordered table-responsive">
                                            <thead>
                                                <tr>
                                                    <th style="width: 30px;">#</th>
                                                    <th style="width: 60px">Date</th>
                                                    <th style="width: 180px">Sale ID</th>
                                                    <th style="width: 40px">Sales Amount</th>
                                                    <th style="width: 30px">Action</th>
                                                    <!-- Add more columns as needed -->
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach($sales as $sale)
                                                    <tr>
                                                        <td>{{ $loop->iteration }}</td>
                                                        <td>{{ date('F d, Y', strtotime($sale->created_at)) }}</td>
                                                        <td>{{ $sale->sale_code }}</td>
                                                        <td>{{ number_format($sale->total, 2) }}</td>
                                                        <td>
                                                            {{-- <a href="{{ route('sales.show', $sale->id) }}" class="btn btn-sm btn-info">View</a> --}}
                                                        </td>
                                                        <!-- Add more columns as needed -->
                                                    </tr>
                                                @endforeach
                                            </tbody>
                                        </table>
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
