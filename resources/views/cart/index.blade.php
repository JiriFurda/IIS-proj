<?php
	use App\Classes\Cart;
	use App\Branch;
?>

@extends('layouts.app')

@section('content')


	<h1>Léky v košíku:</h1>
	@if(Cart::isEmpty())
		Váš košík je prázdný.
	@else
		<form method="POST" action="{{ route('cart.update') }}">
			@csrf

			<table>
				<thead>
					<tr>
						<th>Název léku</th>
						<th>Počet kusů</th>
						<th>Počet kusů skladem</th>
						<th>Cena za kus</th>
						<th colspan="2">Celková cena</th>
						
					</tr>
				</thead>
				<tbody>
					@foreach(Cart::items() as $cartItem)
						<tr>
							<td>
								{!! $cartItem->medicine->nameLink() !!}
							</td>
							<td>
								{{-- @todo error class when $cartItem->verifyStock() == false --}}
								<input type="number" name="medicines[{{ $loop->index }}][quantity]" value="{{ $cartItem->quantity }}"> ks
								<input type="hidden" name="medicines[{{ $loop->index }}][id]" value="{{ $cartItem->medicine->id }}">
							</td>
							<td>
								{{ Branch::current()->getQuantityInStock( $cartItem->medicine) }} ks
							</td>
							<td>
								{{ $cartItem->medicine->price }} Kč / ks
							</td>
							<td>
								<b>{{ $cartItem->getPrice() }} Kč</b>
							</td>
							<td>
								<a href="{{ route('cart.delete', $cartItem->medicine) }}">X</a>
							</td> 
						</tr>
					@endforeach
				</tbody>
			</table>
			Celkem: @todo Kč
			<button type="submit">Upravit množství</button>
			<a href="{{ route('sales.store') }}">Dokončit nákup</a>
			{{-- @todo if medicine out of stock <a href="route('reservations.index')">Vytvorit rezervaci</a>--}}
		</form>
	
	@endif
@endsection
