<?php

namespace App\Http\Controllers;

use App\Enums\TimelineTypeEnum;
use App\Http\Requests\TimeLineRequest;
use App\Models\Timeline;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class TimelineController extends Controller
{
    use ResponseTrait;


    public function getTimeline($timeline, Request $request): JsonResponse
    {
        try {
            if (!auth()->check()) {
                $response = $this->errorResponse(
                    'You are not authenticated to access - 401 Unauthorized',
                    401
                );
                throw new \Exception('You are not authenticated to access - 401 Unauthorized');
            }

            if (!TimelineTypeEnum::hasKey(strtoupper($timeline))) {
                $response = $this->errorResponse(
                    "$timeline does not exist",
                    500
                );
                //                throw new HttpResponseException($response);
                throw new \Exception("$timeline does not exist");
            }

            $timelineId = $request->get('id');

            $data = user()->$timeline()
                ->when(isset($timelineId), function ($q) use ($timelineId) {
                    $q->where('id', $timelineId);
                })
                ->orderBy('end_date', 'DESC')
                ->get();
            if (isset($timelineId)) {
                $data = $data->first();
            }
            return $this->successResponse($data);
        } catch (\Throwable $e) {
            return $this->errorResponse($e->getMessage());
        }
    }

    public function storeTimeline(TimeLineRequest $request): JsonResponse
    {
        DB::beginTransaction();
        try {
            $validate = $request->Validated();
            $data = Timeline::create($validate)->first();
            DB::commit();
            return $this->successResponse();
        } catch (\Throwable $e) {
            DB::rollback();
            return $this->errorResponse($e->getMessage());
        }
    }

    public function updateTimeline($timelineCate, $id, TimeLineRequest $request): JsonResponse
    {
        DB::BeginTransaction();
        try {
            $validated = $request->validated();
            $timeline = user()->$timelineCate()
                ->where('id', $id);
            $timeline->update($validated);
            $data = $timeline->first();
            DB::commit();
            return $this->successResponse($data);
        } catch (\Throwable $e) {
            DB::rollback();
            return $this->errorResponse($e->getMessage());
        }
    }

    public function destroyTimeline($timelineCate,$id): jsonResponse
    {
        DB::BeginTransaction();
        try {
            $timeline = user()->$timelineCate()
                ->where('id', $id);
            $timeline->delete();
            DB::commit();
            return $this->successResponse();
        } catch (\Throwable $e) {
            DB::rollback();
            return $this->errorResponse($e->getMessage());
        }
    }
}
