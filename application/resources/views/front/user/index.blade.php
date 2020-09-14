@extends('layouts.user') @section('content')
<main role="main" class="col-md-10 ml-sm-auto col-lg-10 px-4">
	<ul class="list-inline pt-3">
		<li class="list-inline-item">
			<a href="http://localhost/home" class="btn btn-light">ホーム</a>
		</li>

		<li class="list-inline-item">
			<a href="http://localhost/users/{Auth::user()->id}}/edit" class="btn btn-success">編集</a>
		</li>
	</ul>

	<table class="table">
		<tbody>
			<tr>
				<th>ユーザー名</th>
				<td>{{Auth::user()->name}}</td>
			</tr>
			<tr>
				<th>メールアドレス</th>
				<td>{{Auth::user()->email}}</td>
			</tr>
			<tr>
				<th>イメージ画像</th>
				<td>@if(Auth::user()->image_path == null) 
						<img src="/storage/no_image.png" width="720">
					@else
						<img src="/storage/{{Auth::user()->image_path}}" width="720">
					@endif
				</td>
			</tr>
		</tbody>
	</table>
</main>
@endsection