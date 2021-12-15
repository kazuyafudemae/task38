<?php
/*
namespace App\Http\Controllers\Address;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use App\UseCases\AddressUseCase;
use App\Http\Requests\AddressRequest;
use App\Address;

class sub_AddressController extends Controller
{
    public function __construct(
		Address $address
    ) {
		$this->address = $address;
    }
    //住所一覧画面
    public function index()
    {
        $addresses = $this->address->getAll();
        $address_id = Auth::user()->address_id;
        return view('address.index', compact('addresses', 'address_id'));
    }
    // 住所作成画面
    public function create()
    {
        $prefs = config('pref');
        return view('address.create', compact('prefs'));
    }
    // 住所作成処理
    public function store(AddressRequest $request)
    {
        $this->address->store($request);
        return $this->index();
    }
    // 住所の編集画面
    public function edit($id)
    {
        $address = $this->address->getByID($id);
        if (!$address || $address->user_id != Auth::id()) {
            set_message('不正なアクセスです。', false);
            return $this->index();
        }
        $prefs = config('pref');
        return view('address.edit', compact('address', 'prefs'));
    }
    // 住所の編集処理
    public function update(AddressRequest $request, $id)
    {
        $this->address->update($request, $id);
        return $this->index();
    }
    // 選択した住所を削除
    public function destroy(Request $request)
    {
        $this->address->destroy($request);
        return $this->index();
    }
    // 選択した住所に登録
    public function save(Request $request)
    {
        $this->address->save($request);
        return $this->index();
    }
}

