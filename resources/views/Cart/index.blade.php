@extends('layouts.app')

@section('title', 'Items')

@section('menubar')
<p class='menutitle'><a href='{{route('admin.home')}}'>管理者ホーム</a></p>
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
<tr style="background-color:#f5f5f5">
<td align="right">{{ $cart->item->name }}</td>
<td align="right">{{ $cart->quantity }}</td>
<td align="right">{{ $cart->subtotal }}</td>
<td><form method="post" action="{{ route('cart.delete') }}">
{{ csrf_field() }}
<input type="hidden" name="cart_id" value="{{ $cart->id }}">
<button type="submit">カートから削除</button>
</form></td></tr>
@endforeach
<td style="background-color:#f5f5f5">
<td>合計</td>
<td>税込: {{ $totals }}</td>
<td></td>
</td>
</table>
@else
<h1>カートに商品はありません</h1>
@endif
<br>
<h2><a href="{{ route('item.index') }}">商品一覧へ戻る</a></h2>
</body>
@endsection

