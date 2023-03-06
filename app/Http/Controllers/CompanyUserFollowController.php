<?php

namespace App\Http\Controllers;

use App\Http\Requests\UserFollowCompanyRequest;
use App\Http\Requests\UserUnFollowCompanyRequest;
use App\Models\User;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Throwable;

class CompanyUserFollowController extends Controller
{
    use ResponseTrait;

    public function follow(UserFollowCompanyRequest $request, $companyId): JsonResponse
    {
        DB::beginTransaction();
        try {
            $data = $request->validated();
            $checkPost = User::checkFollow($companyId);
            if ($checkPost) {
                return $this->errorResponse();
            } else {
                user()->followCompany()->attach($data);
                DB::commit();
                return $this->successResponse();
            }
        } catch (Throwable $e) {
            DB::rollback();
            return $this->errorResponse($e->getMessage());
        }
    }

    public function unFollow (UserUnFollowCompanyRequest $request ,$companyId): JsonResponse
    {
        try {
            $data = $request->validated();
            $isFollow = User::checkFollow($companyId);
            if ($isFollow) {
                user()->followCompany()->detach($data);
                return $this->successResponse();
            }
            return $this->errorResponse();
        } catch (Throwable $e) {
            return $this->errorResponse($e->getMessage());
        }
    }
}
