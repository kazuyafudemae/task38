<?php

namespace App\Http\Contrrollers\Admin\Item;

use App\Item;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\ItemRequest;

class RegisterController extends Controller
{

	public function __construct()
	{
		$this->middleware('guest:admin')->except('logout');
	}


	public function showRegisterForm()
	{
		return view('Item.register');
	}

	public function register(ItemRequest $request)
	{
		return Item::create([
			'postal_code' => $request['postal_code'],
			'pre_name' => $request['pre_name'],
			'city_name' => $request['city_name'],
			'block_name' => $request['block_name'],
			'tel_number' => $request['tel_number'],
		]);

		return view('Item.index');
	}
}

