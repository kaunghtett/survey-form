<?php

namespace App\Http\Controllers\API\V1\Auth;

use App\Http\Controllers\API\ApiController;
use App\Http\Controllers\Controller;
use App\Http\Requests\LoginRequest;
use App\Http\Requests\RegisterRequest;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use App\Services\User as UserService;

class AuthController extends ApiController
{
    //
    protected $user;

    public function __construct(UserService $user) 
    {
        $this->user = $user;
    }

    public function register(RegisterRequest $request) {

        $user =  $this->user->createUser($request->all());

        $token = $user->createToken('auth_token')->plainTextToken;

        return response()
            ->json(['user' => $user,'access_token' => $token, 'token_type' => 'Bearer', ]);
    }


    public function login(LoginRequest $request) {

        $user = User::where('email', $request->email)->first();
        if (!$user || !Hash::check($request->password, $user->password)) {
            return $this->respondNotFound('Invalid Credentails');
         }

        return response()->json([
            'user' => $user,
            'token' => $user->createToken('User-Token')->plainTextToken
        ]);
    }
}
