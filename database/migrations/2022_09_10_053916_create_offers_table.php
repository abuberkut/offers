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
        Schema::create('offers', function (Blueprint $table) {
            $table->id();
            $table->unsignedInteger("product_id");
            $table->unsignedInteger("seller_id");
            $table->decimal("price", "8", "2");
            $table->unsignedInteger("in_stock");

            $table->foreign("product_id")->references("id")->on("products")->cascadeOnDelete();
            $table->foreign("seller_id")->references("id")->on("sellers")->cascadeOnDelete();

            $table->unique(['product_id', 'seller_id']);
            $table->softDeletes();
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
        Schema::dropIfExists('offers');
    }
};
