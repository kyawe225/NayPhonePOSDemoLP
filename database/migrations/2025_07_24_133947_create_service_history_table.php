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
        Schema::create('service_history', function (Blueprint $table) {
            $table->string("id")->primary();
            $table->string("repair_id");
            $table->timestampTz("date");
            $table->text("description");
            $table->text("parts_used");
            $table->string("technician");
            $table->foreign("repair_id")->references("id")->on("repairs")->cascadeOnDelete();
            $table->timestampsTz();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('service_history');
    }
};
