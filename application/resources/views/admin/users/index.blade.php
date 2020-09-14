@extends('layouts.admin') @section('content')
<main role="main" class="col-md-10 ml-sm-auto col-lg-10 px-4">
	<form class="shadow p-3 mt-3" action="http://localhost/admin/users">
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
			<div class="col-md-4 mb-3">
				<select class="custom-select" name="sort">
					<option value="id-asc" @if(old('sort', $sort) ==
						"id-asc")selected @endif>並び替え: ID昇順</option>
					<option value="id-desc" @if(old('sort', $sort) ==
						"id-desc")selected
                                @endif>並び替え: ID降順</option>
					<option value="name-asc" @if(old('sort', $sort) ==
						"name-asc")selected
                                @endif>並び替え: 名称昇順</option>
					<option value="name-desc" @if(old('sort', $sort) ==
						"name-desc")selected
                                @endif>並び替え: 名称降順</option>
					<option value="email-asc" @if(old('sort', $sort) ==
						"email-asc")selected
                                @endif>並び替え: メールアドレス昇順</option>
					<option value="email-desc" @if(old('sort', $sort) ==
						"email-desc")selected
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
			href="http://localhost/admin/users/create" class="btn btn-success">新規</a>
		</li>
	</ul>
	<div class="table-responsive">
		<table class="table table-striped table-sm">
			<thead>
				<tr>
					<th>ID</th>
					<th>名称</th>
					<th>メールアドレス</th>
				</tr>
			</thead>
			<tbody>
				@foreach($Users as $User)
				<tr>
					<td>{{$User->id}}</td>
					<td><a href="http://localhost/admin/users/{{$User->id}}">{{$User->name}}</a></td>
					<td>{{$User->email}}</td>
				</tr>
				@endforeach
			</tbody>
		</table>
		{{$Users->appends(Request::except('page'))->links()}}
	</div>
</main>
@endsection
