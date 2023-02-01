<?php

namespace App\Http\Controllers;

use App\Http\Requests\LoginRequest;
use App\Http\Requests\StoreUserRequest;
use App\Http\Resources\UserResource;
use App\Models\User;
use App\Services\UserService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;
use Laravel\Sanctum\PersonalAccessToken;

class AuthController extends Controller
{
    public function store(StoreUserRequest $request, UserService $userService)
    {
        $user = $userService->store($request->validated());
        $token = $user->createToken('myapp-token')->plainTextToken;
        return response()->json([
           'user' => new UserResource($user),
           'token' => $token
        ]);
    }

    public function login(LoginRequest $request)
    {
        $credentials = $request->validated();

        $user = User::where('email', $credentials["email"])->first();

        if (! $user || ! Hash::check($credentials["password"], $user->password)) {
            throw ValidationException::withMessages([
                'email' => ['The provided credentials are incorrect.'],
            ]);
        }

        $token = $user->createToken("myToken")->plainTextToken;

        return response()->json([
            'user' => new UserResource($user),
            'token' => $token,
        ]);
    }

    public function logout(Request $request)
    {
        $token = PersonalAccessToken::findToken($request->bearerToken());
        if ($token) {
            $token->delete();
        }

        return response()->json(['success' => true]);
    }
}
