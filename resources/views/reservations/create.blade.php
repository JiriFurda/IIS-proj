<?php
	use App\Classes\Cart;
	use App\Branch;
?>

@extends('layouts.app')

@section('content')


	<h1>Vytvoření objenávky:</h1>
	@if(Cart::isEmpty())
		Váš košík je prázdný.<br>
		Pro vytvoření objednávky košík nejprve naplňte a poté znovu navštivte tuto stránku.
	@else

	
		<form method="POST" action="{{ route('reservations.store') }}">
			@csrf

			<div>
				Jméno zákazníka:
				<input type="text" name="customer_name" placeholder="Vyplňte jméno zákazníka">
			</div>

			<!--
			<div>
				Pobočka:
				@include('partials.branch_select', ['selected' => old('branch_id', Branch::current())])
			</div>
			-->

			<table>
				<thead>
					<tr>
						<th>Název léku</th>
						<th>Počet kusů</th>				
					</tr>
				</thead>
				<tbody>
					@foreach(Cart::items() as $cartItem)
						<tr>
							<td>
								{!! $cartItem->medicine->nameLink() !!}
							</td>
							<td>
								<input type="number"
									name="medicines_quantity[{{ $cartItem->medicine->id }}]"
									value="{{ old("medicines_quantity[{$cartItem->medicine->id}]", $cartItem->quantity - Branch::current()->getQuantityInStock($cartItem->medicine)) }}"	{{-- Value sent before or amount that is not in stock --}}
									min=0>
								ks
							</td>
						</tr>
					@endforeach
				</tbody>
			</table>
			<button type="submit">Vytvořit rezervaci</button>
		</form>
	@endif
@endsection
