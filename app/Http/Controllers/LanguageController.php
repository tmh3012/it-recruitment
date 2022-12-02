<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreLanguageRequest;
use App\Http\Requests\UpdateLanguageRequest;
use App\Models\Language;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class LanguageController extends Controller
{
    use ResponseTrait;

    private object $model;

    public function __construct()
    {
        $this->model = Language::query();
    }

    public function index(Request $request): \Illuminate\Http\JsonResponse
    {
        $configs = SystemConfigController::getAndCache();

        $data = $configs['languages']->filter(function ($each) use ($request) {
            if ($request->has('q')) {
                Return Str::contains(strtolower($each['name']), $request->get('q'));
            }
            return true;
        });

//        $data = $this->model
//            ->where('name', 'like', '%' . $request->get('q') . '%')
//            ->get();

        return $this->successResponse($data);
    }


}
