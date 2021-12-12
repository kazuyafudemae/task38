<?php
namespace App\Http\Controllers\Cart;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use App\Cart;

class CartController extends Controller
{
	public function __construct(Cart $cart) {
		$this->cart = $cart;
	}

	public function index() {
		$carts = Cart::where('user_id', Auth::id())->get();
		$subtotals = $this->subtotals($carts);
		$totals = $this->totals($carts);
		return view('Cart.index', compact('carts', 'totals', 'subtotals'));
	}

	public function add(Request $request) {
		$item_id = $request->input('item_id');
		dump($this->cart->insert($item_id, 1));
		if ($this->cart->insert($item_id, 1)) {
			$carts = Cart::All();
			return view('Cart.index', compact('carts'));
		} else {
			return view('Cart.index', compact('carts', 'totals', 'subtotals'));
		}
	}

	public function delete(Request $request) {
		$cart_id = $request->input('cart_id');
		return redirect(route('cart.index'))->with('true_message', 'カートから商品を削除しました。');
	}

	private function subtotals($carts) {
		$result = 0;
		foreach ($carts as $cart) {
			$result = $cart->quantity * $cart->item->price;
		}
		return $result;
	}

	private function totals($carts) {
		$result = $this->subtotals($carts) + $this->tax($carts);
		return $result;
	}

	private function tax($carts) {
		$result = floor($this->subtotals($carts) * 0.1);
		return $result;
	}
}
