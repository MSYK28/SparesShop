@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-sm-6">
                <div class="card">
                    <div class="card-header">
                        <div class="row">
                            <div class="col-sm-12 form-group">
                                <label for="supplier_id" class="form-label">Select Supplier</label>
                                <select name="supplier_id" id="supplier_id" class="form-control">
                                    <option value="">Supplier</option>
                                    @foreach ($suppliers as $supplier)
                                        <option value="{{ $supplier->id }}">{{ $supplier->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        <table class="table table-bordered table-striped" id="">
                            <thead>
                                <tr>
                                    <th>Product Name</th>
                                    <th>Product Code</th>
                                    <th>Quantity</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody id="all-supplier-stock-order-table">
                                
                            </tbody>
                        </table>

                        <div class="cart-num-items">
                            <span id="cart-num-items">0</span>
                            <span>Items in Cart</span>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-sm-6">
                <div class="card">
                    <div class="card-header">
                        <button class="btn btn-danger empty-cart-btn">Empty Cart</button>
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
                            <form action="{{ route('orders.store') }}" method="POST">
                                @csrf
                                <tbody id="product-orders-table">
                                    
                                    <tr>
                                        <td colspan="1">Count</td>
                                        <td colspan="1">{{ $total }}</td>
                                        <td colspan="1">
                                            <button type="submit" class="btn btn-success complete-purchase"
                                                id="complete-purchase">Complete</button>
                                        </td>
                                    </tr>
                                </tbody>
                            </form>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

{{-- @foreach ($basket as $item)
<tr>
    <td>{{ $item['name'] }}
        <input type="hidden" value="{{ $item['id'] }}" name="productId[]">
    </td>
    <td>{{ $item['quantity'] }}
        <input type="hidden" value="{{ $item['quantity'] }}" name="quantity[]">
    </td>
    <td>
        <button type="submit" class="btn btn-danger"
            id="remove-from-cart-button">Remove</button>
    </td>
</tr>
@endforeach --}}