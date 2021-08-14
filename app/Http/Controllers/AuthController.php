<?php

namespace App\Http\Controllers;

use App\Http\Requests\LoginRequest;
use App\Models\Admin;
use App\Models\User;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Response;
use Illuminate\Validation\Rules\Password;
use Throwable;

class AuthController extends Controller
{
	public function test()
	{
		return 'Admin';
	}

	public function register(Request $request): JsonResponse
	{
		try {
			$request->validate([
				'name' => 'required|string|max:255',
				'email' => 'required|string|email|max:255|unique:users',
				'password' => ['required', Password::defaults()],
				'confirm_password' => 'required|same:password',
				// 'agree_to_terms' => 'in:true'
			]);

			DB::beginTransaction();

			if ($request->is_admin) {
				$user = Admin::create([
					'name' => $request->name,
					'email' => $request->email,
					'password' => Hash::make($request->password),
				]);
			} else {
				$user = User::create([
					'name' => $request->name,
					'email' => $request->email,
					'password' => Hash::make($request->password),
				]);
			}


			$token = $user->createToken('authtoken');
			DB::commit();
			return Response::json(
				[
					'message' => 'User Registered',
					'data' => ['token' => $token->plainTextToken, 'user' => $user->id]
				],
				200
			);
		} catch (Throwable $th) {
			DB::rollBack();
			return Response::json(
				[
					'message' => $th->getMessage()
				],
				400
			);
		}
	}

	public function loginAsVendor(LoginRequest $request): JsonResponse
	{
		try {
			$vendor = $request->authenticateVendor();

			$token = $vendor->createToken('authtoken', ['role:vendor']);

			return Response::json(
				[
					'message' => 'User Login Successfully',
					'data' => [
						'user' => $vendor->id,
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

	public function loginAsAdmin(LoginRequest $request): JsonResponse
	{
		try {
			$admin = $request->authenticateAdmin();

			$token = $admin->createToken('authtoken', ['role:admin']);

			return Response::json(
				[
					'message' => 'User Login Successfully',
					'data' => [
						'user' => $admin->id,
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

	public function logout(Request $request): JsonResponse
	{
		$request->user()->tokens()->delete();

		return Response::json(
			[
				'message' => 'Logged out',
				'data' => [
					'user' => $request->user()->id
				]
			],
			200
		);
	}
}
