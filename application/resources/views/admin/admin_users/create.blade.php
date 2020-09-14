@extends('layouts.admin') @section('content')
<main role="main" class="col-md-10 ml-sm-auto col-lg-10 px-4">
	<div class="row pt-3">
		<div class="col-sm">
			<form action="http://localhost/admin/admin_users" method="POST">
				@csrf
				<div class="form-group">
					<label for="name">名称</label> <input type="text"
						class="form-control " id="name" name="name" value=""
						placeholder="名称" autocomplete="name" autofocus> <span
						class="help-block" style="font-weight: bold; color: red">{{$errors->first('name')}}</span>
				</div>

				<div class="form-group">
					<label for="email">メールアドレス</label> <input type="text"
						class="form-control " id="email" name="email" value=""
						placeholder="メールアドレス" autocomplete="email"> <span
						class="help-block" style="font-weight: bold; color: red">{{$errors->first('email')}}</span>
				</div>

				<div class="form-group">
					<label for="password">パスワード</label> <input type="password"
						class="form-control " id="password" name="password"
						placeholder="パスワード" autocomplete="new-password">
					<span class="help-block" style="font-weight: bold; color: red">{{$errors->first('password')}}</span>
					<span class="help-block" style="font-weight: bold; color: red">{{$errors->first('password_confirmation')}}</span>
				</div>

				<div class="form-group">
					<label for="password-confirm">パスワード(確認)</label> <input
						type="password" class="form-control" id="password-confirm"
						name="password_confirmation" placeholder="パスワード(確認)"
						autocomplete="new-password">
				</div>

				<div class="form-check form-check-inline">
					<input type="radio" class="form-check-input" id="general"
						name="is_owner" value="0" checked>一般
				</div>

				<div class="form-check form-check-inline">
					<input type="radio" class="form-check-input" id="owner"
						name="is_owner" value="1">オーナー
				</div>
				<hr class="mb-3">
				<ul class="list-inline">
					<li class="list-inline-item"><a
						href="http://localhost/admin/admin_users"
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