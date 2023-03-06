<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateWebConfigTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('web_config', function (Blueprint $table) {
            $table->id();
            $table->string('key', 255);
            $table->string('name', 255);
            $table->string('value', 255);
            $table->mediumText('description')->nullable();
            $table->integer('sort')->default(0);
            $table->boolean('is_display')->default(true);
            $table->boolean('pin')->default(false);
            $table->timestamps();
            $table->foreign('key')->references('key')->on('configs');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('web_config');
    }
}
