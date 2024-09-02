@extends('layouts.app')

@section('content')
<div class="container">
    <div class="container mb-3">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb bg-transparent mb-1 pb-1 pt-1 px-0 me-sm-6 me-5">
                <li class="breadcrumb-item text-sm">
                    <a class="opacity-5 text-dark" href="javascript:;">Profile</a>
                </li>
                <li class="breadcrumb-item text-sm text-dark active text-capitalize" aria-current="page">
                    Profile List
                </li>
            </ol>
            <h6 class="font-weight-bolder mb-0 text-capitalize">User Profile Settings</h6>

            <div class="container">
                <div class="row mt-5">
                    <div class="col-sm-4">
                        <div class="card">
                            <div class="card-header">
                                <div class="card-title">Barcodes
                                    <a href=" javascript:void(0)" class="btn m-2 btn-primary" data-bs-toggle="modal"
                                        data-bs-target="#addCodeModal">New Code</a>
                                </div>
                            </div>
                            <div class="card-body">
                                <table class="table table-responsive table-bordered">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>Company</th>
                                            <th>Part</th>
                                            <th>Code</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($barcodes as $barcode)
                                        <tr>
                                            <td>{{ $loop->iteration }}</td>
                                            <td>{{ $barcode->company }}</td>
                                            <td>{{ $barcode->part }}</td>
                                            <td>{{ $barcode->barcode }}</td>
                                        </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-4"></div>
                    <div class="col-sm-4"></div>
                </div>
            </div>
        </nav>
    </div>


</div>
{{-- Add Customer Modal --}}
<div class="modal fade" id="addCodeModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-simple modal-edit-user">
        <div class="modal-content p-3 p-md-5">
            <div class="modal-body">
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                <div class="text-center mb-4">
                    <h3>Add New Code</h3>
                </div>
                <form id="addCodeForm" class="row g-3" action="{{ route('profile.store') }}" method="POST">
                    @csrf
                    <div class="col-12 col-md-6">
                        <label class="form-label" for="company">Company</label>
                        <select id="company" name="company" class="form-select" aria-label="Default select example">
                            @foreach ($suppliers as $supplier)
                            <option value="{{ $supplier->code }}">{{ $supplier->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-12 col-md-6">
                        <label class="form-label" for="part">Part</label>
                        <select id="part" name="part" class="form-select" aria-label="Default select example">
                            <option value="ENG">Engine</option>
                            <option value="GEAR">Gearbox</option>
                            <option value="BODY">Body</option>
                            <option value="CLUTCH">Clutch</option>
                            <option value="WHEEL">Wheel</option>
                        </select>
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
