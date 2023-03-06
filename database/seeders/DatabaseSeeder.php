<?php

namespace Database\Seeders;

use App\Models\Blog;
use App\Models\Company;
use App\Models\Language;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        Blog::factory(20)->create();
    }
}
