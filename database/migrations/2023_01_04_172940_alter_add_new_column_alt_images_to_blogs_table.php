<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AlterAddNewColumnAltImagesToBlogsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if (!Schema::hasColumn('blogs', 'alt_images')) {
            Schema::table('blogs', function (Blueprint $table) {
                $table->string('alt_images', 255)->nullable();
            });
        }
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        if (Schema::hasColumn('blogs', 'alt_images')) {
            Schema::table('blogs', function (Blueprint $table) {
                $table->dropColumn('alt_images');
            });
        }
    }
}
