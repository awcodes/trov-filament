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
        Schema::create('welcomes', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->foreignId('hero_image')->nullable();
            $table->mediumText('hero_content')->nullable();
            $table->longText('content')->nullable();
            $table->string('seo_title');
            $table->text('seo_description');
            $table->boolean('indexable')->default(true);
            $table->boolean('has_chat')->default(true);
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
        Schema::dropIfExists('welcomes');
    }
};
