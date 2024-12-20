<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('orders', function (Blueprint $table) {
            // Drop the unique constraint
            $table->dropUnique(['order_number']);

            // Add an index for faster searches on order_number
            $table->index('order_number');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('orders', function (Blueprint $table) {
            // Add the unique constraint back in case of rollback
            $table->unique('order_number');

            // Drop the index
            $table->dropIndex(['order_number']);
        });
    }
};
