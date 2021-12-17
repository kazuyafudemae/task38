<html>
<head>
<title>@yield('title')</title>
<style>
body { font-size:16pt; color:#999, margin:5px; }
h1 { font-size:50pt; text-align:right; color:#f6f6f6; margin:-20px 0px -30px 0px; letter-spacing:-4pt; }
ul { font-size::12pt; }
hr { margin: 25px 100px; border-top: 1px dashed #ddd; }
.menutitle { font-size:14pt; font-weight:bold; margin:0px; }
.content { margin:10px; }
.footer { text-align:right; font-size:10pt; margin:10px; border-bottom:solid 1px #ccc; color:#ccc; }
</style>
</head>
<body>
<h1>@yield('title')</h1>
@section('menubar')
<ul>
<li><p class='menutitle'><a href='{{route('home')}}'>User Home</a></p></li>
<li><p class='menutitle'><a href='{{route('address.index')}}'>Address Top</a></p></li>
<li><p class='menutitle'><a href='{{route('item.index')}}'>Item Top</a></p></li>
<li><p class='menutitle'><a href='{{route('cart.index')}}'>Cart Top</a></p></li>
</ul>
<hr size='1'>
<div class='content'>
@foreach ($errors->all() as $error)
<li>{{ $error }}</li>
@endforeach
@if (session('message'))
    @if (session('is_success'))
        <div class="alert alert-success">{{ session('message') }}</div>
    @else
        <div class="alert alert-danger">{{ session('message') }}</div>
    @endif
    <?php
    session()->flash('message', null);
    session()->flash('is_succes', null);
    ?>
@endif
@yield('content')
</div>
<div clas='footer'>
@yield('footer')
</div>
</body>
</html>
