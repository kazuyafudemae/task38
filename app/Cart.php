<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\facades\Auth;

class Cart extends Model
{
	use SoftDeletes;

	protected $dates = ['deleted_at'];

	protected $fillable = [
		'uesr_id',
		'item_id',
		'quantity',
	];

	protected $table = 'carts';

	//item() に_id をつけた外部キーが自動設定される
	public function item() {
		return $this->belongsTo('App\Item');
	}

	public function add_cart($item_id, $add_qty) {
		$item = (new item)->findOrFail($item_id);
		$qty = $item->quantity;
		if ($qty === 0) {
			return false;
		}

		$cart = $this->firstOrCreate(['user_id' => Auth::id(), 'item_id' =>$item_id]);
		DB::beginTransaction();
		try {
			$cart->increment('quantity', 'add_qty');
			$item->decrement('stock', 'add_qty');
			DB::commit;
			return true;
		} catch (Exception) {
			DB::rollback();
			return false;
		}
	}

	public function delete($cart_id) {
		$cart = $this->findOrCreate($cart_id);
		if ($cart->user_id == Auth::id()) {
			DB::beginTransaction();
			try {
				$item_id = $cart->item_id;
				$qty = $cart->quautity;
				$cart->delete();
				$item->increment('quantity', $qty);
				DB::commit();
				return true;
			} catch (Exception $e) {
				DB::rollback;
			}
		}
		return false;
	}

	public function subtotal() {
		$result = $this->item->price * $this->quantity;
		return $result;
	}
}
