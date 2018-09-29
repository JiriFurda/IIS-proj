@extends('layouts.app')

@section('content')
	<h1>Pobočka: {{ $branch->name }}</h1>

	<h2>Informace:</h2>
	<ul>
		<li>Adresa: {{ $branch->name }}</li>
	</ul>

	<h2>Sklad:</h2>
	<?php
		$query = $branch->medicines()->wherePivot('amount', '>', 0);
	?>
		
	@if($query->count())
		
		<ul>
			@foreach ($query->get() as $medicine)
				<li>
					{!! $medicine->nameLink() !!} ({{$medicine->pivot->amount}} ks)
				</li>
			@endforeach
		<ul>

	@else
		Na skladě není žádný lék.
	@endif
@endsection
