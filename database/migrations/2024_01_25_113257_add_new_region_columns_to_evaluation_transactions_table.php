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
        Schema::table('evaluation_transactions', function (Blueprint $table) {
            $table->foreignId('new_city_id')->nullable()->references('id')
                ->on('cities')->onDelete('cascade');
            $table->string('plan_no')->nullable();
            $table->string('plot_no')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('evaluation_transactions', function (Blueprint $table) {
            $table->dropColumn('new_city_id');
            $table->dropColumn('plan_no');
            $table->dropColumn('plot_no');
        });
    }
};
