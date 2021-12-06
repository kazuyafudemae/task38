<?php

namespace App\Http\Controllers\Admin\Item;

use App\Item;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\ItemRequest;

class RegisterController extends Controller
{

	public function __construct()
	{
		$this->middleware('auth:admin')->except('logout');
	}


	public function showRegisterForm()
	{
		return view('Item.register');
	}

	public function register(ItemRequest $request)
	{
		return Item::create([
			'name' => $request['name'],
			'explanation' => $request['explanation'],
			'price' => $request['price'],
			'stock' => $request['stock'],
		]);

		return view('Item.index');
	}
}

