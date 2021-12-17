<?php

namespace App\Http\Controllers\Address;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\AddressRequest;
use App\Http\Requests\AddressEditRequest;
use Illuminate\Support\Facades\DB;
use App\Address;
use App\User;

class AddressController extends Controller
{
    public function __construct(
		Address $address,
		User $user
    ) {
		$this->address = $address;
		$this->user = $user;
		$this->middleware('auth:user');
    }
    //住所一覧画面
    public function index()
    {
        $addresses = Address::where('user_id', Auth::id())->get();
		$auth = Auth::id();
        return view('Address.index', compact('addresses', 'auth'));
    }

	public function showAddForm(Request $request)
	{
		$prefs = config('pref');
		$pre_url = url()->previous();
		if ($pre_url === "https://procir-study.site/Fudemae225/task36/blog/public/address/choice") {
			session(['pre_url' => $pre_url]);
			dump(session('pre_url'));
			return view('Address.add', compact('prefs'));
		}
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
		DB::beginTransaction();
		try {
			$this->address->save();
			$user = Auth::user();
			if ($user->address_id === null) {
				$user->address_id = $this->address->id;
				$user->save();
			}
			DB::commit();
		} catch (Exception $exception) {
			DB::rollBack;
			throw $exception;
		}
		set_message('住所が追加されました。');
		if (session('pre_url')) {
			session()->forget('pre_url');
			return $this->showChoiceForm();
		} else {
			return $this->index();
		}
	}

	public function showEditForm(Request $request)
	{
		$address = $this->address->find($request->id);
		if (!$address || $address->user_id !== Auth::id()) {
			set_message('不正なアクセスです', false);
			return $this->index();
		}
		$prefs = config('pref');
		return view('Address.edit', compact('address', 'prefs'));
	}

	public function edit(AddressEditRequest $request) {
		$address = $this->address->find($request->id);
		if (!$address) {
			set_message('住所が存在しません', false);
		} elseif ($address->user_id !== Auth::id()) {
			set_message('この住所は編集できません', false);
		} else {
			$address->name = $request->name;
			$address->first_code = $request->first_code;
			$address->last_code = $request->last_code;
			$address->state = $request->state;
			$address->city = $request->city;
			$address->street = $request->street;
			$address->tel = $request->tel;
			$address->save();
			set_message('住所が更新されました。');
			return $this->index();
		}
	}

	public function delete(Request $request)
	{
		$address_id = $request->address_id;
		$address = $this->address->find($address_id);
		$user = $this->user->find(Auth::id());
		if (!$address) {
			set_message('住所が見つかりませんでした', false);
		} elseif ($address->user_id !== Auth::id()) {
			set_message('この住所は削除できません', false);
		} else {
			DB::beginTransaction();
			try {
				$address->delete();
				if ($user->address_id === $address_id) {
					$user->address_id = null;
					$user->save();
				}
				DB::commit();
			} catch (Exception $exception) {
				DB::roleBack();
				throw $exception;
			}
		}
		return $this->index();
	}

    public function showChoiceForm()
    {
        $addresses = Address::where('user_id', Auth::id())->get();
		$auth = Auth::id();
        return view('Address.choice', compact('addresses', 'auth'));
    }

	public function choice(Request $request)
	{
		$id = $request->address_id;
		$address = Address::find($id);
		if (!$address) {
			set_message('お届け先が存在しません。', false);
		} elseif ($address->user_id != Auth::id()) {
			set_message('この住所は登録出来ません。', false);
		} else {
			$user = Auth::user();
			$user->address_id = $id;
			$user->save();
			set_message('お届け先住所が変更されました。');
		}
		return $this->showChoiceForm();
	}
}
