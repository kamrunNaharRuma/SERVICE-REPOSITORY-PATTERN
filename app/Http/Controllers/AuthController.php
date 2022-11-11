<?php

namespace App\Http\Controllers;

use App\Constants\UserTypeConstant;
use App\Http\Responses\ApiException;
use App\Http\Responses\ApiResponse;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Contracts\Service\Attribute\Required;

class AuthController extends Controller
{
    //
    public function register(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required|email:rfc,dns',
            'password' => 'required',
        ]);
        try {
            $user =  User::create([
                'name' => $request->input('name'),
                'email' => $request->input('email'),
                'password' => Hash::make($request->input('password')),
                'user_type_id' => UserTypeConstant::USER_TYPE_ID_FOR_USERS,
            ]);
            return (new ApiResponse('Registered successfully', $user, Response::HTTP_CREATED, true))->getPayload();
        } catch (\Exception $e) {
            throw new ApiException($e->getMessage());
        }
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
        $cookie = cookie('jwt', $token, 60 * 1);
        return response(["message" => "Successfully logged in"])->withCookie($cookie);
    }
}
