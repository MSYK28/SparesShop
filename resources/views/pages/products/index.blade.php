@extends('layouts.app')

@section('content')
<div class="container">
    <div class="container mb-3">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb bg-transparent mb-1 pb-1 pt-1 px-0 me-sm-6 me-5">
                <li class="breadcrumb-item text-sm">
                    <a class="opacity-5 text-dark" href="javascript:;">Products</a>
                </li>
                <li class="breadcrumb-item text-sm text-dark active text-capitalize" aria-current="page">
                    Products List
                </li>
            </ol>
            <h6 class="font-weight-bolder mb-0 text-capitalize">List of current Products</h6>
        </nav>
    </div>

    <div class="container ms-3 mt-5">
        <div class="row justify-content-center">
            <div class="card ms-5">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h5 class="card-title">Customers List</h5>
                    <form action="{{ route('products.import-xls') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="form-group">
                            <label for="file" class="form-label">Import Excel</label>
                            <input type="file" name="file" class="form-control-file form-control" id="file"
                                accept=".xlsx,.xls" required>
                        </div>
                        <button type="submit" class="btn btn-sm btn-primary mt-2">Import Products</button>
                    </form>
                    <form action="{{ route('products.import-csv') }}" method="POST" id="import-csv-form"
                        enctype="multipart/form-data">
                        @csrf
                        <div class="form-group">
                            <label for="file" class="form-label">Import CSV</label>
                            <input type="file" name="file" class="form-control-file form-control" id="file" required>
                            <input type="hidden" name="_token" id="token" value="{{ csrf_token() }}">
                        </div>
                        <button type="submit" class="btn btn-sm btn-primary mt-2">Import Products</button>
                    </form>
                    <a href="{{ route('products.create') }}" class="btn btn-sm m-2 btn-primary">Add Products</a>
                </div>

                <div class="card-body">
                    <table id="products-table" class="table table-bordered table-striped">
                        <thead>
                            <tr>
                                <th style="width: 80;">#</th>
                                <th style="width: 254px;">Name</th>
                                <th style="width: 254px;">Barcode</th>
                                <th style="width: 110;">Quantity</th>
                                <th style="width: 110;">Price</th>
                                <th style="width: 110;">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($products as $product)
                            <tr>
                                <form action="{{ route('products.show', $product->id) }}" method="POST" id="showProductInfo">
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $product->productTitle }}</td>
                                    <td>{{ $product->productBarcode }}</td>
                                    <td>{{ $product->quantity }}</td>
                                    <td>{{ number_format($product->productPrice, 2) }}</td>
                                    <td>
                                        <a href="{{ route('products.edit', $product->id) }}"
                                            class="btn btn-sm btn-primary mr-2"><i class="fas fa-edit"></i> Edit</a>
                                        <input type="hidden" name="productId" value="{{ $product->id }}">
                                        <a href=" {{ route('products.show', $product->id) }} "
                                            class="btn btn-sm btn-info" data-bs-toggle="modal" id="showProductInfo"
                                            data-bs-target="#showCustomerDetails">Info</a>
                                    </td>
                                </form>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

{{-- Show Product Details Modal --}}

{{-- / Show Product Details modal --}}
@endsection
