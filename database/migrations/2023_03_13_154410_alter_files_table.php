<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AlterFilesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if (Schema::hasColumn('files', 'cover_letter')) {
            Schema::table('files', function ($table) {
                $table->dropColumn('cover_letter');
            });
        }
        if (!Schema::hasColumn('files', 'name')) {
            Schema::table('files', function ($table) {
                $table->string('name', 255)->nullable()->after('post_id');
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
        if (!Schema::hasColumn('files', 'cover_letter')) {
            Schema::table('files', function ($table) {
                $table->text('cover_letter')->nullable();
            });
        }
        if (Schema::hasColumn('files', 'name')) {
            Schema::table('files', function ($table) {
                $table->dropColumn('name');
            });
        }
    }
}
