<?php

namespace App\Http\Controllers\admin;

use App\Enums\TimelineTypeEnum;
use App\Enums\UserRoleEnum;
use App\Enums\UserTypeEnum;
use App\Http\Controllers\Controller;
use App\Http\Controllers\ResponseTrait;
use App\Http\Requests\StoreUserSocialNetworkRequest;
use App\Http\Requests\User\UpdateUserInforRequest;
use App\Http\Requests\UserUpdateFileImageRequset;
use App\Models\Company;
use App\Models\Social;
use App\Models\User;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Str;

class UserController extends Controller
{
    private object $model;
    private string $table;
    use ResponseTrait;

    public function __construct()
    {
        $this->model = User::query();
        $this->table = (new User)->getTable();

        View::share('table', $this->table);
        View::share('title', $this->table);
    }

    public function index(Request $request)
    {
        // get select for filter
        $selectRole = $request->get('role');
        $selectCity = $request->get('city');
        $selectCompany = $request->get('company');


        $query = $this->model->clone()
            ->with('company:id,name')
            ->latest();

        if (!is_null($selectRole) and $selectRole !== 'all') {
            $query->where('role', $selectRole);
        }
        if (!is_null($selectCity) and $selectCity !== 'all') {
            $query->where('city', $selectCity);
        }
        if (!is_null($selectCompany) and $selectCompany !== 'all') {
            $query->whereHas('company', function ($q) use ($selectCompany) {
                return $q->where('id', $selectCompany);
            });
        }
        $data = $query->paginate(30)
            ->appends($request->all());


        //get data for filter
        $roles = UserRoleEnum::asArray();
        $cities = $this->model->clone()
            ->distinct()
            ->limit(100)
            ->whereNotNull('city')
            ->pluck('city');

        $companies = Company::query()
            ->get([
                'id',
                'name',
            ]);


        return view("admin.$this->table.index", [
            'data' => $data,
            'roles' => $roles,
            'cities' => $cities,
            'companies' => $companies,
            'selectRole' => $selectRole,
            'selectCity' => $selectCity,
            'selectCompany' => $selectCompany,
        ]);
    }

    public function update($userId, UpdateUserInforRequest $request): JsonResponse
    {
        DB::beginTransaction();
        try {
            $validated = $request->validated();
            $user = User::where('id', $userId);
            $user->update($validated);
            $data = $user->select([
                "id",
                "name",
                "phone",
                "link",
                "role",
                "bio",
                "position",
                "city",
                "gender",
               ])->first();
            DB::commit();
            return $this->successResponse($data);
        } catch (\Throwable $e) {
            DB::rollback();
            return $this->errorResponse($e->getMessage());
        }
    }

    public function updateFileImage($userId, UserUpdateFileImageRequset $request): JsonResponse
    {
        try {
            $user = $this->model
                ->where('id', $userId);

            $validated = $request->validated();
            $key = array_key_first($validated);
            $originName = $validated[$key]->getClientOriginalName();
            $fileName = pathinfo($originName, PATHINFO_FILENAME);
            $extension = $validated[$key]->getClientOriginalExtension();
            $fileName = $fileName . '_' . time() . '.' . $extension;
            $linkStore = optional($validated[$key])->storeAs('images/user/id_' . $userId, $fileName);

            $user->update([
                'type' => UserTypeEnum::DEFAULT_USER,
                $key => $linkStore,
            ]);
            return $this->successResponse(asset('storage/' . $linkStore));
        } catch (\Throwable $e) {
            return $this->errorResponse($e->getMessage());
        }
    }

    public function destroy($userId)
    {
        User::destroy($userId);
        return redirect()->back();
    }

}
