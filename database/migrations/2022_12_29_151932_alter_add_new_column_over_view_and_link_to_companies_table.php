<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AlterAddNewColumnOverViewAndLinkToCompaniesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if (!Schema::hasColumn('companies', 'link')) {
            Schema::table('companies', function (Blueprint $table) {
                $table->string('link', 255)->nullable();
            });
        }
        if (!Schema::hasColumn('companies', 'over_view')) {
            Schema::table('companies', function (Blueprint $table) {
                $table->text('over_view')->nullable();
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
        if (Schema::hasColumn('companies', 'link')) {
            Schema::table('companies', function (Blueprint $table) {
                $table->dropColumn('link');
            });
        }
        if (!Schema::hasColumn('companies', 'over_view')) {
            Schema::table('companies', function (Blueprint $table) {
                $table->dropColumn('over_view');
            });
        }
    }
}
