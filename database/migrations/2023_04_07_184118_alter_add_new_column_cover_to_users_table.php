<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AlterAddNewColumnCoverToUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if (!Schema::hasColumn('users', 'cover')) {
            Schema::table('users', function (Blueprint $table) {
                $table->string('cover', 255)->nullable()->after('avatar');
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
        if (Schema::hasColumn('users', 'cover')) {
            Schema::table('users', function (Blueprint $table) {
                $table->dropColumn('cover');
            });
        }
    }
}
