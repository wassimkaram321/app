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

        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->uuid('uuid')->nullable()->unique();
            $table->string('name',191);
            $table->text('description')->nullable();
            $table->double('price')->nullable();
            $table->string('slug')->unique();
            $table->integer('quantity')->default(0);
            $table->boolean('is_active')->default(true);
            $table->boolean('is_returnable')->default(false);
            $table->boolean('is_cancelable')->default(false);
            $table->boolean('is_replaceable')->default(false);
            $table->boolean('availability')->default(true);
            $table->unsignedBigInteger('vendor_id');
            $table->unsignedBigInteger('categorizable_id ');
            $table->string('categorizable_type',191);
            $table->unsignedBigInteger('commission_id')->nullable();
            $table->decimal('commission_value', 10, 2)->nullable();
            $table->timestamps();
            $table->foreign('vendor_id')->references('id')->on('vendors')->onDelete('cascade');
            $table->foreign('discount_id')->references('id')->on('discounts')->onDelete('cascade');


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
};
