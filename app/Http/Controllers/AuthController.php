<?php

namespace App\Http\Controllers;

use App\Enums\UserRoleEnum;
use App\Enums\UserTypeEnum;
use App\Models\Company;
use App\Models\User;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;
use Laravel\Socialite\Facades\Socialite;

class AuthController extends Controller
{
    use ResponseTrait;

    public function login()
    {
        if (auth()->check()) {
            $role = strtolower(UserRoleEnum::getKey(user()->role));
            return redirect()->route(checkRouteForRole("${role}.index"));
        }
        return view('auth.login');
    }

    public function handlerLogin(Request $request): JsonResponse
    {
        try {
            $credentials = $request->validate([
                'email' => ['required', 'email', ' exists:users'],
                'password' => ['required', 'min:8'],
            ]);

            if (Auth::attempt($credentials)) {
                $request->session()->regenerate();
                $getRole = (auth()->user()->role);
                $role = strtolower(UserRoleEnum::getKey($getRole));
                $urlReddit = $request->get('urlReddit') ?? route(checkRouteForRole("${role}.index"));
                return $this->successResponse($urlReddit);
            } else {
                $errorMessage = __('frontPage.errorAuthLogin');
                return $this->errorResponse($errorMessage);
            }
        } catch (\Throwable $e) {
            return $this->errorResponse($e->getMessage());
        }
    }

    public function callback($provider): RedirectResponse
    {
        $data = Socialite::driver($provider)->user();
        $user = User::query()
            ->where('email', $data->getEmail())
            ->first();
        $checkExist = true;

        if (is_null($user)) {
            $user = new User();
            $user->email = $data->getEmail();
            $user->role = UserRoleEnum::APPLICANT;
            $checkExist = false;
        }

        $user->name = $data->getName();
        $user->avatar = $data->getAvatar();
        $user->type = UserTypeEnum::OAUTH_USER;
        auth()->login($user, true);
        if ($checkExist) {
            $role = strtolower(UserRoleEnum::getKey($user->role));
            return redirect()->route(checkRouteForRole("${role}.index"));
        }
        return redirect()->route('sign-up');
    }

    public function signUp(Request $request)
    {
        if($request->isMethod('GET')) {
            if (auth()->check()) {
                $role = strtolower(UserRoleEnum::getKey(user()->role));
                return redirect()->route(checkRouteForRole("${role}.index"));
            }
            $roleRegister = UserRoleEnum::APPLICANT;
            return view('auth.sign-up', [
                'role' => $roleRegister,
            ]);
        } else {

            if (auth()->check()) {
                $infoUpdate = $request->validate([
                    'role' => [
                        'required',
                        Rule::in(UserRoleEnum::getRolesForRegister())
                    ],
                    'type' => [
                        'required',
                        Rule::in(UserTypeEnum::getKeys()),
                    ],
                    'password' => [
                        'required',
                        'min:8',
                        'required_with:password_confirmation',
                    ],
                    'password_confirmation' => [
                        'required',
                        'min:8',
                    ],
                ]);
                $infoUpdate['password'] = Hash::make($infoUpdate['password']);
                $role = strtolower(UserRoleEnum::getKey($infoUpdate['role']));
                User::query()
                    ->where('id', auth()->user()->id)
                    ->update([
                        'password' => $infoUpdate['password'],
                        'role' => $infoUpdate['role'],
                    ]);
                redirect()->route("${role}.index");
            } else {
                $data = $request->validate([
                    'name' => [
                        'required',
                        'string',
                    ],
                    'email' => [
                        'required',
                        'email:rfc,dns',
                        Rule::unique(User::class)
                    ],
                    'role' => [
                        'required',
                        Rule::in(UserRoleEnum::getRolesForRegister())
                    ],
                    'password' => [
                        'required',
                        'min:8',
                        'required_with:password_confirmation',
                    ],
                    'password_confirmation' => [
                        'required',
                        'min:8',
                    ],
                ]);
                $data['password'] = Hash::make($data['password']);
                $role = strtolower(UserRoleEnum::getKey($data['role']));
                $user = User::create($data);
                Auth::login($user);
                return redirect()->route("${role}.index");
            }
        }
    }

    public function register(Request $request)
    {
        if ($request->isMethod('GET')) {
            $roleRegister = UserRoleEnum::HR;
            return view('auth.register', [
                'role' => $roleRegister,
            ]);
        } else {
            DB::beginTransaction();
            try {
                $data = $request->validate([
                    'name' => [
                        'required',
                        'string',
                        'max:255',
                    ],
                    'email' => [
                        'required',
                        'email:rfc,dns',
                        Rule::unique(User::class)
                    ],
                    'gender' => [
                        'required',
                    ],
                    'role' => [
                        'required',
                        Rule::in(UserRoleEnum::getRolesForRegister())
                    ],
                    'password' => [
                        'required',
                        'min:8',
                        'required_with:password_confirmation',
                    ],
                    'password_confirmation' => [
                        'required',
                        'min:8',
                    ],
                ]);
                $rsCompany = $request->validate([
                    'company_name' => [
                        'required',
                        'string',
                        'max:255',
                    ], 'city' => [
                        'required',
                        'string',
                    ],
                    'district' => [
                        'required',
                        'string',
                    ],
                ]);
                $rsCompany['name'] = $rsCompany['company_name'];
                $company = Company::create($rsCompany);
                $data['password'] = Hash::make($data['password']);
                $data['company_id'] = $company->id;
                $user = User::create($data);
                Auth::login($user);
                DB::commit();
                return redirect()->route('hr.index');
            } catch (\Throwable $e) {
                DB::rollback();
                return back()->withErrors($e->getMessage())->withInput();
            }
        }
    }

    public function logout(Request $request): RedirectResponse
    {
        Auth::logout();
        return back();
    }
}
