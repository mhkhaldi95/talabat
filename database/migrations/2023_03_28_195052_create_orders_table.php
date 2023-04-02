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
            $table->id();
            $table->foreignId('coupon_id')->nullable()->constrained('coupons');
            $table->foreignId('branch_id')->nullable()->constrained('branches');
            $table->foreignId('user_id')->nullable()->constrained('users');
            $table->double('price')->nullable();
            $table->text('payment_id')->nullable();
            $table->enum('payment_method',['online','wallet'])->default('online');
            $table->string('status')->default('initiated');
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
        Schema::dropIfExists('orders');
    }
};
