<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
    <link rel="stylesheet" href="{{ asset('assets/css/receipt.css') }}">
</head>
<body>
    <div class="invoice-3 invoice-content">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="invoice-inner">
                        <div class="invoice-info" id="invoice_wrapper">
                            <div class="invoice-headar">
                                <div class="row">
                                    <div class="col-sm-6">
                                        <div class="invoice">
                                            <h1 class="text-end inv-header-1 mb-0">Fratij Spares</h1>
                                        </div>
                                    </div>
                                    <div class="col-sm-6">
                                        <div class="invoice">
                                            <h1 class="text-end inv-header-1 mb-0">Receipt No: {{ $sale->id }}</h1>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="invoice-top">
                                <div class="row">
                                    <div class="col-sm-6 mb-30">
                                        <div class="invoice-number">
                                            <h4 class="inv-title-1">Fratij Spares</h4>
                                            <p class="invo-addr-1 mb-0">
                                                +254 7(13) 684 158 <br />
                                                fratijspares@gmail.com <br />
                                                Jua Kali, Opposite Nyataya, Kisumu <br />
                                            </p>
                                        </div>
                                    </div>
                                    <div class="col-sm-6 mb-30">
                                        <div class="invoice-number">
                                            <h4 class="inv-title-1">Receipt To</h4>
                                            <p class="invo-addr-1 mb-0">
                                                {{ $sale->customer->name }} <br />
                                                {{ $sale->customer->email }} <br />
                                                Tax ID: {{ $sale->customer->taxID }} <br />
                                            </p>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-sm-6 mb-30">
                                        <h4 class="inv-title-1">{{ date('F d, Y', strtotime($today)) }}</h4>
                                    </div>
                                </div>
                            </div>
                            <div class="invoice-center">
                                <div class="order-summary">
                                    <h4>Order summary</h4>
                                    <div class="table-outer">
                                        <table class="table invoice-table table-bordered">
                                            <thead>
                                                <tr>
                                                    <th>Name</th>
                                                    <th>Quantity</th>
                                                    <th>Price</th>
                                                    <th>Total</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach ($show_sales as $show_sale)
                                                    <tr>
                                                        <td>{{ $show_sale->products->productTitle }}</td>
                                                        <td>{{ $show_sale->quantity }}</td>
                                                        <td>{{ number_format($show_sale->price, 2) }}</td>
                                                        <td>{{ number_format($show_sale->quantity * $show_sale->price, 2) }}
                                                        </td>
                                                    </tr>
                                                @endforeach
                                            </tbody>
                                            <tr>
                                                <td><strong>VAT</strong></td>
                                                <td>16%</td>
                                                <td></td>
                                                <td><strong>{{ number_format($VAT, 2) }}</strong></td>
                                            </tr>
                                            <tr>
                                                <td><strong>Total Due</strong></td>
                                                <td></td>
                                                <td></td>
                                                <td><strong>{{ number_format($total, 2) }}</strong></td>
                                            </tr>
                                        </table>
                                    </div>
                                </div>
                            </div>
                            <div class="invoice-bottom">
                                <div class="row">
                                    <div class="col-sm-8">
                                        <div class="important-note mb-30">
                                            <h3 class="inv-title-1">Important Note</h3>
                                            <ul class="important-notes-list-1">
                                                <li>Please check the product before you sign.</li>
                                                <li>Goods once sold cannot be returned.</li>
                                                <li>If a must 10% (percent) of original price will be charged.</li>
                                                <li>This is computer generated receipt and does not require vendor signature.</li>
                                            </ul>
                                        </div>
                                        <div class="signature">
                                            <div class="row">
                                                <div class="col-sm-8">
                                                    <p><strong>
                                                        Sign: .....................................................................................</p>
                                                    </strong>
                                                </div>
                                                <div class="col-sm-4">
                                                    <p><strong>{{ date('F d, Y', strtotime($today)) }}</strong></p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="invoice-btn-section clearfix d-print-none">
                            <a href="javascript:window.print()" class="btn btn-lg btn-print">
                                <i class="fa fa-print"></i> Print Invoice
                            </a>
                            <a id="invoice_download_btn" class="btn btn-lg btn-download btn-theme">
                                <i class="fa fa-download"></i> Download Invoice
                            </a>
                            <a href="{{ route('home.index') }}" class="btn btn-lg btn-danger">
                                <i class="fa fa-download"></i> Dashbaord
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
</body>
</html>