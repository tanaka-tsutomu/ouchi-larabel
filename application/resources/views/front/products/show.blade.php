@extends('layouts.user') @section('content')
	<ul class="list-inline pt-3">
		<li class="list-inline-item">
		<a href="http://localhost/products"
			class="btn btn-secondary">一覧に戻る</a></li>
			<li class="list-inline-item">
		<a href="http://localhost/products"
			class="btn btn-primary">リストに追加</a></li>
		<li class="list-inline-item">
			<form action="http://localhost/products/{{$product->id}}"
				method="POST">
				@csrf 
			</form>
		</li>
	</ul>
	普通のテキスト
	<table class="table">
		<tbody>
			<tr>
				<th>ID</th>
				<td>{{$product->id}}</td>
			</tr>
			<tr>
				<th>名称</th>
				<td>{{$product->name}}</td>
			</tr>
			<tr>
				<th>商品カテゴリ</th>
				<td>{{$product->ProductCategory->name}}</td>
			</tr>
			<tr>
				<th>価格</th>
				<td>¥{{number_format($product->price)}}</td>
			</tr>
			<tr>
				<th>説明</th>
				<td>{{$product->description}}</td>
			</tr>
			<tr>
				<th>イメージ</th>
				<td>@if($product->image_path == null) <img src="/storage/no_image.png">
					@else <img src="/storage/{{$product->image_path}}">@endif
				</td>
			</tr>
		</tbody>
	</table>
@endsection
