@extends('layouts.address')
@section('content')
<h2>お届け先一覧</h2>
@if (0 < $addresses->count())
<table border="1">
<tr style="background-color:yellow">
<th>◉</th>
<th>お届け先</th>
<th>名前</th>
<th>郵便番号</th>
<th>住所</th>
<th>電話番号</th>
<th>編集</th>
<th>削除</th>
</tr>
@foreach ($addresses as $address)
<tr>
<td>
@if ($address->user_id === $auth)
<input type="radio" checked>
@endif
</td>
<td align="center">
<form method="post" action="{{ route('address.save') }}">
{{ csrf_field() }}
<input type="hidden" name="address_id" value="{{ $address->id }}">
<button type="submit">選択</button>
</form>
</td>
<td>{{ $address->name }}</td>
<td>{{ $address->first_code }}-{{ $address->last_code }}</td>
<td>{{ $address->state . $address->city . $address->street }}</td>
<td>{{ $address->tel }}</td>
<td><button><a href="{{ route('address.edit', ['id' => $address->id]) }}">編集</a></button></td>
<td>
<form method="post" action="{{ route('address.delete') }}">
{{ csrf_field() }}
<input type="hidden" name="address_id" value="{{ $address->id }}">
<button type="submit" class="btn btn-danger btn-sm btn-dell">削除</button>
</form>
</td>
</tr>
@endforeach
</table>
@else
<p>お届け先は登録されていません</p>
@endif
<br>
<form method="post" action="{{ route('address.save') }}">
{{ csrf_field() }}
{{ Form::hidden('url', URL::previous()) }}
<button type="submit">お届け先追加</button>
</form>
@endsection
