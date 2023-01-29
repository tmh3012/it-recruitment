<?php

namespace App\Http\Controllers;

use App\Models\Blog;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\Facades\View;


class BlogPageController extends Controller
{

    public function __construct()
    {

    }

    public function index()
    {

        $data = Blog::query()
            ->latest()
            ->paginate();
        return view('themeMain/pages.blog', [
            'data' => $data
        ]);
    }

    public function show($slug)
    {

        $blog = Blog::query()
            ->where('slug', $slug)
            ->firstOrFail();
        Carbon::setLocale(App::currentLocale());
        $createDate = $blog->created_at->isoFormat('d MMMM YYYY');
        $createDiffTime = $blog->created_at->diffForHumans();


        return view('themeMain/pages.blog_detail', [
            'blog' => $blog,
            'createDate' => $createDate,
            'createDiffTime' => $createDiffTime,
        ]);
    }
}
