<?php

namespace App\Http\Controllers\Admin\Item;

use App\Item;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\ItemRequest;

class EditController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */


	public function __construct()
	{
		$this->middleware('auth:admin')->except('logout');
	}



    public function showEditForm(Request $request)
    {
		if (isset($request->id)) {
			$items = Item::find($request);
			return view('Admin.Item.edit', ['items' => $items]);
		} else {
			$items = Item::all();
			return view('Admin.Item.index', ['items' => $items]);
		}
    }

	public function edit(ItemRequest $request)
	{
		if (isset($request->id)) {
			$item = Item::find($request->id);
			$item->fill($request->except('id'));
			$item->save();
			$items = [$item];
			return view('Admin.Item.detail', ['items' => $items]);
		} else {
			$items = Item::all();
			return view('Admin.Item.index', ['items' => $items]);
		}
	}
}
