
@extends('layout.adminlayout')

@section("content")

	@if(isset($resp))
		<h3>{{$resp}}
	@endif
@endsections