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
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->string('name_ar');
            $table->string('name_en');
            $table->text('description_ar');
            $table->text('description_en');
            $table->string('master_photo')->default('default.png');
            $table->text('tags')->nullable();
            $table->double('cashback')->default(0);
            $table->double('price');
            $table->foreignId('category_id')->nullable()->index();
            $table->double('discounted_price')->default(0);
            $table->double('max_addons')->default(0);
            $table->enum('discount_option',[Enum::NO_DISCOUNT,Enum::DISCOUNT_PERCENTAGE,Enum::DISCOUNT_FIXED])->default(Enum::NO_DISCOUNT);
            $table->enum('status',[Enum::PUBLISHED,Enum::INACTIVE])->default('published');
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
        Schema::dropIfExists('products');
    }
};
