<?php

namespace App\Http\Controllers;

use App\Enums\BlogStatusEnum;
use App\Http\Requests\StoreBlogRequest;
use App\Models\Blog;
use Cviebrock\EloquentSluggable\Services\SlugService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\View;

class BlogController extends Controller
{
    public object $model;
    public string $table;

    use ResponseTrait;

    public function __construct()
    {
        $this->model = Blog::query();
        $this->table = (new Blog)->getTable();

        View::share('table', $this->table);
        View::share('title', $this->table);
    }

    public function index()
    {
        $data = $this->model
            ->clone()
            ->latest()
            ->paginate();
        return view("admin.$this->table.index", [
            'data' => $data,
        ]);
    }

    public function create()
    {
        $blogStatus = BlogStatusEnum::getKeys();
        return view("admin.$this->table.create", [
            'blogStatus' => $blogStatus,
        ]);
    }

    public function store(StoreBlogRequest $request)
    {
        $data = $request-> validated();

        //store image
        if ($request->hasFile('image')) {
            $originName = $request->file('image')->getClientOriginalName();
            $fileName = pathinfo($originName, PATHINFO_FILENAME);
            $extension = $request->file('image')->getClientOriginalExtension();
            $fileName = $fileName .'_'.time().'.'.$extension;
            $data['image'] = optional($request->file('image'))->storeAs('blogs', $fileName);
        }
        Blog::create($data);
        return redirect()->route("admin.blog.index");
    }

    public function edit($blogId)
    {
        $blog = $this->model->findOrFail($blogId);
        dd($blog->toArray());
    }

    public function generateSlug(Request $request): JsonResponse
    {
        try {
            $validated = $request->validate([
                'title' => [
                    'required',
                    'string',
                    'filled',
                ],
            ]);
            $slug = SlugService::createSlug(Blog::class, 'slug', $validated['title']);
            return $this->successResponse($slug);
        } catch (\Throwable $e) {
            return $this->errorResponse($e->getMessage());
        }
    }

}
