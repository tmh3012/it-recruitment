<?php

namespace App\Http\Controllers;

use App\Enums\PostStatusEnum;
use App\Models\Company;
use App\Models\User;
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
            ->with('posts', function ($q) {
                return $q
                    ->where('status', PostStatusEnum::ADMIN_APPROVED)
//                    ->postReceived()
                    ->latest();
            })
            ->findOrFail($companyId);
        $posts = $company->posts;
        $title = $company->name;
        $following = User::checkFollow($company->id);
        return view('themeMain/pages.company_detail', [
            'posts' => $posts,
            'title' => $title,
            'company' => $company,
            'following' => $following,
        ]);
    }
}
