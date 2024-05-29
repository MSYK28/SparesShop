<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('fratij_products', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('supplier_id');
            $table->foreign('supplier_id')->references('id')->on('fratij_suppliers');
            $table->string('productTitle');
            $table->string('productBarcode');
            $table->integer('quantity');
            $table->integer('reorderQty');
            $table->float('productBuyingPrice');
            $table->float('productPrice');
            $table->float('productDiscountedPrice');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('fratij_products');
    }
};
