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
                    Create Products
                </li>
            </ol>
            <h6 class="font-weight-bolder mb-0 text-capitalize">Fill form to create new product</h6>
        </nav>
    </div>

    <div class="container ms-3 mt-5">
        <div class="row justify-content-center">
            <card class="card">
                <div class="card-header">
                    <div class="d-flex justify-content-between align-items-center">
                        <h5 class="card-title">Add Products</h5>
                    </div>
                    <p>Complete Form to add a new product</p>
                </div>

                <form action="" id="product-form">
                    @csrf
                    <div class="form-body mt-4">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-8 p-2">
                                    <label for="" class="form-label">Select Supplier</label>
                                    <select name="supplier" id="supplier" class="form-select mySelect">
                                        @foreach ($suppliers as $supplier)
                                        <option value="{{ $supplier->id }}">{{ $supplier->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col-md-6 p-2 form-group">
                                    <label for="productTitle" class="form-label">Product Name</label>
                                    <input type="text" class="form-control" name="productTitle" id="productTitle">
                                </div>
                                <div class="col-md-6 p-2">
                                    <label for="" class="form-label">Barcode</label>
                                    <select name="productBarcode" id="productBarcode" class="form-select">
                                        @foreach ($barcodes as $barcode)
                                        <option value="{{ $barcode->barcode }}">{{ $barcode->barcode }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6 p-2">
                                    <label for="" class="form-label">Quantity</label>
                                    <input type="text" class="form-control" name="quantity" id="quantity">
                                </div>
                                <div class="col-md-6 p-2">
                                    <label for="" class="form-label">Reorder Quantity</label>
                                    <input type="text" class="form-control" name="reorderQty" id="reorderQty">
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-4 p-2">
                                    <label for="" class="form-label">Buying Price</label>
                                    <input type="text" class="form-control" name="productBuyingPrice"
                                        id="productBuyingPrice">
                                </div>
                                <div class="col-md-4 p-2">
                                    <label for="" class="form-label">Selling Price</label>
                                    <input type="text" class="form-control" name="productPrice" id="productPrice">
                                </div>
                                <div class="col-md-4 p-2">
                                    <label for="" class="form-label">Discounted Price</label>
                                    <input type="text" class="form-control" name="productDiscountedPrice"
                                        id="productDiscountedPrice">
                                    <input type="hidden" name="_token" id="token" value="{{ csrf_token() }}">
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="card-footer m-3">
                        <button class="btn btn-md btn-info m-2">Save Draft</button>
                        {{-- <button type="button" class="btn btn-md btn-success m-2" onclick="confirmAddProduct()">Add Product</button> --}}
                        <button class="btn btn-md btn-success m-2" type="submit">Save Product</button>
                    </div>
                </form>
            </card>
        </div>
    </div>

</div>
@endsection
