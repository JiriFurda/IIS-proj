<?php
	use App\Sale;
?>

@extends('layouts.app')

@section('content')
	<h1>Prodeje v databázi:</h1>

	@if(empty($sales))
		<p>V databázi nejsou žádné prodeje.</p>
	@else
		<ul>
			@foreach($sales as $sale)
				<li>
					{!! $sale->nameLink() !!} {{$sale->confirmed ? null : '(Nepotvrzen)'}}
				</li>
			@endforeach
		</ul>
	@endif
@endsection
