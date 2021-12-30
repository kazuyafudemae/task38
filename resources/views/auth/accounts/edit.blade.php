@extends('layouts.accounts')

@section('title', 'Accounts')

@section('menubar')
@parent
Account情報編集ページ
@endsection

@section('content')
<table>
<tr><th>名前</th><th>メールアドレス</th><th>新しいパスワード</th><th>新しいパスワードの確認</th><th>現在のパスワード</th></tr>
@foreach ($items as $item)
<tr>
<form method="POST" action="{{ route('account.edit') }}">
<td><input type="text" name="name" value="{{ $user->name }}"></td>
<td><input type="text" name="email" value="{{ $user->email }}"></td>
<td><input type="text" name="new_password"></td>
<td><input type="text" name="new_pasword_confirmation"></td>
<td><input type="text" name="password"></td>
</tr>
@endforeach
<input type='submit' value='編集'>
</form>
</table>
@endsection

