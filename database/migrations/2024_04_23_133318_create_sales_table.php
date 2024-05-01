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
        Schema::create('fratij_sales', function (Blueprint $table) {
            $table->id();
            $table->string('sale_code');
            $table->unsignedBigInteger('customer_id');
            $table->foreign('customer_id')->references('id')->on('fratij_customers');
            $table->string('total');
            $table->string('saleType')->default(0);
            $table->string('status')->default(1);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('fratij_sales');
    }
};
