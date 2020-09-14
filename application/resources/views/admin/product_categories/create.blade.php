@extends('layouts.admin') @section('content')
<main role="main" class="col-md-10 ml-sm-auto col-lg-10 px-4">
	<div class="row pt-3">
		<div class="col-sm">
			<form action="http://localhost/admin/product_categories"
				method="POST">
				@csrf
				<div class="form-group">
					<label for="name">名称</label> <input type="text"
						class="form-control " id="name" name="name" value=""
						placeholder="名称" autocomplete="name" autofocus="">
					@if($errors->has('name'))<br>
					<span style="font-weight: bold; color: red;" class="error">{{
						$errors->first('name') }}</span> @endif
				</div>
				<div class="form-group">
					<label for="order-no">並び順番号</label> <input type="number"
						class="form-control " id="order-no" name="order_no" value=""
						placeholder="並び順番号"> @if($errors->has('order_no'))<br>
					<span style="font-weight: bold; color: red;" class="error">{{
						$errors->first('order_no') }}</span> @endif
				</div>
				<hr class="mb-3">
				<ul class="list-inline">
					<li class="list-inline-item"><a
						href="http://localhost/admin/product_categories"
						class="btn btn-secondary">キャンセル</a></li>
					<li class="list-inline-item">
						<button type="submit" class="btn btn-primary">作成</button>
					</li>
				</ul>
			</form>
		</div>
	</div>
</main>
@endsection