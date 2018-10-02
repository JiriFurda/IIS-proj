<?php
	use App\Sale;
?>

@extends('layouts.app')

@section('content')
	<h1>Léky v databázi:</h1>
	<ul>
		@foreach(Sale::all() as $sale)
			<li>
				{!! $sale->nameLink() !!}
			</li>
		@endforeach
	</ul>
@endsection
