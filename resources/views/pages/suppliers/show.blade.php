@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="container mb-3">
            <nav aria-label="breadcrumb mb-4">
                <ol class="breadcrumb bg-transparent mb-1 pb-1 pt-1 px-0 me-sm-6 me-5">
                    <li class="breadcrumb-item text-sm">
                        <a class="opacity-5 text-dark" href="javascript:;">Suppliers</a>
                    </li>
                    <li class="breadcrumb-item text-sm text-dark active text-capitalize" aria-current="page">
                        Show Suppliers
                    </li>
                </ol>
                <h6 class="font-weight-bolder mb-0 text-capitalize">Information about <span
                        class="supplier_name">{{ $supplier->name }}</span></h6>
            </nav>
        </div>

        <div class="container ms-3 mt-5">
            <div class="row justify-content-center">
                <div class="card ms-5">
                    <div class="card-header">
                        <div class="d-flex justify-content-between align-items-center">
                            <h5 class="card-title">Supplier Profile</h5>
                        </div>
                        <p>Navigate between Tabs for more information</p>
                    </div>
                    <div class="card-body">
                        <ul class="nav nav-tabs" id="myTab" role="tablist">
                            <li class="nav-item" role="presentation">
                                <button class="nav-link active" id="home-tab" data-bs-toggle="tab"
                                    data-bs-target="#home-tab-pane" type="button" role="tab"
                                    aria-controls="home-tab-pane" aria-selected="true">Profile</button>
                            </li>
                            <li class="nav-item" role="presentation">
                                <button class="nav-link" id="profile-tab" data-bs-toggle="tab"
                                    data-bs-target="#profile-tab-pane" type="button" role="tab"
                                    aria-controls="profile-tab-pane" aria-selected="false">Orders</button>
                            </li>
                            <li class="nav-item" role="presentation">
                                <button class="nav-link" id="contact-tab" data-bs-toggle="tab"
                                    data-bs-target="#contact-tab-pane" type="button" role="tab"
                                    aria-controls="contact-tab-pane" aria-selected="false">Accounts</button>
                            </li>
                        </ul>
                        <div class="tab-content" id="myTabContent">
                            <div class="tab-pane fade show active" id="home-tab-pane" role="tabpanel"
                                aria-labelledby="home-tab" tabindex="0">
                                <card>
                                    <div class="card-header">
                                        <div class="card-title">
                                            <h6 class="supplier_name">{{ $supplier->name }}</h6>
                                        </div>
                                    </div>
                                    <div class="card-body">
                                        <div class="row my-4">
                                            <div class="group-title">
                                                <h6>Basic Information</h6>
                                                <p></p>
                                            </div>
                                            <div class="col-sm-4">
                                                <label for="" class="form-label">Email</label>
                                                <input type="text" class="form-control" value="{{ $supplier->email }}"
                                                    disabled>
                                            </div>
                                            <div class="col-sm-4">
                                                <label for="" class="form-label">Phone Number</label>
                                                <input type="text" class="form-control"
                                                    value="{{ $supplier->phone_number }}" disabled>
                                            </div>
                                            <div class="col-sm-4">
                                                <label for="" class="form-label">Tax ID</label>
                                                <input type="text" class="form-control" value="{{ $supplier->taxID }}"
                                                    disabled>
                                            </div>
                                        </div>

                                        <div class="row mt-5">
                                            <div class="group-title">
                                                <h6>Account Information</h6>
                                                <p></p>
                                            </div>
                                            <div class="col-sm-4">
                                                <label for="" class="form-label">Bank Name</label>
                                                <input type="text" class="form-control" value="{{ $supplier->bank }}"
                                                    disabled>
                                            </div>
                                            <div class="col-sm-4">
                                                <label for="" class="form-label">Bank Account Name</label>
                                                <input type="text" class="form-control"
                                                    value="{{ $supplier->bank_name }}" disabled>
                                            </div>
                                            <div class="col-sm-4">
                                                <label for="" class="form-label">Bank Account Number</label>
                                                <input type="text" class="form-control"
                                                    value="{{ $supplier->bank_account }}" disabled>
                                            </div>
                                        </div>
                                    </div>
                                </card>
                            </div>
                            <div class="tab-pane fade" id="profile-tab-pane" role="tabpanel"
                                aria-labelledby="profile-tab" tabindex="0">
                                <div class="cards mt-3">
                                    <div class="card-header d-flex justify-content-between align-items-center">
                                        <h6 class="card-title">Orders for <span
                                                class="supplier_name">{{ $supplier->name }}</span></h6>
                                        <a href="{{ route('orders.createOrder', $supplier->id) }}"
                                            class="btn btn-sm m-2 btn-primary">New
                                            Order</a>
                                    </div>
                                    <div class="card-body">
                                        <table class="table table-responsive table-bordered table-striped"
                                            id="products-table">
                                            <thead>
                                                <tr>
                                                    <th style="width: 30px;">#</th>
                                                    <th style="width: 310px;">Order ID</th>
                                                    <th style="width: 170px;">Order Date</th>
                                                    <th style="width: 120px;">Total</th>
                                                    <th style="width: 12px;">Status</th>
                                                    <th style="width: 80px;">Action</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach ($orders as $order)
                                                    <tr>
                                                        <td>{{ $loop->iteration }}</td>
                                                        <td>{{ $order->orderCode }}</td>
                                                        <td>{{ date('F d, Y', strtotime($order->created_at)) }}</td>
                                                        <td>{{ number_format($order->total, 2) }}</td>
                                                        <td>
                                                            @if ($order->status == 1)
                                                                <span class="badge bg-primary">Pending Delivery</span>
                                                            @else
                                                                <span class="badge bg-success">Delivered</span>
                                                            @endif
                                                        </td>
                                                        <td>
                                                            <a href="{{ route('orders.show', $order->id) }}"
                                                                class="btn btn-sm btn-info mr-2"><i
                                                                    class="fas fa-edit"></i> View</a>
                                                        </td>
                                                    </tr>
                                                @endforeach
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                            <div class="tab-pane fade" id="contact-tab-pane" role="tabpanel"
                                aria-labelledby="contact-tab" tabindex="0">
                                <div class="cards mt-3">
                                    <div class="card-header d-flex justify-content-between align-items-center">
                                        <h6 class="card-title">Account history for <span
                                                class="supplier_name">{{ $supplier->name }}</span></h6>
                                    </div>
                                    <div class="card-body">
                                        <table class="table table-responsive table-bordered table-striped"
                                            id="products-table">
                                            <thead>
                                                <tr>
                                                    <th style="width: 30px;">#</th>
                                                    <th style="width: 290px;">Transaction ID</th>
                                                    <th style="width: 150px;">Transaction Type</th>
                                                    <th style="width: 140px;">Date</th>
                                                    <th style="width: 140px;">Total</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach ($accounts as $account)
                                                    <tr>
                                                        <td>{{ $loop->iteration }}</td>
                                                        <td>
                                                            @if ($account->transaction_type == 1)
                                                                {{ $account->transaction_id }}</td>
                                                            @else
                                                                {{ $account->cheque_number }}</td>
                                                            @endif
                                                        <td>
                                                            @if ($account->transaction_type == 1)
                                                                <span class="badge bg-primary">Invoice</span>
                                                            @else
                                                                <span class="badge bg-success">Payment</span>
                                                            @endif
                                                        </td>
                                                        <td>{{ date('F d, Y', strtotime($account->created_at)) }}</td>
                                                        <td>{{ number_format($account->amount, 2) }}</td>
                                                    </tr>
                                                @endforeach
                                            </tbody>
                                            <tfoot>
                                                <tr>
                                                    <td colspan="3">
                                                        <strong>Total</strong>
                                                    </td>
                                                    <td colspan="1">
                                                        {{ number_format($balance, 2) }}
                                                    </td>
                                                    <td colspan="1">
                                                        <h6 class="m-0"><a href=" javascript:void(0)" data-bs-toggle="modal"
                                                            data-bs-target="#addCustomerModal" class="btn btn-success me-sm-3 me-1">Transact</a></h6>
                                                        
                                                    </td>
                                                </tr>
                                            </tfoot>
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

    {{-- TRANSACTION MODAL --}}
    <div class="modal fade" id="addCustomerModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-lg modal-simple modal-edit-user">
            <div class="modal-content p-3 p-md-5">
                <div class="modal-body">
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    <div class="text-center mb-4">
                        <h3>Make Transaction</h3>
                        <p>Fill form to make a transaction.</p>
                    </div>
                    <form id="paySupplierForm" class="row g-3" action="{{ route('suppliers.transact') }}" method="POST">
                        @csrf
                        <div class="row">
                            <div class="col-sm-6">
                                <label for="" class="form-label">Cheque Number</label>
                                <input type="text" class="form-control" name="cheque_number" required id="cheque_number"
                                placeholder="01100 4000 5000">
                            </div>
                            <div class="col-sm-6">
                                <label for="" class="form-label">Amount</label>
                                <input type="text" class="form-control" name="amount" required id="amount">
                                <input type="hidden" name="supplier_id" id="supplier_id" value="{{ $supplier->id }}">
                            </div>
                        </div>
                        <div class="col-12 text-center mt-3">
                            <input type="hidden" name="_token" id="token" value="{{ csrf_token() }}">
                            <button type="reset" class="btn btn-secondary" data-bs-dismiss="modal"
                                aria-label="Close">Cancel</button>
                            <button type="submit" class="btn btn-primary me-sm-3 me-1">Submit</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    {{-- / Receive Goods modal --}}
@endsection
