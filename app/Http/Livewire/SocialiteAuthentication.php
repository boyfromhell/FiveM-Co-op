<?php

namespace App\Http\Livewire;

use Livewire\Component;
Use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SocialiteAuthentication extends Component
{
    // public $modalLinkSteamVisible = false;
    public $modalDisassociateSteamVisible = false;
    public $modalDisassociateDiscordVisible = false;

    public bool $isSteamLinked = false;
    public bool $isDiscordLinked = false;

    public function mount()
    {
        if(Auth::user()->getSocialiteAuthenticationByService)
        {
            $this->isSteamLinked = true;
        } else {
            $this->isSteamLinked = false;
        }
    }

    public function render()
    {
        return view('livewire.socialite-authentication', [
            'user' => auth()->user(),
        ]);
    }

    public function linkSteamAccount()
    {
        return redirect()->to('/socialite/steam/login');
    }

    public function linkDiscordAccount()
    {
        return redirect()->to('/socialite/discord/login');
    }

    public function removeSteamAccount()
    {
        dd('test');
    }
}
