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
        Schema::create('fratij_sales_revenue', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('sale_id');
            $table->unsignedBigInteger('customer_id');
            $table->unsignedBigInteger('product_id');
            $table->foreign('sale_id')->references('id')->on('fratij_sales');
            $table->foreign('customer_id')->references('id')->on('fratij_customers');
            $table->foreign('product_id')->references('id')->on('fratij_products');
            $table->string('saleType');      //1: Cash, 2: Credit
            $table->string('amount');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('fratij_sales_revenue');
    }
};
