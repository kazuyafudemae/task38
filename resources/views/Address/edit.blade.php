@extends('layouts.address')

@section('title', 'Address')

@section('menubar')
@parent
@endsection

@section('content')
<body>
<form method="post" action="{{ route('address.edit', ['id' => $address->id])}}">
{{ csrf_field() }}
<p>名前</p>
<input type="text" name="name" value="{{ old('name', $address->name) }}">
<p>郵便番号</p>
<input type="text" name="first_code" value="{{ old('first_code', $address->first_code) }}">-
<input type="text" name="last_code" value="{{ old('last_code', $address->last_code) }}">
<p>都道府県</p>
<select name="state">
<option value="{{ old('state', $address->state) }}" selected="{{ old('state', $address->state) }}">{{ old('state', $address->state) }}</option>
@foreach($prefs as $pref)
<option value="{{ $pref }}">{{ $pref }}</option>
@endforeach
</select>
<p>市町村</p>
<input type="text" name="city" value="{{ old('city', $address->city) }}">
<p>以下住所</p>
<input type="text" name="street" value="{{ old('street', $address->street) }}">
<p>電話番号</p>
<input type="text" name="tel" value="{{ old('tel', $address->tel) }}"><br>
<input type="submit" value="編集">
</form>
</body>
@endsection
