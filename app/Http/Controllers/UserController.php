<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function auth(Request $request): bool|string
    {
        $data = $request->all();
        $res = User::auth($data['login'], $data['password']);
        if ($res === false) {
            return response()->json([
                'auth' => ['status' => 'failed', 'data'=>'', 'errors' => [
                    'login or password incorrect'
                ]],

            ]);
        }
        return response()->json([
            'auth' => [
                'status' => 'success',
                'data' => $res,
                'errors' => []
            ]
        ]);
    }

    public function profile(Request $request) {
        return $request->user();
    }
}
