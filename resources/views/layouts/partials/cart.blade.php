<?php
	use App\Classes\Cart;
?>

@if(Cart::count())
	<a href="{{ route('cart.index') }}" title="Košík">{{ Cart::count() }} položek</a>
@else
	Košík je prázdný
@endif