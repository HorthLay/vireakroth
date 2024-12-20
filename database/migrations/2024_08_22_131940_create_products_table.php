<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('products', function (Blueprint $table) {
            $table->id(); // Primary key, unsigned big integer
            $table->string('name');
            $table->text('description')->nullable();
            $table->decimal('price', 8, 2); // Price field with 8 digits in total and 2 digits after the decimal point
            $table->unsignedBigInteger('category_id'); // Foreign key to categories table
            $table->foreign('category_id')->references('id')->on('categories')->onDelete('cascade'); // Set up foreign key constraint
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
        Schema::dropIfExists('products');
    }
}
