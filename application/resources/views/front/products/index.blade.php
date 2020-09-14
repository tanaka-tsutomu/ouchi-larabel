@extends('layouts.user') @section('content')
<div class="container">
	<p class="lead">商品一覧</p>
</div>
<div class="row">
	@foreach($products as $product)
		<div class="col-lg-3">			
				<p>商品名　：{{$product->name}}</p>
				<p>カテゴリ：{{$product->ProductCategory->name}}</p>
				<p>価　格　：¥{{number_format($product->price)}}</p>
				<p class="lead">{{$product->description}}</p>
				<p>
					<a href="http://localhost/products/{{$product->id}}">
						@if($product->image_path == NULL) 
							<img src="/storage/no_image.png" class="img-thumbnail" alt="NO IMAGE" width="400" height="370">
						@else
							<img src="/storage/{{$product->image_path}}"class="img-thumbnail" alt="商品画像" width="400" height="370">
						@endif
					</a>
				</p>			
		</div>
	@endforeach
</div>
{{$products->appends(Request::except('page'))->links()}}
@endsection