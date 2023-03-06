<?php

namespace App\Http\Controllers\Configs;

use App\Enums\AppConfigTypeEnum;
use App\Http\Controllers\Controller;
use App\Http\Controllers\ResponseTrait;
use App\Http\Requests\ConfigRequest;
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
    private $append;
    private $configs;

    use ResponseTrait;

    public function __construct()
    {
        $this->model = Config::query();
        $this->table = (new Config)->getTable();

        View::share('table', $this->table);
        View::share('title', $this->table);
    }

    public function apiIndex(Request $request): JsonResponse
    {
        $type = $request->get('type');
        $data = $this->model
            ->where('is_public', 1)
            ->when(isset($type), function ($q) use ($type){
                $q->where('type',$type);
            })
            ->get();
        return $this->successResponse($data);
    }

    public function index()
    {
        $appKeyConfigs = AppConfigTypeEnum::asArray();
        return view("admin.$this->table.index",[
            'appKeyConfigs' => $appKeyConfigs,
        ]);
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
                ->where('key', '=', $key);
            $config->update($data);
            DB::commit();
            return $this->successResponse($data);
        } catch (\Throwable $e) {
            DB::rollback();
            return $this->errorResponse($e->getMessage());
        }
    }

}
