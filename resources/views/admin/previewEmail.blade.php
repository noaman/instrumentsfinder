
@extends('layout.adminlayout')

@section('content')


@if($request!=null)

@php
$userInput = $request->all();
foreach( $request->input() as $key=>&$item){
	if($key!="emailText")
		echo($key." - ".$item."<hr>");
}
@endphp


@endif

@if($request->input("emailText")!=null)

	{!!$request->input("emailText")!!}

@endif


@endsection