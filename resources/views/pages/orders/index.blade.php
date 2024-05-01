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
                        <h5 class="card-title">Orders List</h5>
                    </div>
                    <div class="card-body">
                        <table id="products-table" class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th>Order ID</th>
                                    <th>Supplier</th>
                                    <th>Total</th>
                                    <th>Status</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($orders as $order)
                                    <tr>
                                        <td>{{ $order->orderCode }}</td>
                                        <td>{{ $order->suppliers->name }}</td>
                                        <td>{{ number_format($order->total, 2) }}</td>
                                        <td>
                                            @if ($order->status == 1)
                                                <span class="badge bg-primary">Pending Delivery</span>
                                            @else
                                                <span class="badge bg-success">Delivered</span>
                                            @endif
                                        </td>
                                        <td>
                                            <a href="{{ route('orders.edit', $order->id) }}" class="btn btn-sm btn-primary mr-2"><i
                                                    class="fas fa-edit"></i> Edit</a>
                                            <a href="{{ route('orders.show', $order->id) }}"
                                                class="btn btn-sm btn-info mr-2"><i class="fas fa-edit"></i> View</a>
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
