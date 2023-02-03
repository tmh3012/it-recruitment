<?php

namespace App\Http\Controllers\admin;

use App\Enums\UserRoleEnum;
use App\Http\Controllers\Controller;
use App\Models\Company;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\View;

class UserController extends Controller
{
    private object $model;
    private string $table;

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
            $query->whereHas('company', function ($q) use ($selectCompany)
            {
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
    public function destroy($userId)
    {
        User::destroy($userId);
        return redirect()->back();
    }
}
