<?php
	use App\Classes\Cart;
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
				<tbody>
					@foreach(Cart::items() as $cartItem)
						<tr>
							<td>
								{!! $cartItem->medicine->nameLink() !!}
							</td>
							<td>
								<input type="number" name="medicines[{{ $loop->index }}][quantity]" value="{{ $cartItem->quantity }}"> ks
								<input type="hidden" name="medicines[{{ $loop->index }}][id]" value="{{ $cartItem->medicine->id }}">
							</td>
							<td>
								{{ $cartItem->medicine->price }} Kč / ks
							</td>
							<td>
								<b>{{ ($cartItem->medicine->price * $cartItem->quantity) }} Kč</b>
							</td>
							<td>
								<a href="{{ route('cart.delete', $cartItem->medicine) }}">X</a>
							</td> 
						</tr>
					@endforeach
				</tbody>
			</table>
			Celkem: X Kč
			<button type="submit">Upravit množství</button>
			<a href="#">Dokončit nákup</a>
		</form>
		{{ $errors }}
	@endif
@endsection
