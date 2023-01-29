<?php

namespace App\Http\Controllers;

use App\Models\Company;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\View;

class CompanyPageController extends Controller
{

    public function __construct()
    {
        $locale = App::currentLocale();
        View::share('locale', $locale);

    }

    public function index()
    {
        $data = Company::query()
            ->orderByDesc('id')
            ->paginate();
        return view('themeMain/pages.company', [
            'data' => $data,
        ]);
    }

    public function show($companyId)
    {
        $company = Company::query()
            ->with('posts')
            ->findOrFail($companyId);
        $title = $company->name;
        return view('themeMain/pages.company_detail', [
            'company' => $company,
            'posts' => $company->posts,
            'title' => $title,
        ]);
    }
}
