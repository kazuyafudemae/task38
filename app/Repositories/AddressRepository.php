<?php
namespace App\Repositories;

use App\Address;
use Illuminate\Support\Facades\Auth;

class AddressRepository
{

	public function __construct(
		Address $address
	) {
		$this->address = $address;
	}

	public function getAll()
	{
		return $this->address->where('user_id', Auth::id())->get();
	}

	public function getByID($id)
	{
		return $this->address->find($id);
	}

	public function save($address)
	{
		$address->save();
		// 作成した際にUserのaddress_idがnullの時にこのidを保存したいため、idを返す
		return $address->id;
	}

	public function destory($address)
	{
		return $address->delete();
	}

}

