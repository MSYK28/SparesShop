@extends('layouts.app')

@section('content')
@if (Session::has('error'))
<div class="alert alert-warning alert-dismissible fade show d-flex align-items-center" role="alert">
    <strong> {{ Session::get('error') }} </strong>
    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
</div>
@endif

<div class="container">
    <div class="container mb-2">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb bg-transparent mb-1 pb-1 pt-1 px-0 me-sm-6 me-5">
                <li class="breadcrumb-item text-sm">
                    <a class="opacity-5 text-dark" href="javascript:;">Pages</a>
                </li>
                <li class="breadcrumb-item text-sm text-dark active text-capitalize" aria-current="page">
                    dashboard
                </li>
            </ol>
            <h6 class="font-weight-bolder mb-0 text-capitalize">dashboard</h6>
        </nav>
    </div>

    <div class="conatiner ms-3 mt-4">
        <div class="row">
            <div class="col-md-6">
                <div class="card ms-5">
                    <div class="card-header">
                        <div class="card-title">
                            <div class="row">
                                <div class="col-sm-6">
                                    <h6>Products currently in Stock</h6>
                                    <p>Click '+' to add to cart</p>
                                </div>
                                <div class="col-sm-6">
                                    <a href="{{ route('products.create') }}" class="btn btn-primary mt-2">Add New Product</a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        <table id="products-table" class="table table-bordered table-striped table-responsive">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Name</th>
                                    <th>Quantity</th>
                                    <th>Price</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($products as $product)
                                <tr>
                                    <form action="{{ route('products.add-to-cart') }}" method="POST"
                                        id="add-to-cart-form">
                                        @csrf
                                        <td>{{ $loop->iteration }}</td>
                                        <td width="">{{ $product->productTitle }}</td>
                                        <td width="">
                                            <input style="width: 100px;" class="form-control" type="number"
                                                name="quantity" value="1" min="1">
                                        </td>
                                        <td width="">
                                            <input style="width: 100px;" class="form-control" type="number" name="price"
                                                value="{{ $product->productPrice }}">
                                        </td>
                                        <td width="">
                                            <input type="hidden" name="productId" value="{{ $product->id }}">
                                            <button type="submit" class="btn btn-primary">
                                                <i class='bx bx-plus-medical'></i>
                                            </button>
                                        </td>
                                    </form>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="card">
                    <div class="card-header">
                        <div class="card-title"></div>
                        <form action="{{ route('products.empty-cart') }}" method="POST" id="empty-cart-form">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger">Empty Cart</button>
                        </form>
                    </div>
                    <div class="card-body">
                        <table class="table table-responsive table-bordered table-striped" id="product-table">
                            <thead>
                                <tr>
                                    <th>Product Name</th>
                                    <th>Quantity</th>
                                    <th>Price</th>
                                    <th>Total</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <form action="{{ route('products.purchase') }}" method="POST" id="sale-form">
                                @csrf
                                <tbody>
                                    @foreach ($cart as $item)
                                    <tr>
                                        <td>{{ $item['name'] }}
                                            <input type="hidden" value="{{ $item['id'] }}" name="productId[]" id="productId">
                                        </td>
                                        <td>{{ $item['quantity'] }}
                                            <input type="hidden" value="{{ $item['quantity'] }}" name="quantity[]">
                                        </td>
                                        <td>{{ $item['price'] }}
                                            <input type="hidden" value="{{ $item['price'] }}" name="price[]">
                                        </td>
                                        <td>{{ $item['quantity'] * $item['price'] }}</td>
                                        <td>
                                            {{-- <a href="{{ route('products.remove-from-cart', $item['id']) }}" class="btn btn-danger">Remove from cart</a> --}}
                                            <a type="submit" class="btn btn-danger remove-from-cart-button"
                                                id="remove-from-cart-button"  data-id="{{ $item['id'] }}">Remove</a>
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                                <tfoot>
                                    <tr>
                                        <td colspan="3">Subtotal</td>
                                        <td colspan="1">{{ number_format($total, 2) }}</td>
                                        <td colspan="1">
                                            <input type="hidden" name="_token" id="token" value="{{ csrf_token() }}">
                                            <button type="submit" class="btn btn-success complete-purchase"
                                                id="complete-purchase">Complete</button>
                                        </td>
                                    </tr>
                                </tfoot>
                            </form>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
