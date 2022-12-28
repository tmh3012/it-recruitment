<?php

namespace App\Http\Controllers;

use App\Enums\UserRoleEnum;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Laravel\Socialite\Facades\Socialite;

class AuthController extends Controller
{

    public function login()
    {
        return view('auth.login');
    }

    public function register()
    {
        $roles = UserRoleEnum::getRolesForRegister();

        return view('auth.register', [
            'roles' => $roles,
        ]);
    }

    public function handlerLogin(Request $request): RedirectResponse
    {
        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);


        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();
            $getRole = (auth()->user()->role);
            $role = strtolower(UserRoleEnum::getKey($getRole));
            return redirect()->route('admin.posts.index');
        } else {
            return back();
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

        auth()->login($user, true);
        if ($checkExist) {
            $role = strtolower(UserRoleEnum::getKey($user->role));
            return redirect()->route('admin.posts.index');
        }
        return redirect()->route('register');
    }

    public function registering(Request $request)
    {
        $password = Hash::make($request->get('password'));
        $role = $request->get('role');
        if (auth()->check()) {
            User::query()
                ->where('id', auth()->user()->id)
                ->update([
                    'password' => $password,
                    'role' => $role,
                ]);
        } else {
            $user = User::create([
                'name' => $request->name,
                'email' => $request->email,
                'password' => $password,
                'role' => $request->role,
            ]);
            Auth::login($user);
        }
    }

    public function logout(Request $request)
    {
        Auth::logout();
        return back();
    }


}
