<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AlterAddColumnJobDescriptionAndJobBenefitToPostsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if (!Schema::hasColumn('posts','job_description')){
            Schema::table('posts', function (Blueprint $table) {
                $table->text('job_description')->after('currency_salary')->nullable();
            });
        }
        if (!Schema::hasColumn('posts','job_benefit')){
            Schema::table('posts', function (Blueprint $table) {
                $table->text('job_benefit')->after('requirement')->nullable();
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
        if (Schema::hasColumn('posts','job_description')){
            Schema::table('posts', function (Blueprint $table) {
                $table->dropColumn('job_description');
            });
        }
        if (Schema::hasColumn('posts','job_description')){
            Schema::table('posts', function (Blueprint $table) {
                $table->dropColumn('job_benefit');
            });
        }
    }
}
