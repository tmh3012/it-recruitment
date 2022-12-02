<?php

namespace App\Http\Controllers;

use App\Enums\FileTypeEnum;
use App\Enums\PostStatusEnum;
use App\Models\Company;
use App\Models\File;
use App\Models\Language;
use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class TestController extends Controller
{

    public function test()
    {
        $companyName = 'ABCDaNang Tech';
        $language = 'PHP Laravel, Java, Javascript, Python, C++';
        $city = 'ĐN';
        $link = 'axcxd';

        $company = Company::firstOrCreate([
            'name' => $companyName
        ], [
            'city' => $city,
            'country' => 'Vietnam',
        ]);

        $post = Post::create([
            'company_id' => $company->id,
            'job_title' => 'Web developer 2',
            'city' => 'HN, ĐN',
            'status' => PostStatusEnum::ADMIN_APPROVED,
        ]);

        $languages = explode(',', $language);
        foreach ($languages as $language) {
            Language::firstOrCreate([
                'name' => trim($language),
            ]);
        }

        File::create([
            'post_id' => $post->id,
            'link' => $link,
            'type' => FileTypeEnum::JD,
        ]);
    }
}
