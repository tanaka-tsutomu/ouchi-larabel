@extends('layouts.admin') @section('content')
<main role="main" class="col-md-10 ml-sm-auto col-lg-10 px-4">
	<ul class="list-inline pt-3">
		<li class="list-inline-item"><a href="http://localhost/admin/users"
			class="btn btn-light">一覧</a></li>

		<li class="list-inline-item"><a
			href="http://localhost/admin/users/{{$user->id}}/edit"
			class="btn btn-success">編集</a></li>

		<li class="list-inline-item">
			<form action="http://localhost/admin/users/{{$user->id}}"
				method="POST">
				@csrf <input type="hidden" name="_method" value="DELETE">
				<button type="submit" class="btn btn-danger">削除</button>
			</form>
		</li>
	</ul>
	<table class="table">
		<tbody>
			<tr>
				<th>ID</th>
				<td>{{$user->id}}</td>
			</tr>
			<tr>
				<th>名称</th>
				<td>{{$user->name}}</td>
			</tr>
			<tr>
				<th>メールアドレス</th>
				<td>{{$user->email}}</td>
			</tr>
			<tr>
				<th>イメージ</th>
				<td>@if($user->image_path == null) <img src="/storage/no_image.png">
					@else <img src="/storage/{{$user->image_path}}">@endif
				</td>
			</tr>
		</tbody>
	</table>
</main>
@endsection