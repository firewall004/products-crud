<?php

namespace App\Http\Requests;

use App\Models\Admin;
use App\Models\User;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;

class LoginRequest extends FormRequest
{
	/**
	 * Determine if the user is authorized to make this request.
	 *
	 * @return bool
	 */
	public function authorize()
	{
		return true;
	}

	/**
	 * Get the validation rules that apply to the request.
	 *
	 * @return array
	 */
	public function rules()
	{
		return [
			'email' => 'required|string|email',
			'password' => 'required|string',
		];
	}

	public function authenticateAdmin(): Admin
	{
		$admin = Admin::where('email', $this->email)->first();

		if (!$admin || !Hash::check($this->password, $admin->password)) {
			throw ValidationException::withMessages([
				'email' => __('auth.failed'),
			]);
		}

		return $admin;
	}

	public function authenticateVendor(): User
	{
		$vendor = User::where('email', $this->email)->first();
		if (!$vendor || !Hash::check($this->password, $vendor->password)) {
			throw ValidationException::withMessages([
				'email' => __('auth.failed'),
			]);
		}

		return $vendor;
	}
}
