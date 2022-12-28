<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AlterColumnInFilesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if (Schema::hasColumn('files', 'user_id')) {
            Schema::table('files', function (Blueprint $table) {
                $table->unsignedBigInteger('user_id')->nullable()->change();
            });
        }
        if (!Schema::hasColumn('files', 'cover_letter')) {
            Schema::table('files', function (Blueprint $table) {
                $table->text('cover_letter')->nullable();
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
        if (Schema::hasColumn('files', 'cover_letter')) {
            Schema::table('files', function (Blueprint $table) {
                $table->dropColumn('cover_letter');
            });
        }
    }
}
