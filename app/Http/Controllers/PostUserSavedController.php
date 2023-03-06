<?php

namespace App\Http\Controllers;

use App\Http\Requests\destroyPostUserSavedRequest;
use App\Http\Requests\storePostUserSavedRequest;
use App\Models\User;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Throwable;

class PostUserSavedController extends Controller
{
    use ResponseTrait;

    public function store(storePostUserSavedRequest $request, $postId): JsonResponse
    {
        DB::beginTransaction();
        try {
            $data = $request->validated();
            $checkPost = User::checkPostSaved($postId);
            if ($checkPost) {
                return $this->errorResponse(__('frontPage.postSavedDuplicate'));
            } else {
                user()->posts()->attach($data);
                DB::commit();
                return $this->successResponse();
            }
        } catch (Throwable $e) {
            DB::rollback();
            return $this->errorResponse($e->getMessage());
        }

    }

    public function destroy(destroyPostUserSavedRequest $request, $postId): JsonResponse
    {
        try {
            $data = $request->validated();
            $checkPost = User::checkPostSaved($postId);
            if ($checkPost) {
                user()->posts()->detach($data);
                return $this->successResponse();
            }
            return $this->errorResponse(__('frontPage.errorDestroyPostUser'));
        } catch (Throwable $e) {
            return $this->errorResponse($e->getMessage());
        }
    }

}
