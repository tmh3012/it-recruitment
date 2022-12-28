<?php

namespace App\Http\Controllers;

use App\Enums\FileTypeEnum;
use App\Enums\PostCurrencySalaryEnum;
use App\Enums\PostStatusEnum;
use App\Models\Company;
use App\Models\Config;
use App\Models\File;
use App\Models\Language;
use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class TestController extends Controller
{

    public function test2()
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
    public function getColumnTables(): array
    {
        $columns = array();
        foreach(\DB::select("SHOW COLUMNS FROM posts") as $column)
        {
            $columns[] = $column->Field;
        }

        return $columns;
    }
    public function testPost()
    {
        $post = Post::query()
            ->first();
        $arr = [];

        $currency_salary_post = $post->currency_salary;
        dd($currency_salary_post);
        $key_currency_salary = PostCurrencySalaryEnum::getKey($currency_salary_post);
        $locale = PostCurrencySalaryEnum::getLocaleByVal($currency_salary_post);
        $format = new \NumberFormatter($locale, \NumberFormatter::CURRENCY);
        $rate = Config::getByKey($key_currency_salary);
      return  $format->formatCurrency($post->min_salary, 'VND');

    }
    public function test()
    {
        $postId = 51;
        $post = Post::find($postId);
        $languageIds = $post->languages->pluck('id')->toArray();
        return $data = Post::query()
            ->leftJoin('object_language', 'object_language.object_id', 'posts.id')
            ->where(function ($q) use ($postId, $languageIds) {
                $q->where('id','!=', $postId);
                $q->whereIn('language_id', $languageIds);
            })

            ->get();


    }
}
