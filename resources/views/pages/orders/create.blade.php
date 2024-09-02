@extends('layouts.app')

@section('content')
<div class="container">
    <div class="container mb-3">
        <nav aria-label="breadcrumb mb-4">
            <ol class="breadcrumb bg-transparent mb-1 pb-1 pt-1 px-0 me-sm-6 me-5">
                <li class="breadcrumb-item text-sm">
                    <a class="opacity-5 text-dark" href="javascript:;">Orders</a>
                </li>
                <li class="breadcrumb-item text-sm text-dark active text-capitalize" aria-current="page">
                    Low Stock
                </li>
            </ol>
            <h6 class="font-weight-bolder mb-0 text-capitalize">Products that are in low quantities</h6>
        </nav>
    </div>

    <div class="container ms-3 mt-5">
        <div class="row justify-content-center">
            <div class="card ms-5">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h5 class="card-title">Low stocks Product List</h5>
                </div>

                <div class="card-body">
                    <table id="products-table" class="table table-bordered table-striped">
                        <thead>
                            <tr>
                                <th style="width: 40;">#</th>
                                <th style="width: 254px;">Name</th>
                                <th style="width: 254px;">Supplier</th>
                                <th style="width: 254px;">Barcode</th>
                                <th style="width: 110;">Quantity</th>
                                <th style="width: 110;">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($low_stocks as $low_stock)
                                @if ($low_stock->quantity > $low_stock->reorderQty)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $low_stock->productTitle }}</td>
                                    <td>{{ $low_stock->suppliers->name }}</td>
                                    <td>{{ $low_stock->productBarcode }}</td>
                                    <td>{{ $low_stock->quantity }}</td>
                                    <td></td>
                                </tr>
                                @endif
                            @endforeach
                        </tbody>
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
    <button type="submit" class="btn btn-danger" id="remove-from-cart-button">Remove</button>
</td>
</tr>
@endforeach --}}
