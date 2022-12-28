<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AlterAddColumnIntroductionAndCoverAndNumberOfEmployeesToCompaniesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if (!Schema::hasColumn('companies', 'mission')) {
            Schema::table('companies', function (Blueprint $table) {
                $table->text('mission')->nullable();
            });
        }
        if (!Schema::hasColumn('companies', 'introduction')) {
            Schema::table('companies', function (Blueprint $table) {
                $table->text('introduction')->nullable();
            });
        }
        if (!Schema::hasColumn('companies', 'number_of_employees')) {
            Schema::table('companies', function (Blueprint $table) {
                $table->string('number_of_employees')->nullable();
            });
        }
        if (!Schema::hasColumn('companies', 'cover')) {
            Schema::table('companies', function (Blueprint $table) {
                $table->string('cover', 255)->after('logo')->nullable();
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
        if (Schema::hasColumn('companies', 'mission')) {
            Schema::table('companies', function (Blueprint $table) {
                $table->dropColumn('mission');
            });
        }
        if (Schema::hasColumn('companies', 'introduction')) {
            Schema::table('companies', function (Blueprint $table) {
                $table->dropColumn('introduction');
            });
        }
        if (Schema::hasColumn('companies', 'number_of_employees')) {
            Schema::table('companies', function (Blueprint $table) {
                $table->dropColumn('number_of_employees');
            });
        }
        if (Schema::hasColumn('companies', 'cover')) {
            Schema::table('companies', function (Blueprint $table) {
                $table->dropColumn('cover');
            });
        }

    }
}
