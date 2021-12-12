@extends('layouts.cart')

@section('title', 'Items')

@section('menubar')
<p class='menutitle'><a href='{{route('home')}}'>ホーム画面</a></p>
@parent
カート内一覧ページ
@endsection

@section('content')
<body>
@if ($carts->count() > 0)
<table>
<h1>カート内容</h1>
<tr style="background-color:#e3f0fb">
<th>商品名</th>
<th>購入数</th>
<th>価格</th>
<th>削除</th>
</tr>
@foreach ($carts as $cart)
<tr>
<td align="right">{{ $cart->item->name }}</td>
<td align="right">{{ $cart->quantity }}</td>
<td align="right">{{ $cart->sub_total }}</td>
<td><form method="post" action="{{ route('cart.delete') }}">
{{ csrf_field() }}
<input type="hidden" name="cart_id" value="{{ $cart->id }}">
<button type="submit">カートから削除</button>
</form></td></tr>
@endforeach
</table>
@else
<h1>カートに商品はありません</h1>
@endif
</body>
@endsection

