@extends('layouts.app')

@section('content')
    <div class="container">

        <div class="container mb-3">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb bg-transparent mb-1 pb-1 pt-1 px-0 me-sm-6 me-5">
                    <li class="breadcrumb-item text-sm">
                        <a class="opacity-5 text-dark" href="javascript:;">Sales</a>
                    </li>
                    <li class="breadcrumb-item text-sm text-dark active text-capitalize" aria-current="page">
                        Sales List
                    </li>
                </ol>
                <h6 class="font-weight-bolder mb-0 text-capitalize">List of current Sales</h6>
            </nav>
        </div>

        <div class="container ms-3 mt-5">
            <div class="row justify-content-center">
                <div class="card ms-5">
                    <div class="card-header d-flex justify-content-between align-items-center">
                        <h5 class="card-title">Sales on <span class="text-body supplier_name">{{ date('F d, Y', strtotime($today)) }}</span></h5>
                        <a href="{{ route('home') }}" class="btn btn-sm m-2 btn-primary">New Sale</a>
                    </div>
                    <div class="card-body">
                        <table id="products-table" class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th>Sale Code</th>
                                    <th>Sale Type</th>
                                    <th>Customer</th>
                                    <th>Total</th>
                                    <th>Status</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($today_sales as $sale)
                                    <tr>
                                        <td>{{ $sale->sale_code }}</td>
                                        <td>
                                            @if ($sale->saleType == 0)
                                                <span class="badge bg-info">Waiting</span>
                                            @elseif ($sale->saleType == 1)
                                                <span class="badge bg-primary">Cash</span>
                                            @else
                                                <span class="badge bg-warning">Credit</span>
                                            @endif
                                        </td>
                                        <td>{{ $sale->customer->name }}</td>
                                        <td>{{ number_format($sale->total, 2) }}</td>
                                        <td>
                                            @if ($sale->status == 1)
                                                <span class="badge bg-primary">Waiting</span>
                                            @else
                                                <span class="badge bg-success">Approved</span>
                                            @endif
                                        </td>
                                        <td>
                                            <a href="{{ route('sales.show', $sale->id) }}"
                                                class="btn btn-sm btn-primary mr-2"><i class="fas fa-edit"></i> View</a>
                                            {{-- <button type="button" class="btn btn-sm btn-danger" data-toggle="modal" data-target="#deleteModal-{{ $product->id }}"><i class="fas fa-trash"></i> Delete</button> --}}
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
