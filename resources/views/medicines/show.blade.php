<?php
	use App\Classes\Cart;
	use App\Branch;
?>

@extends('layouts.app')

@section('content')
	<h1>Lék: {{ $medicine->name }}</h1>

	<form method="POST" action="{{ route('medicines.store', $medicine) }}">
		@csrf
		<input type="number" name="quantity" value="{{ old('quantity', 1) }}" required>
		<button type="submit">Přidat do košíku</button>
	</form>

	<h2>Informace:</h2>
	<ul>
		<li>Cena: {{ $medicine->price }} Kč</li>
		<li>Nutnost předpisu: {{ $medicine->prescription ? 'Ano' : 'Ne' }}</li>
	</ul>

	<h2>Dostupnost:</h2>
	Na této pobočce {{ Branch::current()->getQuantityInStock($medicine) }} ks


	<h2>Dostupnost na dalších pobočkách:</h2>
	<?php
		$query = $medicine->branches()->exceptCurrent()->wherePivot('amount', '>', 0);
	?>
		
		@if($query->count())
			
			<ul>

				@foreach ($query->get() as $branch)
					<li>
						{!! $branch->nameLink() !!} ({{$branch->pivot->amount}} ks)
					</li>
				@endforeach
			</ul>

		@else
			Lék není na skladě na žádné z poboček.
		@endif



	<h2>Dodavatelé:</h2>
	<?php
		$query = $medicine->suppliers;
	?>
		
	@if($query->count())
		
		<ul>
			@foreach ($query as $supplier)
				<li>
					{!! $supplier->nameLink() !!} ({{ $supplier->pivot->price }} Kč)
				</li>
			@endforeach
		</ul>

	@else
		Lék není dodáván ani jedním z dodavatelů.
	@endif
@endsection
