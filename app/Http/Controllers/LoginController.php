<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class LoginController extends Controller
{

    public function login()
    {
        return view('login');
    }

    public function store(Request $request)
    {
        $response = Http::post('http://13.228.129.87/oauth/token', [
            'username' => $request->username,
            'password' => $request->password,
            'grant_type' => 'password',
            'client_id' => env('CLIENT_ID'),
            'client_secret' => env('CLIENT_SECRET')
        ]);

        if ($response->successful()) {
            $responseData = $response->json();
            $accessToken = $responseData['access_token'];
            session(['access_token' => $accessToken]);
            $refreshToken = $responseData['refresh_token'];
            session(['refresh_token' => $refreshToken]);

            return redirect()->route('display.user');
        } else {
            return back()->withErrors(['error' => 'Invalid credentials']);
        }
    }

    public function logout()
    {
        session()->forget('access_token');

        session()->forget('refresh_token');

        return redirect()->route('login');
    }

}
