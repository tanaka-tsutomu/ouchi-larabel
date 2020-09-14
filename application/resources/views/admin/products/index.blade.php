@extends('layouts.admin') @section('content')
<main role="main" class="col-md-10 ml-sm-auto col-lg-10 px-4">
	<form class="shadow p-3 mt-3" action="http://localhost/admin/products">
		<div class="row">
			<div class="col-md-4 mb-3">
				<select class="custom-select" id="product_category"
					name="product_category">
					<option value="all">すべてのカテゴリー</option> @foreach($categories as
					$category)
					<option value="{{$category->id}}"
						@if(old('product_category', $productCategory) == $category->id)selected
						@endif>{{ $category->name }}</option> @endforeach>
				</select>
			</div>
			<div class="col-md-8 mb-3">
				<input type="text" class="form-control" id="name" name="name"
					value="{{old('name', $name)}}" placeholder="名称">
			</div>
		</div>
		<div class="row">
			<div class="col-md mb-3">
				<div class="input-group">
					<input type="number" class="form-control" id="price" name="price"
						value="{{old('price', $price)}}" min="0" placeholder="価格">
					<div class="input-group-append">
						<div class="input-group-text">
							<div class="form-check form-check-inline">
								<input class="form-check-input" type="radio"
									name="price_compare" id="price-compare-gteq" value="gteq"
									@if(old('price_compare', $priceCompare) ==
									"gteq")checked
                                            @endif> <label
									class="form-check-label" for="price-compare-gteq">以上</label>
							</div>
							<div class="form-check form-check-inline mr-0">
								<input class="form-check-input" type="radio"
									name="price_compare" id="price-compare-lteq" value="lteq"
									@if(old('price_compare', $priceCompare) ==
									"lteq")checked
                                            @endif> <label
									class="form-check-label" for="price-compare-lteq">以下</label>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
		<div class="row">
			<div class="col-md-4 mb-3">
				<select class="custom-select" name="sort">
					<option value="id-asc" @if(old('sort', $sort) ==
						'id-asc')selected
                                @endif>並び替え: ID昇順</option>
					<option value="id-desc" @if(old('sort', $sort) ==
						'id-desc')selected
                                @endif>並び替え: ID降順</option>
					<option value="product-category-asc" @if(old('sort', $sort) ==
						'product-category-asc')selected
                                @endif>並び替え: 商品カテゴリ昇順</option>
					<option value="product-category-desc" @if(old('sort', $sort) ==
						'product-category-desc')selected
                                @endif>並び替え: 商品カテゴリ降順</option>
					<option value="name-asc" @if(old('sort', $sort) ==
						'name-asc')selected
                                @endif>並び替え: 名称昇順</option>
					<option value="name-desc" @if(old('sort', $sort) ==
						'name-desc')selected
                                @endif>並び替え: 名称降順</option>
					<option value="price-asc" @if(old('sort', $sort) ==
						'price-asc')selected
                                @endif>並び替え: 価格昇順</option>
					<option value="price-desc" @if(old('sort', $sort) ==
						'price-desc')selected
                                @endif>並び替え: 価格降順</option>
				</select>
			</div>
			<div class="col-md-4 mb-3">
				<select class="custom-select" name="page_unit">
					<option value="10" @if(old('page_unit', $pageUnit) ==
						10)selected
                                @endif>表示: 10件</option>
					<option value="20" @if(old('page_unit', $pageUnit) ==
						20)selected
                                @endif>表示: 20件</option>
					<option value="50" @if(old('page_unit', $pageUnit) ==
						50)selected
                                @endif>表示: 50件</option>
					<option value="100" @if(old('page_unit', $pageUnit) ==
						100)selected
                                @endif>表示: 100件</option>
				</select>
			</div>
			<div class="col-sm mb-3">
				<button type="submit" class="btn btn-block btn-primary">検索</button>
			</div>
		</div>
	</form>
	<ul class="list-inline pt-3">
		<li class="list-inline-item"><a
			href="http://localhost/admin/products/create" class="btn btn-success">新規</a>
		</li>
	</ul>
	<div class="table-responsive">
		<table class="table table-striped table-sm">
			<thead>
				<tr>
					<th>ID</th>
					<th>名称</th>
					<th>商品カテゴリ</th>
					<th>価格</th>
				</tr>
			</thead>
			<tbody>
				@foreach($products as $product)
				<tr>
					<td>{{$product->id}}</td>
					<td><a href="http://localhost/admin/products/{{$product->id}}">{{$product->name}}</a></td>
					<td>{{$product->ProductCategory->name}}</td>
					<td>¥{{number_format($product->price)}}</td>
				</tr>
				@endforeach
			</tbody>
		</table>
		{{$products->appends(Request::except('page'))->links()}}
	</div>
</main>
@endsection