@extends('layouts.admin') @section('content')
<main role="main" class="col-md-10 ml-sm-auto col-lg-10 px-4">
	<div class="row pt-3">
		<div class="col-sm">
			<form action="http://localhost/admin/products/{{$product->id}}"
				method="POST" enctype="multipart/form-data">
				@csrf @method('PUT')
				<div class="form-group">
					<label for="product_category_id">商品カテゴリ</label> <select
						class="custom-select " id="product_category_id"
						name="product_category_id"> @foreach($categories as $category)
						<option value="{{$category->id}}" @if($category->id ==
							$product->product_category_id)selected @endif>{{ $category->name
							}}</option> @endforeach>
					</select>
				</div>
				<div class="form-group">
					<label for="name">名称</label> <input type="text"
						class="form-control " id="name" name="name"
						value="{{$product->name}}" placeholder="名称" autofocus=""> <span
						class="help-block" style="font-weight: bold; color: red">{{$errors->first('name')}}</span>
				</div>
				<div class="form-group">
					<label for="price">価格</label> <input type="number"
						class="form-control " id="price" name="price"
						value="{{$product->price}}" placeholder="価格"> <span
						class="help-block" style="font-weight: bold; color: red">{{$errors->first('price')}}</span>
				</div>
				<div class="form-group">
					<label for="description">説明</label>
					<textarea class="form-control " id="description" name="description"
						placeholder="説明">{{$product->description}}</textarea>
				</div>
				<div class="form-group">
					<label for="image_path">イメージ</label> <input type="file"
						class="form-control-file" id="image_path" name="image_path">
				</div>
				<div class="form-check">
					<input type="checkbox" class="form-check-input" id="delete_image"
						name="delete_image" value="1"> <label for="delete_image">削除</label>
				</div>
				<hr class="mb-3">
				<ul class="list-inline">
					<li class="list-inline-item"><a
						href="http://localhost/admin/products" class="btn btn-secondary">キャンセル</a>
					</li>
					<li class="list-inline-item">
						<button type="submit" class="btn btn-primary">更新</button>
					</li>
				</ul>
			</form>
		</div>
	</div>
</main>
</div>
</div>
@endsection