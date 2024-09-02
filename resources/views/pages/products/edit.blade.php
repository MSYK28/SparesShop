@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="container mb-3">
            <nav aria-label="breadcrumb mb-4">
                <ol class="breadcrumb bg-transparent mb-1 pb-1 pt-1 px-0 me-sm-6 me-5">
                    <li class="breadcrumb-item text-sm">
                        <a class="opacity-5 text-dark" href="javascript:;">Products</a>
                    </li>
                    <li class="breadcrumb-item text-sm text-dark active text-capitalize" aria-current="page">
                        Edit Products
                    </li>
                </ol>
                <h6 class="font-weight-bolder mb-0 text-capitalize">Edit Products</h6>
            </nav>
        </div>

        <div class="container ms-3 mt-5">
            <div class="row justify-content-center">
                <div class="card ms-5">
                    <div class="card-header">
                        <div class="d-flex justify-content-between align-items-center">
                            <h5 class="card-title">Edit <span class="supplier_name">{{ $product->productTitle }}</span></h5>
                        </div>
                    </div>
    
                    <form action="" id="product-edit-form" method="POST">
                        @csrf
                        <div class="form-body mt-4">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-8 p-2">
                                        <label for="" class="form-label">Select Supplier</label>
                                        <select name="supplier" id="supplier" class="form-select mySelect">
                                            @foreach ($suppliers as $supplier)
                                                <option value="{{ $product->suppliers->id }}" selected>{{ $product->suppliers->name }}</option>
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
                                <div class="row">
                                    <div class="col-md-6 p-2">
                                        <label for="" class="form-label">Quantity</label>
                                        <input type="text" class="form-control" name="quantity"
                                        value = "{{ $product->quantity }}"
                                        id="quantity">
                                    </div>
                                    <div class="col-md-6 p-2">
                                        <label for="" class="form-label">Reorder Quantity</label>
                                        <input type="text" class="form-control" name="reorderQty"
                                        value = "{{ $product->reorderQty }}"    
                                            id="reorderQty">
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-4 p-2">
                                        <label for="" class="form-label">Buying Price</label>
                                        <input type="text" class="form-control" name="productBuyingPrice"
                                        value = "{{ $product->productBuyingPrice }}"    
                                            id="productBuyingPrice">
                                    </div>
                                    <div class="col-md-4 p-2">
                                        <label for="" class="form-label">Selling Price</label>
                                        <input type="text" class="form-control" name="productPrice"
                                        value = "{{ $product->productPrice }}"    
                                            id="productPrice">
                                    </div>
                                    <div class="col-md-4 p-2">
                                        <label for="" class="form-label">Discounted Price</label>
                                        <input type="text" class="form-control" name="productDiscountedPrice"
                                        value = "{{ $product->productDiscountedPrice }}"    
                                            id="productDiscountedPrice">
                                        <input type="hidden" name="_token" id="token" value="{{ csrf_token() }}">
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
    </div>

@endsection
