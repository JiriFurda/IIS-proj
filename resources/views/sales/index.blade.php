<?php
	use App\Sale;
?>

@extends('layouts.app')

@section('content')
	<h1>Prodeje v databázi:</h1>

	@if(empty($sales))
		<p>V databázi nejsou žádné pobočky.</p>
	@else
		<ul>
			@foreach($sales as $sale)
				<li>
					{!! $sale->nameLink() !!}
				</li>
			@endforeach
		</ul>
	@endif
@endsection
