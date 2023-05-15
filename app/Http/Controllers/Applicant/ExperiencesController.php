<?php

namespace App\Http\Controllers\Applicant;

use App\Http\Controllers\Controller;
use App\Http\Controllers\ResponseTrait;
use App\Http\Requests\applicant\StoreExperienceRequest;
use App\Http\Requests\applicant\UpdateEducationRequest;
use App\Http\Requests\applicant\UpdateExperienceRequest;
use App\Models\Company;
use App\Models\Experience;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Throwable;

class ExperiencesController extends Controller
{
    use ResponseTrait;

    public function index(Request $request): JsonResponse
    {
        $id = $request->get('id');
        $experiences = user()->experiences()
            ->when(isset($id), function ($q) use ($id) {
                $q->where('id', $id);
            })
            ->get();
        if (isset($key)) {
            $experiences = $experiences->first();
        }
        return $this->successResponse($experiences);
    }

    protected function getFirstExperience($expId)
    {
        return user()->experiences()->where('id', $expId)->firstOrFail();
    }

    public function store(StoreExperienceRequest $request): JsonResponse
    {
        DB::beginTransaction();
        try {
            $rsData = $request->validated();
            $companyName = $rsData['title'];
            $isExist = Company::query()->checkCompanyExist($companyName);
            if ($isExist) {
                $rsData['company_id'] = Company::query()
                    ->where('name', 'like', "%$companyName%")
                    ->first()->id;
            }
            Experience::create($rsData);
            $data = user()->experiences;
            DB::commit();
            return $this->successResponse($data);
        } catch (Throwable $e) {
            DB::rollback();
            return $this->errorResponse($e->getMessage());
        }
    }

    public function update(UpdateExperienceRequest $request, $id): JsonResponse
    {
        DB::beginTransaction();
        try {
            $validated = $request->validated();
            $validated['user_id'] = User()->id;
            $companyName = $validated['title'];
            $isExist = Company::query()->checkCompanyExist($companyName);
            if ($isExist) {
                $validated['company_id'] = Company::query()
                    ->where('name', 'like', "%$companyName%")
                    ->first()->id;
            }
            $experience = Experience::find($id);
            $experience->update($validated);
            $data = user()->experiences;;
            DB::commit();
            return $this->successResponse($data);
        } catch (\Throwable $e) {
            DB::rollback();
            return $this->errorResponse($e->getMessage());
        }
    }

    public function destroy($id): JsonResponse
    {
        $validated = Experience::where('id', $id)->exists();
        if(!$validated) {
            return $this->errorResponse('The data not found in system !');
        }
        Experience::destroy($id);
        return $this->successResponse();
    }

}
