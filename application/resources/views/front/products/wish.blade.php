@extends('layouts.user') @section('content')
<div class="row column">
	<p class="lead">ほしい物リスト</p>
</div>
<div class="row small-up-1 medium-up-2 large-up-3">
	@foreach($products as $product)
		<div class="column">
			<div class="callout">
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
		</div>
	@endforeach
</div>
{{$products->appends(Request::except('page'))->links()}}
@endsection