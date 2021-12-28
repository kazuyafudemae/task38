<?php

namespace App\Http\Controllers\User;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\AddressRequest;
use App\Http\Requests\AddressEditRequest;
use Illuminate\Support\Facades\DB;
use App\Address;
use App\User;

class AccountController extends Controller
{
    public function __construct(
		Address $address,
		User $user
    ) {
		$this->address = $address;
		$this->user = $user;
		$this->middleware('auth:user');
    }


	public function showEditForm()
	{
		$user = Auth::user();
		return view('User.edit', compact('user'));
	}


	public function edit(AccountEditUserRequest $request) {
		$user = Auth::user();
		$newPwd = $request->new_password;

		if (Hash::check($newPwd, $user->password)) {
			// 一致したときの処理
			if ($user->email !== $request->email) {

			} else {

			}
		} else {
			// 一致しなかったときの処理
		}
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

	public function send_check_mail() {

}
