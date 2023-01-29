<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AlterAddNewColumnValue2AndDescriptionToConfigsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if (!Schema::hasColumn('configs', 'value2')) {
            Schema::table('configs', function (Blueprint $table) {
                $table->text('value2')->after('value')->nullable();
            });
        }
        if (!Schema::hasColumn('configs', 'description')) {
            Schema::table('configs', function (Blueprint $table) {
                $table->mediumText('description')->after('value2')->nullable();
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
        if (Schema::hasColumn('configs', 'value')) {
            Schema::table('configs', function (Blueprint $table) {
                $table->dropColumn('value2');
            });
        }
        if (Schema::hasColumn('configs', 'description')) {
            Schema::table('configs', function (Blueprint $table) {
                $table->dropColumn('description');
            });
        }
    }
}
