<?php

namespace App\Http\Controllers;

use App\Http\Requests\CheckSlugRequest;
use App\Http\Requests\GenerateSlugRequest;
use App\Models\Post;
use App\Http\Requests\StorePostRequest;
use App\Http\Requests\UpdatePostRequest;
use Cviebrock\EloquentSluggable\Services\SlugService;
use Illuminate\Http\JsonResponse;

class PostController extends Controller
{
    use ResponseTrait;

    private object $model;

    public function __construct()
    {
        $this->model = Post::query();
    }

    public function index(): JsonResponse
    {
        $data = $this->model
            ->latest()
            ->paginate();
        foreach ($data as $each) {
            $each->append('range_salary');
        };

        $arr['data'] = $data->getCollection();
        $arr['pagination'] = $data->linkCollection();

        return $this->successResponse($arr);
    }

    public function generateSlug(GenerateSlugRequest $request): JsonResponse
    {
        try {
            $title = $request->get('title');
            $slug  = SlugService::createSlug(Post::class, 'slug', $title);
            return $this->successResponse($slug);
        }
        catch (\Throwable $e){
            return $this->errorResponse();
        }
    }

    public function checkSlug(CheckSlugRequest $request): JsonResponse
    {
        return $this->successResponse();
    }
}
