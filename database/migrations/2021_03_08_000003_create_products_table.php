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
            $table->uuid('id')->unique()->primary();
            $table->string('product_name')->nullable();
            $table->text('product_description')->nullable();
            $table->double('price')->nullable();
            $table->double('discount_price')->nullable();
            $table->tinyInteger('product_status')->nullable()->comment('1/0');
            $table->integer('stock')->nullable();
            $table->uuid('category_id')->nullable();
            $table->uuid('image_id')->nullable();
            $table->uuid('last_modified_by')->nullable();
            $table->uuid('deleted_by')->nullable();
            $table->timestamps();
            $table->softDeletes();

            $table->foreign('image_id')->references('id')->on('images')->onDelete('cascade');
            $table->foreign('category_id')->references('id')->on('categories');

            $table->index('product_name');
            $table->index('product_status');
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
