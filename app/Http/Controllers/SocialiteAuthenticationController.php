<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Laravel\Socialite\Facades\Socialite;
use App\Models\User;
use App\Models\SocialiteAuthentication;

class SocialiteAuthenticationController extends Controller
{
    public function redirectToSteamLogin()
    {
        return Socialite::driver('steam')->redirect();
    }

    public function steamLoginAttempt()
    {
        $steamData = Socialite::driver('steam')->user();
        // dd($steamData);

        $user = User::find(auth()->user())->first();
        $socialite = new SocialiteAuthentication();

        $socialite->user_id = $user->id;
        $socialite->service = 'steam';
        $socialite->service_id = $steamData->id;
        $socialite->service_nickname = $steamData->nickname;
        $socialite->service_name = $steamData->name;
        $socialite->service_avatar = $steamData->avatar;

        $user->socialiteAuthentication()->save($socialite);


        // $user->socialite->_id = $steamData->id;
        // $user->steam_username = $steamData->nickname;
        // $user->steam_avatar = $steamData->avatar;

        // $user->save();
        return redirect()->to('/user/profile');
    }

    public function redirectToDiscordLogin()
    {
        return Socialite::driver('discord')->redirect();
    }

    public function discordLoginAttempt()
    {
        $discordData = Socialite::driver('discord')->user();
        // dd($discordData);

        $user = User::find(auth()->user())->first();
        $socialite = new SocialiteAuthentication();

        $socialite->user_id = $user->id;
        $socialite->service = 'discord';
        $socialite->service_id = $discordData->id;
        $socialite->service_nickname = $discordData->nickname;
        $socialite->service_name = $discordData->name;
        $socialite->service_avatar = $discordData->avatar;

        $user->socialiteAuthentication()->save($socialite);

        return redirect()->to('/user/profile');
    }
}
