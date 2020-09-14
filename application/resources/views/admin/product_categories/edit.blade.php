@extends('layouts.admin') @section('content')
<main role="main" class="col-md-10 ml-sm-auto col-lg-10 px-4">
	<div class="row pt-3">
		<div class="col-sm">
			<form
				action="http://localhost/admin/product_categories/{{$productCategory->id}}"
				method="POST">
				@csrf @method('PUT') <input type="hidden" id="id" name="id"
					value="{{$productCategory->id}}">
				<div class="form-group">
					<label for="name">名称</label> <input type="text"
						class="form-control " id="name" name="name"
						value="{{$productCategory->name}}" placeholder="名称" autofocus="">
					<span class="help-block" style="font-weight: bold; color: red">{{$errors->first('name')}}</span>
				</div>
				<div class="form-group">
					<label for="order-no">並び順番号</label> <input type="number"
						class="form-control " id="order-no" name="order_no"
						value="{{$productCategory->order_no}}" placeholder="並び順番号">
					@if($errors->has('order_no'))<br>
					<span style="font-weight: bold; color: red;" class="error">{{
						$errors->first('order_no') }}</span> @endif
				</div>
				<hr class="mb-3">
				<ul class="list-inline">
					<li class="list-inline-item"><a
						href="http://localhost/admin/product_categories/{{$productCategory->id}}"
						class="btn btn-secondary">キャンセル</a></li>
					<li class="list-inline-item">
						<button type="submit" class="btn btn-primary">更新</button>
					</li>
				</ul>
			</form>
		</div>
	</div>
</main>
@endsection