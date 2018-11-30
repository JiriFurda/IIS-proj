@extends('layouts.app')

@section('content')
	<h1>Prodej: {{ $sale->name }}</h1>
	<ul>
		<li>Stav: {{ $sale->state }}</li>
		<li>Pobočka: {!! $sale->branch->nameLink() !!}</li>
		<li>Vytvořil: {{ $sale->user->name }}</li>
		<li>Čas vytvoření: {{ $sale->created_at }}</li>
		@if($sale->confirmed)
			<li>Čas potvrzení: {{ $sale->confirmed_at }}</li>
		@endif
	</ul>

	@if(!$sale->confirmed)
		<a href="{{ route('sales.confirm', $sale) }}" title="Potvrdit prodej">Potvrdit</a>
	@endif

	<h2>Souhrn prodaného zboží</h2>
	<table>
		<thead>
			<tr>
				<th>Název léku</th>
				<th>Množství</th>
				<th>Cena za kus</th>
				<th>Cena</th>
			</tr>
		</thead>
		<tbody>
			@foreach($sale->medicines as $medicine)
				<tr>
					<td>
						{!! $medicine->nameLink() !!}
					</td>
					<td>
						{{ $medicine->pivot->quantity }} ks
					</td>
					<td>
						{{ $medicine->pivot->price_per_item }} Kč / ks
					</td>
					<td>
						<b>{{ $medicine->overall_price }} Kč</b>
					</td>
				</tr>
			@endforeach
		</tbody>
	</table>
	Celková cena: <b>{{ $sale->overall_price }} Kč</b>

    @if($sale->prescripted)
        <h2>Informace o prodeji na předpis</h2>
        <ul>
            <li>Rodné číslo zákazníka: {{ $sale->customer_nin }}</li>
            <li>Pojišťovna: {!! $sale->insuranceCompany->nameLink() !!}</li>
        </ul>
    @endif

@endsection
