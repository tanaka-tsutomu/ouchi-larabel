@extends('layouts.admin') @section('content')
<main role="main" class="col-md-10 ml-sm-auto col-lg-10 px-4">
	<div class="row pt-3">
		<div class="col-sm">
			<form action="http://localhost/admin/admin_users/{{$adminUser->id}}"
				method="POST">
				@csrf @method('PUT') <input type="hidden" id="id" name="id"
					value="{{$adminUser->id}}">
				<div class="form-group">
					<label for="name">名称</label> <input type="text"
						class="form-control " id="name" name="name"
						value="{{old('name', $adminUser->name)}}" placeholder="名称"
						autofocus> <span class="help-block"
						style="font-weight: bold; color: red">{{$errors->first('name')}}</span>
				</div>

				<div class="form-group">
					<label for="email">メールアドレス</label> <input type="text"
						class="form-control " id="email" name="email"
						value="{{old('email', $adminUser->email)}}" placeholder="メールアドレス">
					<span class="help-block" style="font-weight: bold; color: red">{{$errors->first('email')}}</span>
				</div>

				<div class="form-group">
					<label for="password">パスワード</label> <input type="password"
						class="form-control " id="password" name="password"
						placeholder="パスワード"> <span class="help-block"
						style="font-weight: bold; color: red">{{$errors->first('password')}}</span>
					<span class="help-block" style="font-weight: bold; color: red">{{$errors->first('password_confirmation')}}</span>
				</div>

				<div class="form-group">
					<label for="password-confirm">パスワード(確認)</label> <input
						type="password" class="form-control" id="password-confirm"
						name="password_confirmation" placeholder="パスワード(確認)">
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
						href="http://localhost/admin/admin_users/{{$adminUser->id}}"
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