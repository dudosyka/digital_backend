<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class MainController extends Controller
{
    public function json($msg, $http_code) {
        header('Http-Code: ' . $http_code);
        return json_encode($msg);
    }

    public function authenticate(Request $request): false | string
    {
        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);

        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();

            return $this->json('Success', 200);
        }

        return $this->json('Failed', 403);
    }
}
