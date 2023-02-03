<?php

namespace App\Http\Controllers;

use App\Http\Requests\company\StoreRequest;
use App\Http\Requests\company\UpdateRequest;
use App\Models\company;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
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

    public function edit($companyId)
    {
        $company = $this->model
            ->findOrFail($companyId);

        return view("admin.$this->table.edit", [
            'company' => $company,
        ]);

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


    public function update(UpdateRequest $request, $companyId): JsonResponse
    {
        DB::beginTransaction();
        try {
            $arr = $request->validated();
            if (!empty($request->file('logo'))) {
                $arr['logo'] = optional($request->file('logo'))->storeAs('images/company', preg_replace('/\s+/', '', 'logo_' . $request->file('logo')->hashName()));
            }
            if (!empty($request->file('cover'))) {
                $arr['cover'] = optional($request->file('cover'))->storeAs('images/company', preg_replace('/\s+/', '', 'cover_' . $request->file('cover')->hashName()));
            }
            $company = Company::find($companyId);
            $company->update($arr);
            DB::commit();
            return $this->successResponse();
        } catch (Throwable $e) {
            DB::rollBack();
            return $this->errorResponse($e->getMessage());
        }
    }

    public function store(StoreRequest $request): JsonResponse
    {
        DB::beginTransaction();
        try {
            $arr = $request->validated();

            //store image
            if ($request->hasFile('logo')) {
                $originName = $request->file('logo')->getClientOriginalName();
                $fileName = pathinfo($originName, PATHINFO_FILENAME);
                $extension = $request->file('logo')->getClientOriginalExtension();
                $fileName = $fileName .'_'.time().'.'.$extension;
                $arr['logo'] = optional($request->file('logo'))->storeAs('images/company', $fileName);
            }
            if ($request->hasFile('cover')) {
                $originName = $request->file('cover')->getClientOriginalName();
                $fileName = pathinfo($originName, PATHINFO_FILENAME);
                $extension = $request->file('cover')->getClientOriginalExtension();
                $fileName = $fileName .'_'.time().'.'.$extension;
                $arr['cover'] = optional($request->file('cover'))->storeAs('images/company', $fileName);
            }

            Company::create($arr);
            DB::commit();
            return $this->successResponse();
        } catch (Throwable $e) {
            DB::rollBack();
            return $this->errorResponse($e->getMessage());
        }
    }


}
