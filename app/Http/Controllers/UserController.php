<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Nette\Schema\ValidationException;

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

    public function signup(Request $request) {
//        $res = $request->validate([
//            'name' => 'required',
//            'surname' => 'required',
//            'patronymic' => 'required',
//            'login' => 'required',
//            'email' => 'required',
//            'password' => 'required|min:6',
//            'password_repeat' => 'required',
//        ]);
//        if ($res->fails()) {
//            dd($res);
//        }
        return User::reg($request->all());
    }

    public function profile(Request $request) {
        return $request->user();
    }
}
