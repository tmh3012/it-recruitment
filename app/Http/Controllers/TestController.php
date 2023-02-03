<?php

namespace App\Http\Controllers;

use App\Enums\FileTypeEnum;
use App\Enums\PostCurrencySalaryEnum;
use App\Enums\PostStatusEnum;
use App\Models\Blog;
use App\Models\Company;
use App\Models\Config;
use App\Models\File;
use App\Models\Language;
use App\Models\Post;
use App\Models\User;
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
        foreach (\DB::select("SHOW COLUMNS FROM blogs") as $column) {
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
        return $format->formatCurrency($post->min_salary, 'VND');

    }

    public function test()
    {
        /**
         * @param Integer[] $nums
         * @param Integer $target
         * @return Integer[]
         */
        function twoSum($nums, $target)
        {
            $rs = [];
            for ($i = 0; $i < count($nums); $i++) {
                $s = 0;
                for ($k = 0; $k < count($nums); $k++) {
                    if ($i == $k) {
                        continue;
                    }
                    if ($nums[$i] + $nums[$k] === $target) {
                        array_push($rs, $i, $k);
                        return $rs;
                    }
                }
            }

        }

        return twoSum([2,5,5,11], 10);
    }
}
