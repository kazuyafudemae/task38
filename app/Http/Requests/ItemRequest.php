<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ItemRequest extends FormRequest
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
			'name' => ['required', 'max:190'],
			'explanation' => ['required', 'max:190'],
			'price' => ['required', 'numeric'],
			'stock' => ['required', 'numeric'],
		];
	}

	public function messages()
	{
		return [
			'name.required' => '商品名が入力されていません',
			'name.max' => '商品名は190文字以内で入力してください',
			'explanation.required' => '商品説明が入力されていません',
			'explanation.max' => '商品説明は190文字以内で入力してください',
			'price.required' => '値段が入力されていません',
			'price.numeric' => '値段は半角数字で入力してください',
			'stock.required' => '在庫数が入力されていません',
			'stock.numeric' => '在庫数は半角数字で入力してください',
		];
	}

}
