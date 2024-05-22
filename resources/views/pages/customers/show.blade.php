@extends('layouts.app')

@section('content')
<div class="container">
    <div class="container mb-3">
        <nav aria-label="breadcrumb mb-4">
            <ol class="breadcrumb bg-transparent mb-1 pb-1 pt-1 px-0 me-sm-6 me-5">
                <li class="breadcrumb-item text-sm">
                    <a class="opacity-5 text-dark" href="javascript:;">Customers</a>
                </li>
                <li class="breadcrumb-item text-sm text-dark active text-capitalize" aria-current="page">
                    Show Customers
                </li>
            </ol>
            <h6 class="font-weight-bolder mb-0 text-capitalize">Information about <span
                    class="supplier_name">{{ $customer->name }}</span></h6>
        </nav>
    </div>


    <div class="container ms-3 mt-5">
        <div class="row justify-content-center">
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
                <div class="tab-pane fade show active" id="home-tab-pane" role="tabpanel" aria-labelledby="home-tab"
                    tabindex="0">
                    <div class="cards mt-3">
                        <div class="card-header">
                            <div class="card-title">
                                <h6><span class="supplier_name">{{ $customer->name }}</span> Information</h6>
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
                                    <input type="text" class="form-control" value="{{ $customer->email }}" disabled>
                                </div>
                                <div class="col-sm-4">
                                    <label for="" class="form-label">Phone Number</label>
                                    <input type="text" class="form-control" value="{{ $customer->phone_number }}"
                                        disabled>
                                </div>
                                <div class="col-sm-4">
                                    <label for="" class="form-label">Tax ID</label>
                                    <input type="text" class="form-control" value="{{ $customer->taxID }}" disabled>
                                </div>
                            </div>

                            <hr>
                            <div class="table-title my-3">
                                <h6>Credit Sales to {{ $customer->name }}</h6>
                            </div>
                            <table id="products-table" class="table table-bordered table-striped table-responsive">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Sale Code</th>
                                        <th>Total</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($sales as $sale)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $sale->sale_code }}</td>
                                        <td>{{ number_format($sale->total, 2) }}</td>
                                        <td>
                                            <a href="{{ route('sales.show', $sale->id) }}"
                                                class="btn btn-sm btn-primary mr-2"><i class="fas fa-edit"></i> View</a>
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                                <tfoot>
                                    <tr>
                                        <td colspan="2"><strong>Total</strong></td>
                                        <td colspan="1"><strong>{{ number_format($total, 2) }}</strong></td>
                                        <td></td>
                                    </tr>
                                    <tr>
                                        <td colspan="2">Amount Paid</td>
                                        <td>{{ number_format($balance, 2) }}</td>
                                        <td>
                                            <button class="btn btn-sm btn-success" data-bs-toggle="modal"
                                                data-bs-target="#addCustomerModal">Transact</button>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td colspan="2">Balance</td>
                                        <td><strong>{{ number_format($total - $balance, 2) }}</strong></td>
                                        <td>
                                        </td>
                                    </tr>
                                </tfoot>
                            </table>
                        </div>
                    </div>
                </div>
                <div class="tab-pane fade" id="profile-tab-pane" role="tabpanel" aria-labelledby="profile-tab"
                    tabindex="0">
                    <div class="cards mt-3">
                        <div class="card-header mb-4">
                            <div class="card-title">
                                <h6>Transaction History <span class="supplier_name">{{ $customer->name }}</span></h6>
                            </div>
                        </div>
                        <div class="card-body">
                            <table class="table table-bordered table-striped" id="transactions-table">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Transaction Date</th>
                                        <th>Mpesa Code</th>
                                        <th>Amount</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($transactions as $transaction)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $transaction->created_at }}</td>
                                        <td>{{ $transaction->mpesa_code }}</td>
                                        <td>{{ number_format($transaction->amount, 2) }}</td>
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

<div class="modal fade" id="addCustomerModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-simple modal-edit-user">
        <div class="modal-content p-3 p-md-5">
            <div class="modal-body">
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                <div class="text-center mb-4">
                    <h3>Add Payment</h3>
                    <p>Adding details to make payment.</p>
                </div>
                <form id="PaymentForm" class="row g-3" action="{{ route('customers.transactions') }}" method="POST">
                    @csrf
                    <div class="col-12 col-md-12 fv-plugins-icon-container">
                        <label class="form-label" for="name">Name</label>
                        <input type="text" id="name" name="name" class="form-control" placeholder="John Doe" readonly
                            value="{{ $customer->name }}">
                        <input type="hidden" name="customer_id" id="customer_id" value="{{ $customer->id }}">
                    </div>
                    <div class="col-12 col-md-6">
                        <label class="form-label" for="mpesa_code">Mpesa Code</label>
                        <input type="text" id="mpesa_code" name="mpesa_code" class="form-control"
                            placeholder="PSHFH293">
                    </div>
                    <div class="col-12 col-md-6">
                        <label class="form-label" for="amount">Amount</label>
                        <input type="number" id="amount" name="amount" class="form-control modal-edit-tax-id"
                            placeholder="1000">
                        <input type="hidden" name="_token" id="token" value="{{ csrf_token() }}">
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
@endsection
