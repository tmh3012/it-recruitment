<?php

namespace App\Http\Controllers;

use App\Enums\PostCurrencySalaryEnum;
use App\Enums\PostRemoteEnum;
use App\Enums\PostStatusEnum;
use App\Http\Requests\CheckSlugRequest;
use App\Http\Requests\GenerateSlugRequest;
use App\Http\Requests\StoreRequest;
use App\Http\Requests\UpdateStatusPostRequest;
use App\Models\Company;
use App\Models\Config;
use App\Models\Language;
use App\Models\ObjectLanguage;
use App\Models\Post;
use App\Http\Requests\StorePostRequest;
use App\Http\Requests\UpdatePostRequest;
use Cviebrock\EloquentSluggable\Services\SlugService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\View;
use Throwable;

class PostController extends Controller
{
    use ResponseTrait;

    private object $model;
    private string $table;

    public function __construct()
    {
        $this->model = Post::query();
        $this->table = (new Post())->getTable();

        View::share('title', strtoupper($this->table));
        View::share('table', $this->table);
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
        $arr['postStatus'] = PostStatusEnum::getStatusWithLang();
        foreach ($data as $each) {
            $each->append('salary');
            $each->append('location');
            $each->append('working_time');
            $each->append('deadline_submit');
            $each->append('status_type_string');
        };

        $arr['data'] = $data->getCollection();
        $arr['pagination'] = $data->linkCollection();

        return $this->successResponse($arr);
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

            if (!is_null($request->get('min_salary'))) {
                $arr['min_salary'] = $request->get('min_salary') / $rate;
            }
            if (!is_null($request->get('max_salary'))) {
                $arr['max_salary'] = $request->get('max_salary') / $rate;
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

    public function edit($postId)
    {
        $post = Post::query()
            ->where('id', $postId)
            ->with([
                'languages',
                'company' => function ($q) {
                    return $q->select([
                        'id',
                        'name'
                    ]);
                }
            ])
            ->first();
        $arrLanguage = $post->languages->pluck('name')->toArray();
        $currencies = PostCurrencySalaryEnum::asArray();
        $workPlaces = PostRemoteEnum::getArrayWithoutKeys();
        $postStatus = PostStatusEnum::asArray();
        View::share('title', strtoupper($this->table));
        return view('posts.edit', [
            'post' => $post,
            'currencies' => $currencies,
            'workPlaces' => $workPlaces,
            'arrLanguage' => $arrLanguage,
            'postStatus' => $postStatus,
        ]);
    }

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
            $rate = Config::getByKey(PostCurrencySalaryEnum::getKey((int)$request->get('currency_salary')));

            if (!is_null($request->get('min_salary'))) {
                $arr['min_salary'] = $request->get('min_salary') / $rate;
            }
            if (!is_null($request->get('max_salary'))) {
                $arr['max_salary'] = $request->get('max_salary') / $rate;
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

    public function updateStatusPost(UpdateStatusPostRequest $request, $postId): JsonResponse
    {
        $data = $request->Validated();
        Post::find($postId)->update($data);
        return $this->successResponse();
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
