<?php

namespace App\Http\Controllers;

use App\FileUploadPath\userTypeConstant;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    //
    public function register(Request $request)
    {
        return User::create([
            'user' => $request->input('name'),
            'email' => $request->input('email'),
            'password' => Hash::make($request->input('password')),
            'user_type_id' => userTypeConstant::USER_TYPE_ID_FOR_USERS,
        ]);
    }
}
