<?php

namespace App\Http\Controllers;

use App\Enums\PostCurrencySalaryEnum;
use App\Enums\PostRemoteEnum;
use App\Http\Requests\CheckSlugRequest;
use App\Http\Requests\GenerateSlugRequest;
use App\Http\Requests\StoreRequest;
use App\Models\Company;
use App\Models\Config;
use App\Models\Language;
use App\Models\ObjectLanguage;
use App\Models\Post;
use App\Http\Requests\StorePostRequest;
use App\Http\Requests\UpdatePostRequest;
use Cviebrock\EloquentSluggable\Services\SlugService;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\DB;
use Throwable;

class PostController extends Controller
{
    use ResponseTrait;

    private object $model;

    public function __construct()
    {
        $this->model = Post::query();
    }

    public function index()
    {
        return view("posts.index");
    }

    public function getPostForRole(): JsonResponse
    {
        $idUserHr = isHr() ? user()->id : null;
        $data = $this->model
            ->when(isset($idUserHr), function ($q) use ($idUserHr) {
                return $q->where('user_id', $idUserHr);
            })
            ->latest()
            ->paginate();

        foreach ($data as $each) {
            $each->append('salary');
            $each->append('location');
            $each->append('deadline_submit');
            $each->append('working_time');
        };

        $arr['data'] = $data->getCollection();
        $arr['pagination'] = $data->linkCollection();

        return $this->successResponse($arr);
    }

    public function create()
    {
        $currencies = PostCurrencySalaryEnum::asArray();
        $workPlaces = PostRemoteEnum::getArrayWithoutKeys();
        return view('posts.create', [
            'currencies' => $currencies,
            'workPlaces' => $workPlaces,
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

    public function edit()
    {

    }

    public function generateSlug(GenerateSlugRequest $request): JsonResponse
    {
        try {
            $title = $request->get('title');
            $slug = SlugService::createSlug(Post::class, 'slug', $title);
            return $this->successResponse($slug);
        } catch (Throwable $e) {
            return $this->errorResponse();
        }
    }

    public function checkSlug(CheckSlugRequest $request): JsonResponse
    {
        return $this->successResponse();
    }
}
