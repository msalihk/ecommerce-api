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

        return new UserResource($user);
    }

    public function login(LoginRequest $request)
    {
        $creditentials = $request->validated();

        $user = User::where('email', $creditentials["email"])->first();

        if (! $user || ! Hash::check($creditentials["password"], $user->password)) {
            throw ValidationException::withMessages([
                'email' => ['The provided credentials are incorrect.'],
            ]);
        }

        return $user->createToken("myToken")->plainTextToken;
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
