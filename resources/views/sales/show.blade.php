@extends('layouts.app')

@section('content')
	<h1>Prodej #{{ $sale->id }}</h1>
	<ul>
		<li>Stav: {{ $sale->state }}</li>
		<li>Čas vytvoření: {{ $sale->created_at }}</li>
	</ul>

	<h2>Souhrn prodaného zboží</h2>
	<table>
		<thead>
			<tr>
				<th>Název léku</th>
				<th>Počet kusů</th>
				<th>Cena za kus</th>
				<th>Celková cena</th>
				
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
@endsection
