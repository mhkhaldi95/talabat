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
        Schema::create('settings', function (Blueprint $table) {
            $table->id();
            $table->string('site_name_ar')->default('بريك');
            $table->string('site_name_en')->default('break');
            $table->string('site_description_ar')->default('بريك');
            $table->string('site_description_en')->default('break');
            $table->string('done_by_ar')->default('تم بواسطة حاضرة بلس');
            $table->string('done_by_en')->default('تم بواسطة حاضرة بلس');
            $table->string('facebook_link')->default('https://www.facebook.com/');
            $table->string('twitter_link')->default('https://twitter.com/');
            $table->string('instagram_link')->default('https://www.instagram.com/');
            $table->string('site_icon')->default('icon_site.png');
            $table->string('tags')->nullable();
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
        Schema::dropIfExists('settings');
    }
};
