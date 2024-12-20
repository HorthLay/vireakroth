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
        Schema::create('orders', function (Blueprint $table) {
            $table->id(); // Auto-incrementing ID
            $table->unsignedBigInteger('user_id')->nullable(); // Nullable foreign key
            $table->foreign('user_id')->references('id')->on('users')->onDelete('set null'); // Define foreign key constraint

            // Other fields
            $table->string('details')->nullable(); // Allow NULL values
            $table->decimal('total_price', 8, 2); // Total price field with 2 decimal places
            $table->timestamps(); // Created at and updated at timestamps
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('orders');
    }
};
