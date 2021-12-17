@extends('layouts.cart')

@section('title', 'Cart')

@section('menubar')
@parent
@endsection

@section('content')
<h2>カート内一覧ページ</h2>
<body>
@if ($carts->count() > 0)
<table>
<h1>カート内容</h1>
<tr style="background-color:#e3f0fb">
<th>商品名</th>
<th>購入数</th>
<th>価格</th>
<th>合計</th>
<th></th>
</tr>
@foreach ($carts as $cart)
<tr>
<td align="right">{{ $cart->item->name }}</td>
<td align="right">{{ $cart->quantity }}</td>
<td align="right">{{ $cart->item->price }}</td>
<td align="right">{{ $cart->sub_total }}</td>
<td><form method="post" action="{{ route('cart.delete') }}">
{{ csrf_field() }}
<input type="hidden" name="cart_id" value="{{ $cart->id }}">
<button type="submit">カートから削除</button>
</form></td>
</tr>
@endforeach
@if (isset($subtotals) && isset($totals))
<tr style="background-color:#f5f5f5">
<td></td>
<td></td>
<td>合計: {{ $subtotals }}</td>
<td>税込: {{ $totals }}</td>
<td></td>
</tr>
@endif
</table>
@else
<p>カートが空です</p>
@endif
@if (isset($true_message))
<p>{{ $true_message }} </p>
@elseif (isset($false_message))
<p>{{ $false_message }} </p>
@endif
<button><a href="{{ route('address.choice') }}">お届け先選択</a></button><br>
</body>
@endsection

