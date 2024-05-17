@extends('layouts.app')

@section('content')
    <div class="content-wrapper">
        <div class="container-xxl flex-grow-1 container-p-y">
            <div class="container">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb bg-transparent mb-1 pb-1 pt-1 px-0 me-sm-6 me-5">
                        <li class="breadcrumb-item text-sm">
                            <a class="opacity-5 text-dark" href="javascript:;">Sales</a>
                        </li>
                        <li class="breadcrumb-item text-sm text-dark active text-capitalize" aria-current="page">
                            Invoice
                        </li>
                    </ol>
                    <h6 class="font-weight-bolder mb-0 text-capitalize">Sales Invoice</h6>
                </nav>

                <div
                    class="d-flex flex-column flex-md-row justify-content-between align-items-start align-items-md-center my-3">
                    <div class="d-flex flex-column justify-content-center">
                        <h5 class="mb-1 mt-3">Order #{{ $sale->id }} <span
                                class="badge bg-label-success me-2 ms-2">Paid</span> <span class="badge bg-label-info">Ready
                                to
                                Pickup</span></h5>
                        <p class="text-body">
                            {{ date('F d, Y', strtotime($sale->created_at)) }}
                        </p>
                    </div>
                    @if ($sale->status == 1)
                        <form action="{{ route('sales.destroy', $sale->id) }}" method="POST" id="delete-draft">
                            @csrf
                            @method('DELETE')
                            <div class="d-flex align-content-center flex-wrap gap-2">
                                <input type="hidden" name="sale_id" id="sale_id" value="{{ $sale->id }}">
                                <button class="btn btn-danger delete-order">Delete Sale</button>
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
                                @if ($sale->customer_id == 1)
                                    <h6 class="m-0"><a href=" javascript:void(0)">Edit</a></h6>
                                @endif
                            </div>
                            <div class="card-datatable table-responsive">
                                <div id="DataTables_Table_0_wrapper" class="m-2">
                                    <table class="table table-responsive table-striped table-bordered "
                                        id="DataTables_Table_0">
                                        <thead>
                                            <tr>
                                                <th style="width: 254px;" aria-label="products">Products</th>
                                                <th style="width: 144px;" aria-label="qty">Quantity</th>
                                                <th style="width: 144px;" aria-label="price">Price</th>
                                                <th style="width: 144px;" aria-label="total">Total</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($show_sales as $show_sale)
                                                <tr>
                                                    <td>{{ $show_sale->products->productTitle }}</td>
                                                    <td>{{ $show_sale->quantity }}</td>
                                                    <td>{{ number_format($show_sale->price, 2) }}</td>
                                                    <td>{{ number_format($show_sale->quantity * $show_sale->price, 2) }}
                                                    </td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                        <tfoot>
                                            <tr>
                                                <td colspan="2"></td>
                                                <td>Subtotal</td>
                                                <td>{{ number_format($subtotal, 2) }}</td>
                                            </tr>
                                            <tr>
                                                <td colspan="2"></td>
                                                <td>VAT (16%)</td>
                                                <td>{{ number_format($VAT, 2) }}</td>
                                            </tr>
                                            <tr>
                                                <td colspan="2"></td>
                                                <td>Total</td>
                                                <td>{{ number_format($total, 2) }}</td>
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
                                <h6 class="card-title m-0">Customer details</h6>
                                @if ($sale->customer_id == 1)
                                    <h6 class="m-0"><a href=" javascript:void(0)" data-bs-toggle="modal"
                                            data-bs-target="#addCustomerModal">New Customer</a></h6>
                                @endif
                            </div>
                            @if ($sale->customer_id == 1)
                                <div class="card-body">
                                    <div>
                                        <label for="" class="form-label" for="customer_id">Select Customer</label>
                                        <select name="customer_id" id="customer_id" class="form-select" required>
                                            <option value="">Choose Customer</option>
                                            @foreach ($customers as $customer)
                                                <option value="{{ $customer->id }}">{{ $customer->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="d-flex justify-content-between pt-4">
                                        <h6>Contact info</h6>
                                    </div>
                                    <div class="row">
                                        <div class="col-12 col-md-7">
                                            <label class="form-label" for="customer_name">Phone Number</label>
                                            <input type="text" id="customer_name" name="customer_name"
                                                class="form-control" readonly required>
                                        </div>
                                        <div class="col-12 col-md-3">
                                            <label class="form-label" for="orders">0rders</label>
                                            {{-- <h6 class="text-body text-nowrap mb-0">Orders: {{ $customer->orders()->count() }}</h6> --}}
                                            <input id="orders" name="orders" class="form-control" readonly>
                                        </div>
                                    </div>
                                </div>
                            @else
                                <div class="card-body">
                                    <div class="d-flex justify-content-between">
                                        <h6>Contact info</h6>
                                        @if ($sale->customer_id == 1)
                                            <h6><a href=" javascript:void(0)" data-bs-toggle="modal"
                                                    data-bs-target="#editUser">Edit</a>
                                            </h6>
                                        @endif
                                    </div>
                                    <div class="row">
                                        <div class="col-12 col-md-7">
                                            <label class="form-label" for="customer_name">Phone Number</label>
                                            <input type="text" id="customer_name" name="customer_name"
                                                class="form-control" readonly value="{{ $sale->customer->name }}">
                                        </div>
                                        <div class="col-12 col-md-3">
                                            <label class="form-label" for="orders">0rders</label>
                                            {{-- <h6 class="text-body text-nowrap mb-0">Orders: {{ $customer->orders()->count() }}</h6> --}}
                                            <input id="orders" name="orders" class="form-control" readonly>
                                        </div>
                                    </div>
                                    <div class="col-md-12 mt-2">
                                        <label class="form-label" for="customer_name">Email</label>
                                        <input type="text" id="customer_name" name="customer_name"
                                            class="form-control" readonly value="{{ $sale->customer->email }}">
                                    </div>
                                </div>
                            @endif
                            <div class="card-footer">
                                <form id="completeSale" class="row g-3" action="{{ route('sales.store') }}"
                                    method="POST">
                                    @csrf
                                    @if ($sale->status == 1)
                                        <div class="d-flex justify-content-center align-items-center">
                                            <div class="form-check form-check-inline">
                                                <input class="form-check-input" type="radio" name="saleType"
                                                    id="cash" value="1" required>
                                                <label class="form-check-label" for="cash">Cash</label>
                                            </div>
                                            <div class="form-check form-check-inline">
                                                <input class="form-check-input" type="radio" name="saleType"
                                                    id="credit" value="2">
                                                <label class="form-check-label" for="credit">Credit</label>
                                            </div>
                                        </div>
                                        <div class="d-flex justify-content-center align-items-center">
                                            <input type="hidden" name="status" id="status" value="2">
                                            <input type="hidden" name="sale_id" id="sale_id"
                                                value={{ $sale_id }}>
                                            <input type="hidden" name="customer_sale_id" id="customer_sale_id">
                                            <button class="m-2 btn btn-success me-sm-3 me-1"
                                                id="addCustomerSubmitButton">Complete
                                                Sale & Save</button>
                                            {{-- <a href="{{ route('sales.receipt', $sale_id) }}" class="m-2 btn btn-info">Print</a> --}}
                                        </div>
                                    @else
                                        <div class="m-3"></div>
                                        <a href="{{ route('sales.receipt', $sale_id) }}" class="m-2 btn btn-info">Print</a>
                                    @endif
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            {{-- Add Customer Modal --}}

            <div class="modal fade" id="addCustomerModal" tabindex="-1" aria-hidden="true">
                <div class="modal-dialog modal-lg modal-simple modal-edit-user">
                    <div class="modal-content p-3 p-md-5">
                        <div class="modal-body">
                            <button type="button" class="btn-close" data-bs-dismiss="modal"
                                aria-label="Close"></button>
                            <div class="text-center mb-4">
                                <h3>Add New Customer</h3>
                                <p>Adding customer details will receive a privacy audit.</p>
                            </div>
                            <form id="addCustomerForm" class="row g-3" action="{{ route('customers.store') }}"
                                method="POST">
                                @csrf
                                <div class="col-12 col-md-12 fv-plugins-icon-container">
                                    <label class="form-label" for="name">Name</label>
                                    <input type="text" id="name" name="name" class="form-control"
                                        placeholder="John Doe">
                                </div>
                                <div class="col-12 col-md-6">
                                    <label class="form-label" for="email">Email</label>
                                    <input type="text" id="email" name="email" class="form-control"
                                        placeholder="example@domain.com">
                                </div>
                                <div class="col-12 col-md-6">
                                    <label class="form-label" for="status">Status</label>
                                    <select id="status" name="status" class="form-select"
                                        aria-label="Default select example">
                                        <option value="1">Active</option>
                                        <option value="2">Inactive</option>
                                        <option value="3">Suspended</option>
                                    </select>
                                </div>
                                <div class="col-12 col-md-6">
                                    <label class="form-label" for="taxID">Tax ID</label>
                                    <input type="text" id="taxID" name="taxID"
                                        class="form-control modal-edit-tax-id" placeholder="123 456 7890">
                                </div>
                                <div class="col-12 col-md-6">
                                    <label class="form-label" for="phone_number">Phone Number</label>
                                    <div class="input-group input-group-merge">
                                        <span class="input-group-text">+254</span>
                                        <input type="text" id="phone_number" name="phone_number"
                                            class="form-control phone-number-mask" placeholder="202 555 0111">
                                    </div>
                                </div>
                                <div class="col-12 text-center mt-3">
                                    <button type="reset" class="btn btn-secondary" data-bs-dismiss="modal"
                                        aria-label="Close">Cancel</button>
                                    <button type="submit" class="btn btn-primary me-sm-3 me-1">Submit</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            {{-- / Add Customer modal --}}

        </div>
        <!-- / Content -->

        <div class="content-backdrop fade"></div>
    </div>
@endsection
