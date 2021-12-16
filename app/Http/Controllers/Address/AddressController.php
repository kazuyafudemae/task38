<?php

namespace App\Http\Controllers\Address;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\AddressRequest;
use App\Address;
use App\User;

class AddressController extends Controller
{
    public function __construct(
		Address $address
    ) {
		$this->address = $address;
    }
    //住所一覧画面
    public function index()
    {
        $addresses = optional(Address::where('user_id', Auth::id()))->get();
        $address_id = optional(Auth::user())->address_id;
        return view('Address.index', compact('addresses', 'address_id'));
    }

	public function showAddForm()
	{
		$prefs = config('pref');
		return view('Address.add', compact('prefs'));
	}

	public function add(AddressRequest $request)
	{
		$this->address->user_id = Auth::id();
		$this->address->name = $request->name;
		$this->address->first_code = $request->first_code;
		$this->address->last_code = $request->last_code;
		$this->address->state = $request->state;
		$this->address->city = $request->city;
		$this->address->street = $request->street;
		$this->address->tel = $request->tel;
		$this->address->save();
		set_message('住所が追加されました。');
		return $this->index();
	}

	public function showEditForm($id)
	{
		dd($id);
		$addresses = $this->address->find($id);
		if (!$address || $address->user_id !== Auth::id()) {
			set_message('不正なアクセスです', false);
			return $this->index();
		}
		$prefs = config('pref');
		return view('Address.edit', compact('address', 'prefs'));
	}

	public function edit(AddressRequest $request, $id) {
		$address = $this->address->find($id);
		if (!$address) {
			set_message('住所が存在しません', false);
		} elseif ($address->user_id !== Auth::id()) {
			set_message('この住所は編集できません', false);
		} else {
			$this->address->name = $request->name;
			$this->address->first_code = $request->first_code;
			$this->address->last_code = $request->last_code;
			$this->address->state = $request->state;
			$this->address->city = $request->city;
			$this->address->street = $request->street;
			$this->address->tel = $request->tel;
			$this->address->save();
			set_message('住所が更新されました。');
			return $this->index();
		}
	}
}
