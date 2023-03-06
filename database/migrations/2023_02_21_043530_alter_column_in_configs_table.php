<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AlterColumnInConfigsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if (Schema::hasColumn('configs', 'value2')) {
            Schema::table('configs', function (Blueprint $table) {
                $table->dropColumn('value2');
            });
        }
        if (Schema::hasColumn('configs', 'description')) {
            Schema::table('configs', function (Blueprint $table) {
                $table->text('description')->nullable()->change();
            });
        }
        if (!Schema::hasColumn('configs', 'type')) {
            Schema::table('configs', function (Blueprint $table) {
                $table->integer('type')->default(0);
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
        if (!Schema::hasColumn('configs', 'value2')) {
            Schema::table('configs', function (Blueprint $table) {
                $table->text('value2');
            });
        }
        if (Schema::hasColumn('configs', 'type')) {
            Schema::table('configs', function (Blueprint $table) {
                $table->dropColumn('type');
            });
        }
    }
}
