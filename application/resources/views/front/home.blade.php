@extends('layouts.user')

@section('content')
ようこそ {{ Auth::user()->name }} 様
<li class="list-inline-item">
    <a	href="http://localhost/products" class="btn btn-success">商品</a>
</li>
@endsection