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
        Schema::create('phones', function (Blueprint $table) {
            $table->string("id")->primary();
            $table->string("brand");
            $table->string("model");
            $table->unsignedBigInteger("price");
            $table->string("status");
            $table->string('customer_id');
            $table->string('imei');
            $table->integer("damage_percent")->default(0);
            $table->string("gift")->nullable();
            $table->string("category")->nullable();
            $table->unsignedBigInteger("discount_amount");
            $table->enum("discount_type",["percentage","fixed_amount"]);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('phones');
    }
};
