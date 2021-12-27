<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UserEditRequest extends FormRequest
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
			'name' => ['required', 'max:50'],
			'email' => ['required', 'email'],
			'password' => ['required', 'confirmed', 'min:6', 'max:15'],
			'password_confirmation' => ['required'],
			'current_password' => ['required', 'min:6', 'max:15'],
        ];
    }

	public function messages()
	{
		return [
			'name.required' => '名前が入力されていません',
			'name.max' => '名前は50文字以内で入力してください',
			'email.required' => 'メールアドレスが入力されていません',
			'email.email' => 'メールアドレスの形式で入力してください',
			'password.required' => 'パスワードが入力されていません',
			'password.confirmed' => '確認用パスワードと一致していません',
			'password.min' => 'パスワードは6文字以上で入力してください',
			'password.max' => 'パスワードは15文字以内で入力してください',
			'password_confirmation.required' => 'パスワードが入力されていません',
			'current_password.required' => 'パスワードが入力されていません',
			'current_password.min' => 'パスワードは6文字以上で入力してください',
			'current_password.max' => 'パスワードは15文字以内で入力してください',
		];
	}
}
