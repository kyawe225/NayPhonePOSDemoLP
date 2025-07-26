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
        Schema::create('sales', function (Blueprint $table) {
            $table->string("id")->primary();
            $table->string("customer_id");
            $table->string("phone_id");
            $table->timestampTz("date");
            $table->string("payment_method");
            $table->foreign("phone_id")->references("id")->on("phones")->cascadeOnDelete();
            $table->foreign("customer_id")->references("id")->on("customers")->cascadeOnDelete();
            $table->timestampsTz();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('sales');
    }
};
