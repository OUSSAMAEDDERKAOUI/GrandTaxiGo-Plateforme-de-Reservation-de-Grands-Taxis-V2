<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Laravel\Socialite\Facades\Socialite;
use App\Models\User;
use Exception;
use Illuminate\Support\Facades\Hash;

class SocialiteController extends Controller
{

    public function redirectToGoogle()
    {

        return Socialite::driver('google')->redirect();
    }

    public function handleGoogleCallback()
    {
        try {
            $user = Socialite::driver('google')->user();

            $findUser = User::where('social_id', $user->id)->first();

            if ($findUser) {

                Auth::login($findUser);
                return redirect('/');
            } else {


               
                $newUser = User::create([
                    'f_name' => $user->user['given_name'],
                    'l_name' => $user->user['family_name'],
                    'location'=>'Aucune adresse',
                    'email' => $user->email,
                    'social_id' => $user->id,
                    'profile_picture' => $user->avatar,
                    'password' => Hash::make('oussama98@'),
                ]);
// dd($user);
                Auth::login($newUser);
                return response()->json($newUser);
            }
        } catch (Exception $e) {

            dd($e->getMessage());
        }
    }
}