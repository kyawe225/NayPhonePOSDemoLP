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
        Schema::create('repairs', function (Blueprint $table) {
            $table->string("id")->primary();
            $table->string("customer_id");
            $table->foreign("customer_id")->references("id")->on("customers")->cascadeOnDelete();
            $table->string("phone_model");
            $table->string("issue");
            $table->unsignedBigInteger("cost");
            $table->string("status");
            $table->timestampTz("date");
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('repairs');
    }
};
