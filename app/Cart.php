<?php
namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\facades\Auth;

class Cart extends Model
{
	use SoftDeletes; //ソフトデリート準備
	protected $fillable = ['user_id', 'item_id', 'quantity'];
	protected $table = 'carts';

	public function item() {
		//リレーション
		return $this->belongsTo('App\Item', 'item_id');
	}

	public function insert($item_id, $add_qty) {
		$cart = Cart::find($item_id);
		$qty = $cart->item->quantity;
		//在庫なしバリデーション
		if ($qty <= 0) {
			return false;
		}
		$cart = $this->firstOrCreate(['user_id' => Auth::id(), 'item_id' => $item_id], ['quantity' => 0]);
		DB::beginTransaction();
		try {
			$cart->increment('quantity', $add_qty);
			$item->decrement('quantity', $add_qty);
			$cart->sub_total = $cart->quantity * $cart->item->price;
			DB::commit();
			return true;
		} catch (Exception $e) {
			DB::rollback();
			return false;
		}
	}

	public function delete_cart($cart_id) {
		$cart = $this->findOrCreate($cart_id);
		if ($cart->user_id == Auth::id()) {
			DB::beginTransaction();
			try {
				$item_id = $cart->item_id;
				$qty = $cart->quantity;
				$cart->delete();
				$item = (new Item)->find($item_id);
				$item->increment('quantity', $qty);
				DB::commit();
				return true;
			} catch (Exception $e) {
				DB::rollback();
			}
		}
		return false;
	}

	public function subtotal() {
		$result = $this->item->price * $this->quantity;
		return $result;
	}
}


