<?php

use App\Constants\Enum;
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
        Schema::create('coupons', function (Blueprint $table) {
            $table->id();
            $table->string('name')->default('Coupon');
            $table->string('code');
            $table->integer('discount')->default('10');
            $table->enum('type',[Enum::FIXED,Enum::PERCENTAGE])->default(Enum::PERCENTAGE);
            $table->integer('max_uses')->nullable();
            $table->integer('times_used')->default(0);
            $table->integer('days')->default(1);
            $table->timestamp('valid_from')->nullable();
            $table->timestamp('valid_to')->nullable();
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
        Schema::dropIfExists('coupons');
    }
};
