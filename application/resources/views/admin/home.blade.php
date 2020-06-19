@extends('layouts.admin')

@section('content')
admin home<br>
{{ Auth::user()->name }}<br>
{{ Auth::user()->is_owner }}
@endsection