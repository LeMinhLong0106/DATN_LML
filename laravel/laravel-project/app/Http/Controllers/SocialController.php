<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\KhachHang;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Laravel\Socialite\Facades\Socialite;

class SocialController extends Controller
{
    
    public function redirectToProvider()
    {
        // return Socialite::driver('google')->stateless()->redirect();
        $url =  Socialite::driver('google')->stateless()->redirect()->getTargetUrl();
        return response()->json([
            'url' => $url,
        ], 201);
    }

    public function handleProviderCallback()
    {
        // $user = Socialite::driver('google')->stateless()->user();
        $user = Socialite::driver('google')->stateless()->user(); //lay thong tin user
        $appUser = KhachHang::where('email', $user->email)->first(); //kiem tra xem user da ton tai chua
        
        if ($appUser) {
            // Auth::login($appUser); //neu ton tai thi dang nhap
            // $appUser->token = $appUser->createToken('loginGG')->accessToken;
            // return 'da ton tai';
        } else {
            $appUser = KhachHang::create([ //tao user moi
                'tenkh' => $user->name,
                'diachi' => 'diachi',
                'sdt' => 'sdt',
                'email' => $user->email,
                'google_id' => $user->id,
                'matkhau' => Hash::make('12345678'),
            ]);
            // Auth::login($newUser);
            // return redirect('/');
        }
        $pass = $appUser->createToken('loginGG')->accessToken;
        return response()->json([
            'access_token' => $pass,
            'user' => $appUser,
        ], 201);
    }

    // public function social($provider) {
    //     $auth = Socialite::driver($provider)->stateless()->user();
    //     $email = $auth->getEmail();
    //     $avatar = $auth->getAvatar();
    //     return response()->json(compact('token', 'avatar'));
    // }
}
