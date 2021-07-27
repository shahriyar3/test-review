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
            $table->id();
            $table->string('name', 191);
            $table->string('slug', 191);
            $table->string('image', 191);
            /**
             * other fields
             */
            $table->decimal('price')->nullable()->comment('products with nor price set null');
            $table->boolean('approved')->default(true);
            $table->boolean('is_public_vote')->default(true);
            $table->boolean('is_public_comment')->default(true);
            $table->boolean('commentable')->default(true);
            $table->boolean('voteable')->default(true);
            $table->timestamps();
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
