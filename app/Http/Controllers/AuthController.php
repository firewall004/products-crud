<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules\Password;

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

	public function login(Request $request)
	{
	}

	public function logout(Request $request)
	{
	}
}
