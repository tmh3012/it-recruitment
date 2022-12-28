<?php

namespace App\Http\Controllers;

use App\Enums\FileTypeEnum;
use App\Http\Requests\HandlerSubmitCvRequest;
use App\Models\File;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Throwable;

class SubmitFormController extends Controller
{
    use ResponseTrait;

    public function handlerSubmitCv(HandlerSubmitCvRequest $request): JsonResponse
    {
        try {
            DB::beginTransaction();
            $data = $request->validated();
            $cv = optional($request->file('cv'));
            $fileName= preg_replace('/\s+/', '', 'applyForPost_'.$request->get('post_id').''.$cv->getClientOriginalName());
            $data['link'] = $cv->storeAs('candidate_file', $fileName);
            $data['type'] = FileTypeEnum::CV;
            File::create($data);
            DB::commit();
            return $this->successResponse();
        } catch (Throwable $e) {
            DB::rollBack();
            return $this->errorResponse($e->getMessage());
        }
    }
}
