<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Laravel\Socialite\Facades\Socialite;


class HubSpotLoginController extends Controller
{
    public function redirectToHubSpot()
    {
        return Socialite::driver('hubspot')->redirect();
    }

    public function handleHubSpotCallback()
    {
        $hubSpotUser = Socialite::driver('hubspot')->user();

        return redirect()->route('home');
    }

}
