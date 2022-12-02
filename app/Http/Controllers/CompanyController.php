<?php

namespace App\Http\Controllers;

use App\Http\Requests\company\StoreRequest;
use App\Models\company;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class CompanyController extends Controller
{
    use ResponseTrait;

    private object $model;

    public function __construct()
    {
        $this->model = Company::query();
    }

    public function index(Request $request): JsonResponse
    {
        $data = $this->model
            ->where('name', 'like', '%' . $request->get('q') . '%')
            ->get();
        return $this->successResponse($data);
    }

    public function check($companyName): JsonResponse
    {
        $check = $this->model
            ->where('name', $companyName)
            ->exists();
        return $this->successResponse($check);
    }



    public function store(StoreRequest $request)
    {
        $arr = $request->validated();
        $arr['logo'] = $request->file('logo')->store('company_logo');

        Company::create($arr);
    }


}
