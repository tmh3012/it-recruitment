<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreUserSocialNetworkRequest;
use App\Models\Social;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class UserSocialController extends Controller
{
    use ResponseTrait;

    private object $model;

    public function __construct()
    {
        if (!auth()->check()) {
            $response = $this->errorResponse(
                'You are not authenticated to access - 401 Unauthorized',
                401
            );
            throw new HttpResponseException($response);
//            throw new \Exception('You are not authenticated to access - 401 Unauthorized');
        }
        $this->model = Social::query();
    }


    public function getSocialNetwork($userId, $key = ''): JsonResponse
    {
        $data = $this->model
            ->where('user_id', $userId)
            ->when(!empty($key), function ($q) use ($key) {
                return $q->where('key', $key);
            })
            ->get();
        if ($data->isEmpty()) {
            $data = false;
        }
        if (!empty($key) && $data) {
            $data = $data->first();
        }
        return $this->successResponse($data);

    }

    public function handlerSocialNetwork(StoreUserSocialNetworkRequest $request, $userId): JsonResponse
    {
        try {
            DB::beginTransaction();
            $validated = $request->validated();
            $social = $this->model
                ->where(['user_id' => $userId, 'key' => $validated['key']])
                ->first();

            if (is_null($social)) {
                $social = new Social();
                $social->user_id = $userId;
                $social->key = $validated['key'];
                $social->save();
            }
            $social->update([
                'value' => $validated['value']
            ]);
            DB::commit();
            return $this->successResponse($social);
        } catch (\Throwable $e) {
            DB::rollback();
            return $this->errorResponse($e->getMessage());
        }
    }

    public function destroy($userId, $key): JsonResponse
    {
        $this->model
            ->where([
                'user_id' => $userId,
                'key' => $key,
            ])
            ->delete();
        return $this->successResponse(true);
    }


}
