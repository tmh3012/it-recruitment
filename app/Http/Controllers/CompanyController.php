<?php

namespace App\Http\Controllers;

use App\Http\Requests\company\StoreRequest;
use App\Models\company;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\View;
use Throwable;

class CompanyController extends Controller
{
    use ResponseTrait;

    private object $model;
    private string $table;

    public function __construct()
    {
        $this->model = Company::query();
        $this->table = (new Company)->getTable();

        View::share('table', $this->table);
        View::share('title', $this->table);
    }

    public function adminIndex()
    {
        $data = $this->model->clone()
        ->orderByDesc('id')
        ->paginate();

        return view("admin.$this->table.index", [
            'data' => $data,
        ]);
    }

    public function adminCreate()
    {
        return view("admin.$this->table.create");
    }

    public function index(Request $request): JsonResponse
    {
        $data = $this->model
            ->where('name', 'like', '%' . $request->get('q') . '%')
            ->get();
        return $this->successResponse($data);
    }

    public function show($company_id): JsonResponse
    {
        $data = $this->model
            ->where('id', $company_id)
            ->first();
        return $this->successResponse($data);
    }

    public function check($companyName): JsonResponse
    {
        $check = $this->model
            ->where('name', $companyName)
            ->exists();
        return $this->successResponse($check);
    }


    public function store(StoreRequest $request): JsonResponse
    {
        try {
            $arr = $request->validated();
            $arr['logo'] = optional($request->file('logo'))->storeAs('images/company',preg_replace('/\s+/', '', 'logo_'.$request->file('logo')->hashName()));
            $arr['cover'] = optional($request->file('cover'))->storeAs('images/company',preg_replace('/\s+/', '', 'cover_'.$request->file('cover')->hashName()));
            Company::create($arr);
            return $this->successResponse();
        } catch (Throwable $e) {
            return $this->errorResponse($e->getMessage());
        }
    }


}
