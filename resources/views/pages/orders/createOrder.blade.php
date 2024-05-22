@extends('layouts.app')

@section('content')
<div class="container">
    <div class="container mb-2">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb bg-transparent mb-1 pb-1 pt-1 px-0 me-sm-6 me-5">
                <li class="breadcrumb-item text-sm">
                    <a class="opacity-5 text-dark" href="javascript:;">Orders</a>
                </li>
                <li class="breadcrumb-item text-sm text-dark active text-capitalize" aria-current="page">
                    Create Order
                </li>
            </ol>
            <h6 class="font-weight-bolder mb-0 text-capitalize">New Order</h6>
        </nav>
    </div>

    <div class="container ms-3 mt-4">
        <div class="row">
            <div class="col-md-6">
                <div class="card ms-5">
                    <div class="card-header">
                        <div class="card-title">
                            <h6>Products currently in Stock</h6>
                            <p>Click '+' to add to order basket</p>
                        </div>
                    </div>
                    <div class="card-body">
                        <table id="products-table" class="table table-bordered table-striped table-responsive">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Name</th>
                                    <th>Quantity</th>
                                    <th>Stock</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($products as $product)
                                <tr>
                                    <form action="{{ route('orders.add-to-basket') }}" method="POST"
                                        id="add-to-basket-form">
                                        @csrf
                                        <td>{{ $loop->iteration }}</td>
                                        <td width="">{{ $product->productTitle }}</td>
                                        <td width="">
                                            <input style="width: 100px;" class="form-control" type="number"
                                                name="quantity" value="1" min="1">
                                        </td>
                                        <td width="">
                                            <input style="width: 100px;" class="form-control" type="hidden" name="price"
                                                value="{{ $product->quantity }}">
                                            <input style="width: 100px;" class="form-control" type="number" name="price"
                                                value="{{ $product->quantity }}" readonly>
                                        </td>
                                        <td width="">
                                            <input type="hidden" name="productId" value="{{ $product->id }}">
                                            <input type="hidden" name="supplier_id" id="supplier_id"
                                                value="{{ $supplier->id }}">
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
                        <form action="{{ route('orders.empty-basket') }}" method="POST" id="empty-basket-form">
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
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <form action="{{ route('orders.purchase') }}" method="POST" id="order-form">
                                @csrf
                                <tbody>
                                    @foreach ($basket as $item)
                                    <tr>
                                        <td>{{ $item['name'] }}
                                            <input type="hidden" value="{{ $item['id'] }}" name="productId[]" id="product_id">
                                        </td>
                                        <td>{{ $item['quantity'] }}
                                            <input type="hidden" value="{{ $item['quantity'] }}" name="quantity[]">
                                        </td>
                                        <td>
                                            <button type="submit" class="btn btn-danger"
                                                id="remove-from-basket-button">Remove</button>
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                                <tfoot>
                                    <tr>
                                        <td colspan="2"></td>
                                        <td colspan="1">
                                            <input type="hidden" name="supplier_id" id="supplier_id"
                                                value="{{ $supplier->id }}">
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
