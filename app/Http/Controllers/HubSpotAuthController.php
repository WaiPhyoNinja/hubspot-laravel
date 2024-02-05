<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use League\OAuth2\Client\Provider\GenericProvider;
use League\OAuth2\Client\Provider\Exception\IdentityProviderException;


class HubSpotAuthController extends Controller
{
    public function redirectToHubSpot()
    {
        $provider = new GenericProvider([
            'clientId' => config('services.hubspot.client_id'),
            'clientSecret' => config('services.hubspot.client_secret'),
            'redirectUri' => config('services.hubspot.redirect'),
            'urlAuthorize' => 'https://app.hubspot.com/oauth/authorize',
            'urlAccessToken' => 'https://api.hubapi.com/oauth/v1/token',
            'urlResourceOwnerDetails' => 'https://api.hubapi.com/oauth/v1/access-tokens',
        ]);

        $authorizationUrl = $provider->getAuthorizationUrl();

        session(['oauth2state' => $provider->getState()]);

        return redirect($authorizationUrl);
    }

    public function handleCallback(Request $request)
    {
        $provider = new GenericProvider([
            'clientId' => config('services.hubspot.client_id'),
            'clientSecret' => config('services.hubspot.client_secret'),
            'redirectUri' => config('services.hubspot.redirect'),
            'urlAuthorize' => 'https://app.hubspot.com/oauth/authorize',
            'urlAccessToken' => 'https://api.hubapi.com/oauth/v1/token',
            'urlResourceOwnerDetails' => 'https://api.hubapi.com/oauth/v1/access-tokens',
        ]);

        if (!$request->has('code') || !$request->has('state')) {
            throw new \RuntimeException('Invalid callback request. Missing code or state.');
        }

        if (!$request->has('state') || $request->session()->get('oauth2state') !== $request->get('state')) {
            $request->session()->forget('oauth2state');
            throw new \RuntimeException('Invalid state.');
        }

        try {
            $accessToken = $provider->getAccessToken('authorization_code', [
                'code' => $request->get('code'),
            ]);

            // You can use $accessToken to make API requests to HubSpot on behalf of the user.

            return redirect()->route('dashboard')->with('success', 'HubSpot authentication successful.');
        } catch (IdentityProviderException $e) {
            return redirect()->route('dashboard')->with('error', 'HubSpot authentication failed: ' . $e->getMessage());
        }
    }

}
