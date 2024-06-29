<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
 public function up()
{
    Schema::create('orders', function (Blueprint $table) {
        $table->id();
        $table->unsignedBigInteger('customer_id');
        $table->unsignedBigInteger('merchant_id');
        $table->decimal('total_amount', 10, 2);
        $table->enum('status', ['pending', 'completed', 'cancelled'])->default('pending');
        $table->string('invoice_number')->nullable();
        $table->date('invoice_date')->nullable();
        $table->timestamps();

        $table->foreign('customer_id')->references('id')->on('users')->onDelete('cascade');
        $table->foreign('merchant_id')->references('id')->on('users')->onDelete('cascade');
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
