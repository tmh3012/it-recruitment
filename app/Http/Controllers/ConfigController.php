<?php

namespace App\Http\Controllers;

use App\Http\Requests\ConfigRequest;
use App\Http\Requests\StoreConfigRequest;
use App\Http\Requests\UpdateConfigRequest;
use App\Models\Config;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\View;

class ConfigController extends Controller
{
    public object $model;
    public string $table;

    use ResponseTrait;

    public function __construct()
    {
        $this->model = Config::query();
        $this->table = (new Config)->getTable();

        View::share('table', $this->table);
        View::share('title', $this->table);
    }

    public function apiIndex(): JsonResponse
    {
        $data = $this->model
            ->where('is_public', '=', 1)
//            ->orderByDesc('key')
            ->get();
        return $this->successResponse($data);
    }

    public function index()
    {
        return view("admin.$this->table.index");
    }

    public function store(ConfigRequest $request): JsonResponse
    {
        $data = $request->validated();
        $data['is_public'] = 1;

        DB::beginTransaction();
        try {
            Config::create($data);
            DB::commit();
            return $this->successResponse($data);
        } catch (\Throwable $e) {
            DB::rollBack();
            return $this->errorResponse($e->getMessage());
        }
    }

    public function edit($key): JsonResponse
    {
        $data = $this->model
            ->where(function ($q) use ($key) {
                $q->where('is_public', '=', 1);
                $q->where('key', '=', $key);
            })
            ->firstOrFail();
        return $this->successResponse($data);
    }

    public function update(UpdateConfigRequest $request): JsonResponse
    {
        $data = $request->validated();
        $key = $data['key'];
        DB::beginTransaction();
        try {
            $config = $this->model
                ->where('key', '=',$key);
            $config->update($data);
            DB::commit();
            return $this->successResponse($data);
        } catch (\Throwable $e) {
            return $this->errorResponse($e->getMessage());
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }


    /**
     * Display the specified resource.
     *
     * @param \App\Models\Config $config
     * @return \Illuminate\Http\Response
     */
    public function show(Config $config)
    {
        //
    }


    /**
     * Remove the specified resource from storage.
     *
     * @param \App\Models\Config $config
     * @return \Illuminate\Http\Response
     */
    public function destroy(Config $config)
    {
        //
    }
}
