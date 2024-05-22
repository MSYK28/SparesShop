@extends('layouts.app')

@section('content')
<div class="content-wrapper">
    <div class="container-xxl flex-grow-1 container-p-y">
        <div class="container">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb bg-transparent mb-1 pb-1 pt-1 px-0 me-sm-6 me-5">
                    <li class="breadcrumb-item text-sm">
                        <a class="opacity-5 text-dark" href="javascript:;">Orders</a>
                    </li>
                    <li class="breadcrumb-item text-sm text-dark active text-capitalize" aria-current="page">
                        Invoice
                    </li>
                </ol>
                <h6 class="font-weight-bolder mb-0 text-capitalize">Orders Invoice</h6>
            </nav>

            <div
                class="d-flex flex-column flex-md-row justify-content-between align-items-start align-items-md-center my-3">
                <div class="d-flex flex-column justify-content-center">
                    <h5 class="mb-1 mt-3">Order #{{ $order->id }} <span
                            class="badge bg-label-success me-2 ms-2">Paid</span> <span class="badge bg-label-info">Ready
                            to
                            Pickup</span></h5>
                    <p class="text-body">
                        {{ date('F d, Y', strtotime($order->created_at)) }}
                    </p>
                </div>
                @if ($order->status == 1)
                <form action="{{ route('sales.destroy', $order->id) }}" method="POST">
                    @csrf
                    @method('DELETE')
                    <div class="d-flex align-content-center flex-wrap gap-2">
                        <input type="hidden" name="sale_id" value="{{ $order->id }}">
                        <button class="btn btn-danger delete-order">Delete Order</button>
                    </div>
                </form>
                @endif
            </div>
        </div>

        <!-- Order Details Table -->
        <div class="container ms-3 mt-4">
            <div class="row">
                <div class="col-12 col-lg-8">
                    <div class="card mb-4">
                        <div class="card-header d-flex justify-content-between align-items-center">
                            <h5 class="card-title m-0">Order details</h5>
                            @if ($order->customer_id == 1)
                            <h6 class="m-0"><a href=" javascript:void(0)">Edit</a></h6>
                            @endif
                        </div>
                        <div class="card-datatable table-responsive">
                            <div id="DataTables_Table_0_wrapper" class="m-2">
                                <table class="table table-responsive table-striped table-bordered "
                                    id="DataTables_Table_0">
                                    <thead>
                                        <tr>
                                            <th style="width: 50px;">#</th>
                                            <th style="width: 250px;" aria-label="products">Products</th>
                                            <th style="width: 100px;" aria-label="qty">Quantity Requested</th>
                                            <th style="width: 100px;" aria-label="qty">Quantity Received</th>
                                            <th style="width: 100px;" aria-label="price">Price</th>
                                            <th style="width: 100px;" aria-label="total">Total</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($order_details as $order_detail)
                                        <tr>
                                            <td>{{ $loop->iteration }}</td>
                                            <td>{{ $order_detail->products->productTitle }}</td>
                                            <td>{{ $order_detail->quantity }}</td>
                                            <td>{{ $order_detail->quantity_received }}</td>
                                            <td>{{ number_format($order_detail->price, 2) }}</td>
                                            <td>{{ number_format($order_detail->quantity * $order_detail->price, 2) }}
                                            </td>
                                        </tr>
                                        @endforeach
                                    </tbody>
                                    <tfoot>
                                        <tr>
                                            <td colspan="5"><strong>Total</strong></td>
                                            <td>{{ number_format($order->total, 2) }}</td>
                                        </tr>
                                    </tfoot>
                                </table>
                                <div style="width: 1%;"></div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-12 col-lg-4">
                    <div class="card mb-4">
                        <div class="card-header d-flex justify-content-between">
                            <h6 class="card-title m-0">Supplier details</h6>
                        </div>
                        <div class="card-body">
                            <div class="d-flex justify-content-between">
                                <h6>Contact info</h6>
                                @if ($order->customer_id == 1)
                                <h6><a href=" javascript:void(0)" data-bs-toggle="modal"
                                        data-bs-target="#editUser">Edit</a>
                                </h6>
                                @endif
                            </div>
                            <div class="row">
                                <div class="col-12 col-md-7">
                                    <label class="form-label" for="customer_name">Name</label>
                                    <input type="text" id="customer_name" name="customer_name" class="form-control"
                                        readonly value="{{ $order->suppliers->name }}">
                                </div>
                                <div class="col-12 col-md-3">
                                    <label class="form-label" for="orders">0rders</label>
                                    {{-- <h6 class="text-body text-nowrap mb-0">Orders: {{ $customer->orders()->count() }}
                                    </h6> --}}
                                    <input id="orders" name="orders" class="form-control" readonly>
                                </div>
                            </div>
                            <div class="col-md-12 mt-2">
                                <label class="form-label" for="customer_name">Email</label>
                                <input type="text" id="customer_name" name="customer_name" class="form-control" readonly
                                    value="{{ $order->suppliers->email }}">
                            </div>
                        </div>

                        <div class="card-footer">
                            <form id="receiveGoodsForm" class="row g-3" action="{{ route('sales.store') }}"
                                method="POST">
                                @csrf
                                <div class="d-flex justify-content-center align-items-center">
                                    <input type="hidden" name="status" id="status" value="2">
                                    <input type="hidden" name="sale_id" id="sale_id" value={{ $order->id }}>
                                    <input type="hidden" name="customer_sale_id" id="customer_sale_id">
                                    @if (!empty($order->total)) 
                                    <h6 class="m-0"><a href=" javascript:void(0)" data-bs-toggle="modal"
                                        class="btn btn-primary me-sm-3 me-1">Print Order</a></h6>
                                    @else 
                                    <h6 class="m-0"><a href=" javascript:void(0)" data-bs-toggle="modal"
                                        data-bs-target="#receiveGoodsModal"
                                        class="btn btn-success me-sm-3 me-1">Receive Order</a></h6>
                                    @endif
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        {{-- Receive Goods Modal --}}
        <div class="modal fade" id="receiveGoodsModal" tabindex="-1" aria-hidden="true">
            <div class="modal-dialog modal-lg modal-simple modal-edit-user">
                <div class="modal-content p-3 p-md-5">
                    <div class="modal-body">
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        <div class="text-center mb-4">
                            <h3>Receive Delivered Goods</h3>
                            <p>Fill form to receive goods.</p>
                        </div>
                        <form id="receiveOrderForm" class="row g-3" action="{{ route('orders.store') }}" method="POST">
                            @csrf
                            <table class="table table-responsive table-bordered table-striped">
                                <thead>
                                    <tr>
                                        <th style="width: 254px;" aria-label="products">Products</th>
                                        <th style="width: 144px;" aria-label="qty">Quantity Requested</th>
                                        <th style="width: 144px;" aria-label="qty">Quantity Received</th>
                                        <th style="width: 144px;" aria-label="price">Price</th>
                                        <th style="width: 144px;" aria-label="total">Total</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($order_details as $order_detail)
                                    <tr>
                                        <td>{{ $order_detail->products->productTitle }}
                                            <input type="hidden" class="form-control product_id" name="product_id[]"
                                                id="product_id" value="{{ $order_detail->product_id }}" required>
                                        </td>
                                        <td>{{ $order_detail->quantity }}</td>
                                        <td>
                                            <input type="text" class="form-control order_quantity_received"
                                                name="quantity_received[]" id="order_quantity_received" required>
                                        </td>
                                        <td>
                                            <input type="text" class="form-control order_price" name="price[]"
                                                id="order_price" required>
                                        </td>
                                        <td id="item_total" class="total"></td>
                                    </tr>
                                    @endforeach
                                </tbody>
                                <tfoot>
                                    <tr>
                                        <td colspan="4">Total</td>
                                        <td colspan="1" class="total" id="total"></td>
                                        <input type="hidden" class="form-control" name="order_id" id="order_id"
                                            value="{{ $order->id }}" required>
                                        <input type="hidden" class="form-control subtotal" name="subtotal"
                                            id="subtotal">
                                        <input type="hidden" name="_token" id="token" value="{{ csrf_token() }}">
                                    </tr>
                                </tfoot>
                            </table>

                            <div class="col-12 text-center mt-3">
                                <button type="reset" class="btn btn-secondary" data-bs-dismiss="modal"
                                    aria-label="Close">Cancel</button>
                                <button type="submit" id="receive-order-btn"
                                    class="btn btn-primary me-sm-3 me-1">Submit</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        {{-- / Receive Goods modal --}}

    </div>
    <!-- / Content -->

    <div class="content-backdrop fade"></div>
</div>
@endsection
