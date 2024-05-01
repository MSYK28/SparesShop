@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Edit Products</h3>
                </div>

                <form action="" id="product-edit-form" method="POST">
                    @csrf
                    <div class="card-body">
                        <div class="form-body">
                            <div class="card mb-5">
                                <div class="card-header">
                                    <h4 class="product-details">Product Details</h4>
                                    <h6>Complete form to add product</h6>
                                    <hr>
                                </div>
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-md-8 p-2">
                                            <label for="" class="form-label">Select Supplier</label>
                                            <select name="supplier" id="supplier" class="form-select">
                                                <option value="{{ $product->supplier }}">{{ $product->supplier }}</option>
                                                @foreach ($suppliers as $supplier)
                                                    <option value="{{ $supplier->id }}">{{ $supplier->name }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="col-md-6 p-2 form-group">
                                            <label for="productTitle" class="form-label">Product Name</label>
                                            <input type="text" class="form-control" name="productTitle"
                                            value = "{{ $product->productTitle }}"    
                                            id="productTitle">
                                        </div>
                                        <div class="col-md-6 p-2">
                                            <label for="" class="form-label">Barcode</label>
                                            <input type="text" class="form-control" name="productBarcode"
                                            value = "{{ $product->productBarcode }}"    
                                            id="productBarcode">
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <hr>
                            <div class="row mt-5">
                                <div class="col-md-6">
                                    <div class="card">
                                        <div class="card-header">
                                            <h4 class="product-details">Product Quantities</h4>
                                            <h6>Complete form to add product</h6>
                                        </div>
                                        <div class="card-body">
                                            <div class="col-md-10 p-2">
                                                <label for="" class="form-label">Quantity</label>
                                                <input type="text" class="form-control" name="quantity" 
                                                value = "{{ $product->quantity }}"
                                                id="quantity">
                                            </div>
                                            <div class="col-md-10 p-2">
                                                <label for="" class="form-label">Reorder Quantity</label>
                                                <input type="text" class="form-control" name="reorderQty"
                                                value = "{{ $product->reorderQty }}"    
                                                id="reorderQty">
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="card">
                                        <div class="card-header">
                                            <h4 class="product-details">Product Price</h4>
                                            <h6>Complete form to add product</h6>
                                        </div>
                                        <div class="card-body">
                                            <div class="col-md-10 p-2">
                                                <label for="" class="form-label">Buying Price</label>
                                                <input type="text" class="form-control" name="productBuyingPrice"
                                                value = "{{ $product->productBuyingPrice }}"    
                                                id="productBuyingPrice">
                                            </div>
                                            <div class="col-md-10 p-2">
                                                <label for="" class="form-label">Selling Price</label>
                                                <input type="text" class="form-control" name="productPrice"
                                                value = "{{ $product->productPrice }}"    
                                                id="productPrice">
                                            </div>
                                            <div class="col-md-10 p-2">
                                                <label for="" class="form-label">Discounted Price</label>
                                                <input type="text" class="form-control" name="productDiscountedPrice"
                                                value = "{{ $product->productDiscountedPrice }}"    
                                                id="productDiscountedPrice">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="card-footer m-3">
                        <input type="hidden" name="productId" value="{{ $product->id }}" id="productId">
                        <button class="btn btn-md btn-success m-2" type="submit">Save Edited Product</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

@endsection
