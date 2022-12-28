<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AlterAddColumnIsPublicToConfigTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if (!Schema::hasColumn('configs', 'is_public')) {
            Schema::table('configs', function (Blueprint $table) {
                $table->boolean('is_public')->default(0);
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
        if (Schema::hasColumn('configs', 'is_public')) {
            Schema::table('configs', function (Blueprint $table) {
                $table->dropColumn('is_public');
            });
        }
    }
}
