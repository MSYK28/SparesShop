<?php

namespace App\Providers;

use App\Models\Products;
use Maatwebsite\Excel\Row;
use Maatwebsite\Excel\Concerns\OnEachRow;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class ProductsImport implements OnEachRow, WithHeadingRow
{
    public function onRow(Row $row)
    {
        $row = $row->toArray();

        $products[] = [
            'productBarcode' => $row['productBarcode'],
            'productBuyingPrice' => intval($row['productBuyingPrice']),
            'productDiscountedPrice' => intval($row['productDiscountedPrice']),
            'productPrice' => intval($row['productPrice']),
            'productTitle' => $row['productTitle'],
            'quantity' => intval($row['quantity']),
            'reorderQty' => intval($row['reorderQty']),
            'supplier' => intval($row['supplier']),
        ];
    }

    public function headingRow(): int
    {
        return 1;
    }
}