@extends('layouts.app')

@section('content')
	<h1>Prodej #{{ $sale->id }}</h1>
	<ul>
		<li>Stav: {{ $sale->state }}</li>
		<li>Čas vytvoření: {{ $sale->created_at }}</li>
	</ul>

	<h2>Souhrn prodaného zboží</h2>
	<table>
		<tbody>
			@foreach($sale->soldMedicines as $soldMedicine)
				<tr>
					<td>
						{!! $soldMedicine->nameLink() !!}
					</td>
					<td>
						{{ $soldMedicine->quantity }} ks
					</td>
					<td>
						{{ $soldMedicine->price }} Kč / ks
					</td>
					<td>
						<b>{{ $soldMedicine->overall_price }} Kč</b>
					</td>
				</tr>
			@endforeach
		</tbody>
	</table>
@endsection
