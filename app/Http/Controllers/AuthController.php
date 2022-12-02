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

    public function callback($provider): RedirectResponse
    {
        $data = Socialite::driver($provider)->user();
        $user = User::query()
            ->where('email', $data->getEmail())
            ->first();
        $checkExist = true;


        if (is_null($user)) {
            $user        = new User();
            $user->email = $data->getEmail();
            $user->role  = UserRoleEnum::APPLICANT;
            $checkExist  = false;
        }

//        $user->name   = $data->getName();
//        $user->avatar = $data->getAvatar();

        auth()->login($user, true);

        if ($checkExist) {
            $role = strtolower(UserRoleEnum::getKeys($user->role)[0]);
            return redirect()->route(" $role.welcome");
        }

        return redirect()->route('register');
    }

    public function registering(Request $request)
    {
       $password = Hash::make($request->get('password'));
       $role = $request->get('role');
       if(auth()->check()) {
           User::query()
           ->where('id',auth()->user()->id)
           ->update([
               'password' => $password,
               'role' => $role,
           ]);
       } else {
           $user = User::create([
               'name'=> $request->name,
               'email'=> $request->email,
               'password'=>$password,
               'role'=> $request->role,
           ]);
           Auth::login($user);
       }
    }

//    public function callback($provider): RedirectResponse
//    {
//        /*
//         * get data from provider
//         * get info user form database with email confirm email get form provider
//         * tạo biến cờ check user có tồn tại trong db
//         * nếu không tồn tại thì lấy thông tin user login qua auth để điền form sắn
//         * điều hướng qua trang đăng ký
//         * tồn tại người dùng thì điều hướng qua trang người dùng
//         *
//         */
//        $data = Socialite::driver('github')->user();
//
//        $user = User::query()
//            ->where('email', $data->getName())
//            ->first();
//        $checkExist = true;
//
//        if (is_null($user)) {
//            $user = new User();
//            $user->name = $data->getName();
//            $user->email = $data->getEmail();
//            $checkExist = false;
//            auth()->login($user, true);
//        }
//
//        if($checkExist) {
//            dd('444');
//        }
//        dd($user,$checkExist ,auth()->check());
//        return redirect()->route('register');
//    }

}
