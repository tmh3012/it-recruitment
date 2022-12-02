<?php

namespace App\Http\Controllers\admin;

use App\Enums\PostCurrencySalaryEnum;
use App\Http\Controllers\Controller;
use App\Http\Controllers\ResponseTrait;
use App\Http\Requests\StoreRequest;
use App\Imports\PostImport;
use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades;
use Illuminate\Support\Facades\View;
use Maatwebsite\Excel\Facades\Excel;


class PostController extends Controller
{
    private object $model;
    private string $table;
    use ResponseTrait;
    public function __construct()
    {
        $this->model=Post::query();
        $this->table=(new Post())->getTable();

        View::share('title', strtoupper($this->table));
        View::share('table', $this->table);
    }

    public function index()
    {
        return view('admin.posts.index');
    }
    public function create()
    {
        $currencies = PostCurrencySalaryEnum::asArray();

        return view('admin.posts.create', [
            'currencies'=>$currencies,
        ]);
    }
    public function importCsv(Request $request)
    {
        Excel::import(new PostImport, $request->file('file'));
    }

    public function store(StoreRequest $request)
    {
        return $this->successResponse();
    }
}
