<?php

namespace App\Http\Controllers\Applicant;

use App\Enums\FileTypeEnum;
use App\Enums\TimelineTypeEnum;
use App\Http\Controllers\Controller;
use App\Http\Controllers\ResponseTrait;
use App\Http\Requests\applicant\StoreExperienceRequest;
use App\Http\Requests\applicant\UpdateCvRequest;
use App\Models\Company;
use App\Models\Experience;
use App\Models\File;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Throwable;

class CvManageController extends Controller
{
    use ResponseTrait;

    public function index()
    {
        $title = 'My CV';
        $userInfo = user();
        $file = $userInfo->fileCv;
        $timelineEdu = $userInfo->education;
        $timeLineType = TimelineTypeEnum::asArray();
        return view('applicant.cvManage', [
            'file' => $file,
            'title' => $title,
            'userInfo' => $userInfo,
            'timelineEdu' => $timelineEdu,
            'timeLineType' => $timeLineType,
        ]);
    }

    public function updateFileCv(UpdateCvRequest $request): JsonResponse
    {
        DB::beginTransaction();
        try {
            $fileExist = File::where([
                'user_id' => user()->id,
                'type' => FileTypeEnum::CV,
            ])->first();
            $validated = $request->validated();
            function handlerStoreFile($validated): array
            {
                $originName = $validated['cv']->getClientOriginalName();
                $fileName = pathinfo($originName, PATHINFO_FILENAME);
                $extension = $validated['cv']->getClientOriginalExtension();
                $fileStore = $fileName . '_' . time() . '.' . $extension;
                $fileName = $fileName . '.' . $extension;
                $linkStore = optional($validated['cv'])->storeAs('file/cv/u_' . user()->id, $fileStore);
                return array(
                    'name' => $fileName,
                    'link' => $linkStore,
                );
            }

            if (is_null($fileExist)) {
                $fileData = handlerStoreFile($validated);
                $fileData['type'] = FileTypeEnum::CV;
                $data = File::create($fileData)
                    ->first();
                DB::commit();
                return $this->successResponse($data);
            } else {
                $linkFile = $fileExist->link;
                if (Storage::exists($linkFile)) {
                    Storage::delete($linkFile);
                }
                $fileData = handlerStoreFile($validated);
                $file = File::where([
                    'user_id' => user()->id,
                    'type' => FileTypeEnum::CV,
                ]);
                $file->update($fileData);
                $data = $file->first();
                DB::commit();
                return $this->successResponse($data);
            }
        } catch (Throwable $e) {
            DB::rollback();
            return $this->errorResponse($e->getMessage());
        }
    }

    public function destroyFileCv($fileId): JsonResponse
    {
        DB::beginTransaction();
        try {
            $file = File::find($fileId);
            $fileStorageLink = $file->link;
            if (Storage::exists($fileStorageLink)) {
                Storage::delete($fileStorageLink);
            }
            $file->destroy();
            DB::commit();
            return $this->successResponse();
        } catch (Throwable $e) {
            DB::rollback();
            return $this->errorResponse($e->getMessage());
        }
    }

    public function getExperience(Request $request)
    {

    }

    public function storeExperience(StoreExperienceRequest $request): JsonResponse
    {
        DB::beginTransaction();
        try {
            $rsData = $request->validated();
            $companyName = $rsData['title'];
            if (!empty($companyName)) {
                $rsData['company_id'] = Company::firstOrCreate(['name'=>$companyName])->id;
            }
            $data = Experience::create($rsData)->first();
            DB::commit();
            return $this->successResponse($data);
        } catch (Throwable $e) {
            DB::rollback();
            return $this->errorResponse($e->getMessage());
        }
    }
}
