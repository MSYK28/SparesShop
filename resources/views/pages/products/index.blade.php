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
                        <form action="{{ route('products.import-csv') }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <div class="form-group">
                                <label for="file" class="form-label">Import CSV</label>
                                <input type="file" name="file" class="form-control-file form-control" id="file" required>
                            </div>
                            <button type="submit" class="btn btn-sm btn-primary mt-2">Import Products</button>
                        </form>
                        <a href="{{ route('products.create') }}" class="btn btn-sm m-2 btn-primary">Add Products</a>
                    </div>

                    <div class="card-body">
                        <table id="products-table" class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Name</th>
                                    <th>Barcode</th>
                                    <th>Quantity</th>
                                    <th>Price</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($products as $product)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $product->productTitle }}</td>
                                        <td>{{ $product->productBarcode }}</td>
                                        <td>{{ $product->quantity }}</td>
                                        <td>{{ number_format($product->productPrice, 2) }}</td>
                                        <td>
                                            <a href="{{ route('products.edit', $product->id) }}"
                                                class="btn btn-sm btn-primary mr-2"><i class="fas fa-edit"></i> Edit</a>
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
