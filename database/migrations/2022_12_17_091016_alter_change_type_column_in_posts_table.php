<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AlterChangeTypeColumnInPostsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if(Schema::hasColumn('posts','min_salary')){
            Schema::table('posts', function (Blueprint $table) {
                $table->float('min_salary')->change();
            });
        }
        if(Schema::hasColumn('posts','max_salary')){
            Schema::table('posts', function (Blueprint $table) {
                $table->float('max_salary','')->change();
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

    }
}
