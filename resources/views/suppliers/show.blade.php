@extends('layouts.app')

@section('content')
	<h1>Dodavatel: {{ $supplier->name }}</h1>

	<h2>Nabídka:</h2>	
	@if($supplier->medicines()->count())
		
		<ul>
			@foreach ($supplier->medicines as $medicine)
				<li>
					{!! $medicine->nameLink() !!} ({{$medicine->pivot->price}} kč)
				</li>
			@endforeach
		<ul>

	@else
		Tento dodvatel aktuálně nedodává žádné léky.
	@endif
@endsection
	