<?php

namespace App\Http\Controllers\Applicant;

use App\Enums\EducationTypeEnum;
use App\Http\Controllers\Controller;
use App\Http\Controllers\ResponseTrait;
use App\Http\Requests\applicant\StoreEducationRequest;
use App\Http\Requests\applicant\UpdateEducationRequest;
use App\Models\Education;
use App\Models\User;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class EducationController extends Controller
{
    use ResponseTrait;

    public function getKey(): JsonResponse
    {
        $keys = EducationTypeEnum::getKeyWithLang();
        return response()->json($keys);
    }

    public function index(Request $request, $userId = null): JsonResponse
    {
        if (!empty($userId)) {
            $user = User::find($userId);
        } else {
            $user = user();
        }
        $id = $request->get('id');
        $data = [];
        if (isset($id)) {
            $data = $user->education()
                ->where('id', $id)
                ->first();
        } else {
            $type = EducationTypeEnum::getKeyWithLang();
            foreach ($type as $key => $value) {
                $data[$key] = $user->education()
                    ->where('type', $value)
                    ->get();
            }
        }
        return $this->successResponse($data);
    }

    private function getDataForType($type)
    {
        return user()->education()->where('type', $type)->get();
    }

    public function store(StoreEducationRequest $request): JsonResponse
    {
        try {
            $validated = $request->validated();
            Education::create($validated);
            $data = $this->getDataForType($validated['type']);
            return $this->successResponse($data);
        } catch (\Throwable $e) {
            return $this->errorResponse($e->getMessage());
        }
    }

    public function update(UpdateEducationRequest $request, $id): JsonResponse
    {
        try {
            $validated = $request->validated();
            $model = Education::find($id);
            $model->update($validated);
            $data = $this->getDataForType($validated['type']);
            return $this->successResponse($data);
        } catch (\Throwable $e) {
            return $this->errorResponse($e->getMessage());
        }
    }

    public function destroy($id): JsonResponse
    {
        $validated = Education::where('id', $id)->exists();
        if(!$validated) {
            return $this->errorResponse('The data not found in system !');
        }
        Education::destroy($id);
        return $this->successResponse();
    }
}
