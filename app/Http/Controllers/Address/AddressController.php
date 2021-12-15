<?php

namespace App\Http\Controllers\Address;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\UseCases\AddressUseCase;
use App\Http\Requests\AddressRequest;
use App\Address;

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
        $addresses = Address::where('user_id', Auth::id())->get();
        $address_id = Auth::user()->address_id;
        return view('address.index', compact('addresses', 'address_id'));
    }
}
