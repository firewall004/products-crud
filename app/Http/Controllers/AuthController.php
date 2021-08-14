<?php

namespace App\Http\Controllers;

use App\Http\Requests\LoginRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Response;
use Illuminate\Validation\Rules\Password;
use Throwable;

class AuthController extends Controller
{
	public function register(Request $request)
	{
		$request->validate([
			'name' => 'required|string|max:255',
			'email' => 'required|string|email|max:255|unique:users',
			'password' => ['required', Password::defaults()],
			'confirm_password' => 'required|same:password'
		]);

		$user = User::create([
			'name' => $request->name,
			'email' => $request->email,
			'password' => Hash::make($request->password),
		]);

		$token = $user->createToken('authtoken');

		return response()->json(
			[
				'message' => 'User Registered',
				'data' => ['token' => $token->plainTextToken, 'user' => $user->id]
			]
		);
	}

	public function login(LoginRequest $request)
	{
		try {
			$request->authenticate();

			$token = $request->user()->createToken('authtoken');

			return response()->json(
				[
					'message' => 'User Login Successfully',
					'data' => [
						'user' => $request->user()->id,
						'token' => $token->plainTextToken
					]
				]
			);
		} catch (Throwable $th) {
			return Response::json(
				[
					'message' => 'Invalid login'
				],
				401
			);
		}

	}

	public function logout(Request $request)
	{
	}
}
