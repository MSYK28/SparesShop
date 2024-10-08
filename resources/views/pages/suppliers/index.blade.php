@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="container mb-3">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb bg-transparent mb-1 pb-1 pt-1 px-0 me-sm-6 me-5">
                    <li class="breadcrumb-item text-sm">
                        <a class="opacity-5 text-dark" href="javascript:;">Suppliers</a>
                    </li>
                    <li class="breadcrumb-item text-sm text-dark active text-capitalize" aria-current="page">
                        Suppliers List
                    </li>
                </ol>
                <h6 class="font-weight-bolder mb-0 text-capitalize">List of current suppliers</h6>
            </nav>
        </div>

        <div class="container ms-3 mt-5">
            <div class="row justify-content-center ">
                <div class="card ms-5">
                    <div class="card-header d-flex justify-content-between align-items-center">
                        <h5 class="card-title">Suppliers List</h5>
                        <a href=" javascript:void(0)" class="btn m-2 btn-primary" data-bs-toggle="modal"
                            data-bs-target="#addCustomerModal">New Supplier</a>
                    </div>
                    <div class="card-body">
                        <table id="products-table" class="table table-responsive table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th style="width: 30px;">#</th>
                                    <th style="width: 240px;">Name</th>
                                    <th style="width: 120px;">Code</th>
                                    <th style="width: 120px;">Email</th>
                                    <th style="width: 120px;">Tax ID</th>
                                    <th style="width: 120px;">Phone Number</th>
                                    <th style="width: 80px;">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($suppliers as $supplier)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $supplier->name }}</td>
                                        <td>{{ $supplier->code }}</td>
                                        <td>{{ $supplier->email }}</td>
                                        <td>{{ $supplier->taxID }}</td>
                                        <td>{{ $supplier->phone_number }}</td>
                                        <td>
                                            <a href="{{ route('suppliers.edit', $supplier->id) }}"
                                                class="btn btn-sm btn-primary mr-2"><i class="fas fa-edit"></i> Edit</a>
                                            <a href="{{ route('suppliers.show', $supplier->id) }}"
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


    {{-- Add Supplier Modal --}}

    <div class="modal fade" id="addCustomerModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-lg modal-simple modal-edit-user">
            <div class="modal-content p-3 p-md-5">
                <div class="modal-body">
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    <div class="text-center mb-4">
                        <h3>Add New Supplier</h3>
                        <p>Adding supplier details will receive a privacy audit.</p>
                    </div>
                    <form id="addSupplierForm" class="row g-3">
                        @csrf
                        <div class="col-12 col-md-12 fv-plugins-icon-container">
                            <label class="form-label" for="name">Name</label>
                            <input type="text" id="name" name="name" class="form-control" placeholder="John Doe">
                        </div>
                        <div class="col-12 col-md-12 fv-plugins-icon-container">
                            <label class="form-label" for="code">Code</label>
                            <input type="text" id="code" name="code" class="form-control" placeholder="CG">
                        </div>
                        <div class="col-12 col-md-6">
                            <label class="form-label" for="email">Email</label>
                            <input type="text" id="email" name="email" class="form-control"
                                placeholder="example@domain.com">
                        </div>
                        <div class="col-12 col-md-6">
                            <label class="form-label" for="status">Status</label>
                            <select id="status" name="status" class="form-select">
                                <option value="1">Active</option>
                                <option value="2">Inactive</option>
                                <option value="3">Suspended</option>
                            </select>
                        </div>
                        <div class="col-12 col-md-6">
                            <label class="form-label" for="taxID">Tax ID</label>
                            <input type="text" id="taxID" name="taxID" class="form-control modal-edit-tax-id"
                                placeholder="123 456 7890">
                        </div>
                        <div class="col-12 col-md-6">
                            <label class="form-label" for="phone_number">Phone Number</label>
                            <div class="input-group input-group-merge">
                                <span class="input-group-text">+254</span>
                                <input type="text" id="phone_number" name="phone_number"
                                    class="form-control phone-number-mask" placeholder="202 555 0111">
                            </div>
                        </div>
                        <div class="col-12 col-md-12 fv-plugins-icon-container">
                            <label class="form-label" for="bank_name">Bank Account Name</label>
                            <input type="text" id="bank_name" name="bank_name" class="form-control"
                                placeholder="This Bank Account">
                        </div>
                        <div class="col-12 col-md-6">
                            <label class="form-label" for="bank">Bank</label>
                            <input type="text" id="bank" name="bank" class="form-control"
                                placeholder="ABC Bank">
                        </div>
                        <div class="col-12 col-md-6">
                            <label class="form-label" for="bank_account">Bank Account Number</label>
                            <input type="text" id="bank_account" name="bank_account" class="form-control"
                                placeholder="1111 2222 3333 4444">
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
    {{-- / Add Customer modal --}}
@endsection
