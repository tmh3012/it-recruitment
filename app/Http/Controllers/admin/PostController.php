<?php

namespace App\Http\Controllers\admin;

use App\Enums\ObjectLanguageTypeEnum;
use App\Enums\PostCurrencySalaryEnum;
use App\Enums\PostRemoteEnum;
use App\Enums\PostStatusEnum;
use App\Http\Controllers\Controller;
use App\Http\Controllers\ResponseTrait;
use App\Http\Requests\StoreRequest;
use App\Http\Requests\UpdatePostRequest;
use App\Imports\PostImport;
use App\Models\Company;
use App\Models\Config;
use App\Models\Language;
use App\Models\ObjectLanguage;
use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;

//use Illuminate\Support\Facades;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\View;
use Maatwebsite\Excel\Facades\Excel;
use Throwable;


class PostController extends Controller
{
    private object $model;
    private string $table;
    use ResponseTrait;

    public function __construct()
    {
        $this->model = Post::query();
        $this->table = (new Post())->getTable();

        View::share('title', strtoupper($this->table));
        View::share('table', $this->table);
    }

    public function index()
    {
        return view('posts.index');
    }

    public function create()
    {
        $currencies = PostCurrencySalaryEnum::asArray();
        $workPlaces = PostRemoteEnum::getArrayWithoutKeys();
        $postStatus = PostStatusEnum::asArray();
        return view('posts.create', [
            'currencies' => $currencies,
            'workPlaces' => $workPlaces,
            'postStatus' => $postStatus,
        ]);
    }

    public function store(StoreRequest $request): JsonResponse
    {
        DB::beginTransaction();
        try {
            $arr = $request->validated();

            $companyName = $request->get('company');
            if (!empty($companyName)) {
                $arr['company_id'] = Company::firstOrCreate(['name' => $companyName])->id;
            }

            if ($request->has('can_parttime')) {
                $arr['can_parttime'] = 1;
            }
            $rate = Config::getByKey(PostCurrencySalaryEnum::getKey((int)$request->get('currency_salary')));

            if ($request->has('min_salary')) {
                $arr['min_salary'] = $request->get('min_salary')/$rate;
            }
             if ($request->has('max_salary')) {
                $arr['max_salary'] = $request->get('max_salary')/$rate;
            }
             $post = Post::create($arr);

            $languages = $request->get('languages');
            foreach ($languages as $language) {
                $language = Language::firstOrCreate(['name' => $language]);
                ObjectLanguage::create([
                    'object_id' => $post->id,
                    'language_id' => $language->id,
                    'object_type' => Post::class,
                ]);
            }
            DB::commit();
            return $this->successResponse();

        } catch (\Throwable $e) {
            DB::rollBack();
            return $this->errorResponse($e->getMessage());
        }
    }

//    public function edit($postId)
//    {
//        $post = Post::query()
//            ->where('id', $postId)
//            ->with([
//                'languages',
//                'company' => function ($q) {
//                    return $q->select([
//                        'id',
//                        'name'
//                    ]);
//                }
//            ])
//            ->first();
//        $arrLanguage = $post->languages->pluck('name')->toArray();
//        $currencies = PostCurrencySalaryEnum::asArray();
//        $workPlaces = PostRemoteEnum::getArrayWithoutKeys();
//        return view('posts.edit', [
//            'post' => $post,
//            'currencies' => $currencies,
//            'workPlaces' => $workPlaces,
//            'arrLanguage' => $arrLanguage,
//        ]);
//    }

    public function update(UpdatePostRequest $request, $postId): JsonResponse
    {

        DB::beginTransaction();
        try {
            $arr = $request->validated();
            $companyName = $request->get('company');
            if (!empty($companyName)) {
                $arr['company_id'] = Company::firstOrCreate(['name' => $companyName])->id;
            }
            if ($request->has('can_parttime')) {
                $arr['can_parttime'] = 1;
            }
            $post = Post::find($postId);
            $post->update($arr);
            $languages = $request->get('languages');
            $langId = [];
            foreach ($languages as $language) {
                $language = Language::firstOrCreate(['name' => $language]);
                $langId[] = $language->id;
            }

            $post->languages()->sync($langId);
            DB::commit();
            return $this->successResponse();

        } catch (\Throwable $e) {
            DB::rollBack();
            return $this->errorResponse($e->getMessage());
        }
    }

    public function importCsv(Request $request)
    {
        try {
            Excel::import(new PostImport, $request->file('file'));
            return $this->successResponse();
        } catch (Throwable $e) {
            return $this->errorResponse();
        }
    }


}
