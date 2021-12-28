<?php

namespace App\Http\Controllers\User;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\AccountEditUserRequest;
use App\Http\Requests\AddressEditRequest;
use Illuminate\Support\Facades\DB;
use App\User;

class AccountController extends Controller
{
    public function __construct(
		User $user
		mailCheckUser $mail_check_user
    ) {
		$this->user = $user;
		$this->mail_check_user = $mail_check_user;
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

	public function send_check_mail()
	{
		$user = Auth::user();
		$token = $this->mail_check_users->token;
		Mail::to($this->mail_check_user->email)->send(new checkMail($token, $user));
	}

	public function store($request)
	{
		$token = uniqid(mt_rand(), true);
		$this->mail_check_user->name = $request->name;
		$this->mail_check_user->email = $request->email;
		$this->mail_check_user->password = $request->new_password;
		$this->mail_check_user->token = $token;
		$this->mail_check_user->save();
	}


}
