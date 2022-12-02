<?php

namespace App\Imports;

use App\Enums\FileTypeEnum;
use App\Enums\PostStatusEnum;
use App\Models\Company;
use App\Models\File;
use App\Models\Language;
use App\Models\Post;
use Illuminate\Database\Eloquent\Model;
use Maatwebsite\Excel\Concerns\ToArray;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class PostImport implements ToArray, WithHeadingRow
{
    public function array(array $array)
    {
        foreach ($array as $each) {
            $companyName = $each['cong_ty'];
            $language = $each['ngon_ngu'];
            $city = $each['dia_diem'];
            $link = $each['link'];

            if (!empty($companyName)) {
                $companyId = Company::firstOrCreate([
                    'name' => $companyName
                ], [
                    'city' => $city,
                    'country' => 'Vietnam',
                ])->id;
            } else {
                $companyId = null;
            }

            $post = Post::create([
                'company_id' => $companyId,
                'job_title' => trim($language) . ' ' . trim($city),
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
}
