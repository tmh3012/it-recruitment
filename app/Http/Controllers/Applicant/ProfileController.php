<?php

namespace App\Http\Controllers\Applicant;

use App\Http\Controllers\Controller;
use App\Http\Controllers\ResponseTrait;
use App\Http\Requests\StoreUserSocialNetworkRequest;
use App\Models\Language;
use App\Models\Social;
use App\Models\User;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class ProfileController extends Controller
{
//    private object $model;
    private object $user;
    use ResponseTrait;

    public function __construct()
    {
//        $this->model = User::query();
        if (isApplicant()) {
            $this->user = user();
        }

    }

    public function index()
    {
        $title = 'My Profile';
        $socials = $this->user->socials;
        return view('applicant.profile', [
            'title' => $title,
            'user' => $this->user,
            'socials' => $socials,
        ]);
    }
    public function getSkills($userId): JsonResponse
    {
        $user = User::find($userId);
        $data = $user->skills()->pluck('name')->toArray();
        return $this->successResponse($data);
    }

    public function updateSkills(Request $request): JsonResponse
    {
        try {
            DB::beginTransaction();
            $rules = [
                'user_id'=> [
                    'required',
                    'exists:users,id',
                ],
                'skills'=>[
                    'required',
                    'array',
                    'filled',
                ],
            ];
            $validator = Validator::make($request->all(), $rules);
            if($validator->fails()){
                $errorMessage = $validator->errors()->messages();
                return $this->errorResponse($errorMessage);
            }
            $validated = $validator->validated();
            $user = User::find($validated['user_id']);
            $skillId = [];
            foreach ($validated['skills'] as $skill){
                $skill = Language::firstOrCreate(['name' => $skill]);
                $skillId[] = $skill->id;
            }
            $user->skills()->sync($skillId);
            DB::commit();
            return $this->successResponse();
        } catch (\Throwable $e) {
            DB::rollback();
            return $this->errorResponse($e->getMessage());
        }
    }
}
