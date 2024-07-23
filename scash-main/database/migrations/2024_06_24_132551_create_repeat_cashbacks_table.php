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
        Schema::create('repeat_cashbacks', function (Blueprint $table) {
            $table->id();
            $table->integer('user_id');
            $table->integer('merchant_id')->comment('store, merchant id');
            $table->double('rp_cashback_balance',10,2)->default(0.00);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('repeat_cashbacks');
    }
};
