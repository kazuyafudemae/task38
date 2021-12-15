<?php
namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Repositories\AddressRepository;
use App\Repositories\UserRepository;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\User;

class Address_sub extends Model
{
	use SoftDeletes;
	protected $dates = ['deleted_at'];

	/**
	 * The attributes that are mass assignable.
	 *
	 * @var array
	 */
	protected $fillable = [
		'user_id',
		'name',
		'first_code',
		'last_code',
		'state',
		'city',
		'street',
		'tel',
	];



	public function __construct(
		User $user
	) {
		$this->user = $user;
	}

	public function getAll()
	{
		return $this->where('user_id', Auth::id())->get();
	}

	public function getByID($id)
	{
		return $this->find($id);
	}

	public function store($request)
	{
		$this->user_id = Auth::id();
		$this->name = $request->name;
		$this->first_code = $request->first_code;
		$this->last_code = $request->last_code;
		$this->state = $request->state;
		$this->city = $request->city;
		$this->street = $request->street;
		$this->tel = $request->tel;
		$this->save();
		set_message('住所が追加されました。');
	}

	public function edit($request, $id)
	{
		$address = $this->find($id);
		if (!$address) {
			set_message('住所が存在しません。', false);
		} elseif ($this->user_id != Auth::id()) {
			set_message('この住所は編集出来ません。', false);
		} else {
			$this->name = $request->name;
			$this->first_code = $request->first_code;
			$this->last_code = $request->last_code;
			$this->state = $request->state;
			$this->city = $request->city;
			$this->street = $request->street;
			$this->tel = $request->tel;
			$this->save();
			set_message('住所情報が変更されました。');
		}
	}

	public function delete($request)
	{
		$address_id = $request->input('address_id');
		$address = $this->find($address_id);
		if (!$address) {
			set_message('該当する項目が見つかりませんでした。', false);
		} elseif ($this->user_id != Auth::id()) {
			set_message('この住所は削除出来ません。', false);
		} else {
			$this->delete($address);
			set_message('住所が削除されました。');
		}
	}

	public function save($request)
	{
		$id = $request->input('address_id');
		$address = $this->find($id);
		if (!$address) {
			set_message('お届け先が存在しません。', false);
		} elseif ($this->user_id != Auth::id()) {
			set_message('この住所は登録出来ません。', false);
		} else {
			$user = $this->user->find($this->user_id);
			$user->address_id = $id;
			$this->user->save($user);
			set_message('お届け先住所が変更されました。');
		}
	}
}
