<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">

<!-- CSRF Token -->
<meta name="csrf-token" content="{{ csrf_token() }}">

<title>{{ config('app.name', 'Laravel') }}</title>

<!-- Scripts -->
<script src="{{ asset('js/app.js') }}" defer></script>
<script src="{{ asset('js/js.cookie.js') }}"></script>
<script src="https://cdn.jsdelivr.net/npm/js-cookie@2/src/js.cookie.min.js"></script>

<!-- Fonts -->
<link rel="dns-prefetch" href="//fonts.gstatic.com">
<link href="https://fonts.googleapis.com/css?family=Nunito"
	rel="stylesheet">

<!-- Styles -->
<script src="https://cdn.jsdelivr.net/npm/darkmode-js@1.4.0/lib/darkmode-js.min.js"></script>
<script>
  new Darkmode().showWidget();
</script>

<link rel="stylesheet" href="{{ asset('css/style.css') }}">
<link href="{{ asset('css/app.css') }}" rel="stylesheet">
</head>
<body>
	<header>
		<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
			<a class="navbar-brand" href="http://localhost/home">{{ config('app.name', 'Laravel')
				}}</a>
			<button class="navbar-toggler" type="button" data-toggle="collapse"
				data-target="#navbarSupportedContent"
				aria-controls="navbarSupportedContent" aria-expanded="false"
				aria-label="Toggle navigation">
				<span class="navbar-toggler-icon"></span>
			</button>
			<form class="form-inline my-4 my-lg-0" action="http://localhost/products">
				<select class="custom-select" id="product_category" name="product_category">
					<option value="all">すべてのカテゴリー</option>
					@foreach($categories as $category)
						<option value="{{$category->id}}"
							@if(old('product_category', $productCategory) == $category->id)selected
							@endif>{{$category->name}}
						</option>
					@endforeach
				</select>
				<select class="custom-select" name="sort">
					<option value="id-asc"
						@if(old('sort', $sort) == 'id-asc')selected
						@endif>並び替え: ID昇順
					</option>
					<option value="id-desc"
						@if(old('sort', $sort) == 'id-desc')selected
						@endif>並び替え: ID降順
					</option>
					<option value="product-category-asc"
						@if(old('sort', $sort) == 'product-category-asc')selected
						@endif>並び替え: 商品カテゴリ昇順
					</option>
					<option value="product-category-desc"
						@if(old('sort', $sort) == 'product-category-desc')selected
						@endif>並び替え: 商品カテゴリ降順
					</option>
					<option value="name-asc"
						@if(old('sort', $sort) == 'name-asc')selected
						@endif>並び替え: 名称昇順
					</option>
					<option value="name-desc"
						@if(old('sort', $sort) == 'name-desc')selected
						@endif>並び替え: 名称降順
					</option>
					<option value="price-asc"
						@if(old('sort', $sort) == 'price-asc')selected
						@endif>並び替え: 価格昇順
					</option>
					<option value="price-desc"
						@if(old('sort', $sort) == 'price-desc')selected
						@endif>並び替え: 価格降順
					</option>
				</select>
				<select class="custom-select" name="page_unit">
					<option value="10"
						@if(old('page_unit', $pageUnit) == 10)selected
						@endif>表示: 10件
					</option>
					<option value="20"
						@if(old('page_unit', $pageUnit) == 20)selected
						@endif>表示: 20件
					</option>
					<option value="50"
						@if(old('page_unit', $pageUnit) == 50)selected
						@endif>表示: 50件
					</option>
					<option value="100"
						@if(old('page_unit', $pageUnit) == 100)selected
						@endif>表示: 100件
					</option>
				</select>
				<input type="text" class="form-control mr-sm-1" id="name" name="name"
					value="{{old('name', $name ?? '')}}" placeholder="名称">
				<div class="input-group">
					<input type="number" class="form-control mr-sm-1" id="price" name="price"
						value="{{old('price', $price)}}" min="0" placeholder="価格">
							<div class="input-group-append">
								<div class="input-group-text">
									<div class="form-check form-check-inline">
										<input class="form-check-input" type="radio"
											name="price_compare" id="price-compare-gteq" value="gteq"
												@if(old('price_compare', $priceCompare) == "gteq")checked
												@endif>
										<label class="form-check-label" for="price-compare-gteq">以上</label>
									</div>
									<div class="form-check form-check-inline mr-0">
										<input class="form-check-input" type="radio"
											name="price_compare" id="price-compare-lteq" value="lteq"
												@if(old('price_compare', $priceCompare) == "lteq")checked
												@endif>
										<label class="form-check-label" for="price-compare-lteq">以下</label>
									</div>
								</div>
							</div>
				</div>
				<div>
					<button type="submit" class="btn btn-block btn-primary">検索</button>
				</div>
			</form>
			<div class="collapse navbar-collapse" id="navbarSupportedContent">
				<ul class="navbar-nav ml-auto">
						<input id="btn-mode" type="checkbox" name="name"> 🌛
					<li class="nav-item dropdown"><a class="nav-link dropdown-toggle"
						href="#" id="navbarDropdown" role="button" data-toggle="dropdown"
						aria-haspopup="true" aria-expanded="false"> {{ Auth::user()->name }} </a>
						<div class="dropdown-menu dropdown-menu-right"
							aria-labelledby="navbarDropdown">
							<a class="dropdown-item" href="http://localhost/wish_products">欲しいものリスト</a>
							<div class="dropdown-divider"></div>
							<a class="dropdown-item" href="http://localhost/user">ユーザー情報</a>
							<div class="dropdown-divider"></div>
							<a class="dropdown-item" href="#"
								onclick="event.preventDefault();document.getElementById('logout-form').submit();">ログアウト</a>
							<form id="logout-form" class="d-none"
								action="{{ route('logout') }}" method="POST">@csrf</form>
						</div>
					</li>
				</ul>
			</div>
		</nav>
	</header>
</body>
	<main>
		<script src="{{ asset('js/dark.js') }}"></script>
		@yield('content')
	</main>
</html>