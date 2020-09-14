@extends('layouts.admin') @section('content')
<main role="main" class="col-md-10 ml-sm-auto col-lg-10 px-4">
	<form class="shadow p-3 mt-3"
		action="http://localhost/admin/admin_users">
		<div class="row">
			<div class="col-md-6 mb-3">
				<input type="text" class="form-control" id="name" name="name"
					value="{{old('name', $name)}}" placeholder="名称">
			</div>

			<div class="col-md mb-3">
				<input type="text" class="form-control" id="email" name="email"
					value="{{old('email', $email)}}" placeholder="メールアドレス">
			</div>
		</div>

		<div class="row">
			<div class="col-md mb-3">
				<div class="form-check form-check-inline">
					<input type="radio" class="form-check-input" id="authority-all"
						name="authority" value="all" @if(old('authority', $authority) ==
						"all" )checked
                                @endif> <label class="form-check-label"
						for="authority-all">すべての権限</label>
				</div>

				<div class="form-check form-check-inline">
					<input type="radio" class="form-check-input" id="authority-owner"
						name="authority" value="owner" @if(old('authority', $authority) ==
						"owner" )checked
                                @endif> <label class="form-check-label"
						for="authority-owner">オーナー</label>
				</div>

				<div class="form-check form-check-inline">
					<input type="radio" class="form-check-input" id="authority-general"
						name="authority" value="general"
						@if(old('authority', $authority) ==
						"general" )checked
                                @endif> <label class="form-check-label"
						for="authority-general">一般</label>
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
					<option value="name-asc" @if(old('sort', $sort) ==
						'name-asc')selected
                                @endif>並び替え: 名称昇順</option>
					<option value="name-desc" @if(old('sort', $sort) ==
						'name-desc')selected
                                @endif>並び替え: 名称降順</option>
					<option value="email-asc" @if(old('sort', $sort) ==
						'email-asc')selected
                                @endif>並び替え: メールアドレス昇順</option>
					<option value="email-desc" @if(old('sort', $sort) ==
						'email-desc')selected
                                @endif>並び替え: メールアドレス降順</option>
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
			href="http://localhost/admin/admin_users/create"
			class="btn btn-success">新規</a></li>
	</ul>

	<div class="table-responsive">
		<table class="table table-striped table-sm">
			<thead>
				<tr>
					<th>ID</th>
					<th>名称</th>
					<th>メールアドレス</th>
					<th>権限</th>
				</tr>
			</thead>
			<tbody>
				@foreach($AdminUsers as $AdminUser)
				<tr>
					<td>{{$AdminUser->id}}</td>
					<td><a href="http://localhost/admin/admin_users/{{$AdminUser->id}}">{{$AdminUser->name}}</a></td>
					<td>{{$AdminUser->email}}</td>
					<td>@if($AdminUser->is_owner == 1)オーナー@else一般@endif</td>
				</tr>
				@endforeach
			</tbody>
		</table>
		{{$AdminUsers->appends(Request::except('page'))->links()}}
	</div>
</main>
@endsection