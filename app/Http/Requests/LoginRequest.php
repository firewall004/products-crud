<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;
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

	public function authenticate(): void
	{
		if (!Auth::attempt($this->only('email', 'password'), $this->boolean('remember'))) {
			throw ValidationException::withMessages([
				'email' => __('auth.failed'),
			]);
		}
	}
}
