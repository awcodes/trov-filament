<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMediaTable extends Migration
{
    public function up()
    {
        Schema::create('media', function (Blueprint $table) {
            $table->bigIncrements('id');

            $table->string('collection_name');
            $table->string('name');
            $table->string('file_name');
            $table->string('mime_type')->nullable();
            $table->string('alt_text')->nullable();
            $table->string('title')->nullable();
            $table->text('description')->nullable();
            $table->unsignedInteger('width')->nullable();
            $table->unsignedInteger('height')->nullable();
            $table->string('disk');
            $table->unsignedBigInteger('size');

            $table->nullableTimestamps();
        });
    }
}
