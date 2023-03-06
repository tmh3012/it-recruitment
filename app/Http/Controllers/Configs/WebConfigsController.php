<?php

namespace App\Http\Controllers\Configs;

use App\Enums\AppConfigTypeEnum;
use App\Http\Controllers\Controller;
use App\Http\Controllers\ResponseTrait;
use App\Http\Requests\storeConfigsWebRequest;
use App\Models\Config;
use App\Models\ConfigWeb;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\View;

class WebConfigsController extends Controller
{
    public object $model;
    public string $table;

    use ResponseTrait;

    public function __construct()
    {
        $this->model = ConfigWeb::query();
        $this->table = (new ConfigWeb)->getTable();

        View::share('table', $this->table);
        View::share('title', $this->table);
    }

    public function index()
    {
        $configs = Config::query()
            ->with('configsWeb')
            ->where([
                ['type', AppConfigTypeEnum::WEB_KEY],
            ])
            ->get();
        $counts = [];
        foreach ($configs as $config) {
            $counts[$config->key] = $config->configsWeb->count();
        }
        return view("admin.configs.web.index", [
            'configs' => $configs,
            'counts' => $counts,
        ]);
    }

    public function store(Request $request): JsonResponse
    {
        try {
            $rules = [
                '.*' => 'required|exists:configs,key',
                '*.*.key' => 'required|exists:configs,key',
                '*.*.name' => 'required|string',
                '*.*.description' => 'required|string',
                '*.*.image' => 'required|file|image|max:1024',
                '*.*.pin' => 'nullable',
                '*.*.is_display' => 'nullable',
            ];
            $messages = [
                'required' => 'The :attribute is required.',
                'string' => 'The :attribute must be type string.',
                'file' => 'The :attribute must be a file.',
                'size' => 'The :attribute max size 1 MB.',
                'exists:configs,key' => 'the ::attribute must be exists in column key of table configs',
            ];
            $attributes = [
                '*.*.key' => 'Key of Category',
                '*.*.name' => 'Name of items',
                '*.*.description' => 'Description of items',
                '*.*.image' => 'Image of items',
            ];
            $validator = Validator::make($request->all(), $rules, $messages, $attributes);
            if ($validator->fails()) {
                $errorMessage = $validator->errors()->messages();
                return $this->errorResponse($errorMessage);
            } else {
                $validated = $validator->validated();
                $data = [];
                foreach ($validated[array_key_first($validated)] as $each) {
                    // handler store image
//                if(array_key_exists('image', $each)) {
//                    $originName = $each['image']->getClientOriginalName();
//                    $fileName = pathinfo($originName, PATHINFO_FILENAME);
//                    $extension = $each['image']->getClientOriginalExtension();
//                    $fileName = $fileName .'_'.time().'.'.$extension;
//                    $each['value'] = optional($each['image'])->storeAs('images/config/report', $fileName);
//                }

                    if (isset($each['is_display'])) {
                        $each['is_display'] = $each['is_display'] == 'on' ? 1 : 0;
                    }

                    if (isset($each['pin'])) {
                        $each['pin'] = $each['pin'] == 'on' ? 1 : 0;
                    }

                    ConfigWeb::create($each);
                    $data[] = $each;
                }
                return $this->successResponse($data);
            }
        } catch (\Throwable $e) {
                return $this->errorResponse($e->getMessage());
        }
    }

    public function destroy($key,$id)
    {
        try {
            $this->model
                ->where([
                    'id' => $id,
                    'key' => $key,
                ])
                ->delete();
            return $this->successResponse();
        } catch (\Throwable $e) {
            return $this->errorResponse($e->getMessage());
        }
    }

    public function sortConfigItem()
    {

    }
}
