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
        Schema::table('merchant_stores', function (Blueprint $table) {
            if (!Schema::hasColumn('merchant_stores', 'uuid')) {
                $table->string('uuid')->nullable();
            }
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('merchant_stores', function (Blueprint $table) {
            if (Schema::hasColumn('merchant_stores', 'uuid')) {
                $table->dropColumn('uuid');
            }
        });
    }
};
