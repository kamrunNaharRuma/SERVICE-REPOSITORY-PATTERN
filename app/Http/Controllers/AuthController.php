<?php

namespace App\Http\Controllers;

use App\Constants\UserTypeConstant;
use App\Http\Responses\ApiResponse;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Symfony\Component\HttpFoundation\Response;

class AuthController extends Controller
{
    //
    public function register(Request $request)
    {
        return User::create([
            'name' => $request->input('name'),
            'email' => $request->input('email'),
            'password' => Hash::make($request->input('password')),
            'user_type_id' => UserTypeConstant::USER_TYPE_ID_FOR_USERS,
        ]);
    }


    public function login(Request $request)
    {
        if (!Auth::attempt($request->only('email', 'password'))) {
            return Response(
                [
                    "message" => "Invalid credentials!"
                ],
                Response::HTTP_UNAUTHORIZED
            );
        }
        $user = Auth::user();
        $user = User::find($user['id']);
        $token = $user->createToken('token')->plainTextToken;
        $cookie = cookie('jwt', $token, 60 * 24);
        return response(["message" => "Successfully logged in", "token" => $token])->withCookie($cookie);
    }

    public function user()
    {
        return "authorized";
    }
}
