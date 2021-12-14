<?php
namespace App\Repositories;

use App\User;

class UserRepository
{
	public function __construct(
		User $user
	) {
		$this->user = $user;
	}

	public function getByID($id)
	{
		return $this->user->find($id);
	}

	public function save($user)
	{
		return $user->save();
	}
}

