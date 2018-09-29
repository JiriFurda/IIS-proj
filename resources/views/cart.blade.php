<?php
	use App\Classes\Cart;
?>

@extends('layouts.app')

@section('content')
	<h1>Léky v košíku:</h1>
	<ul>
		@foreach(Cart::items() as $cartItem)
			<li>
				{!! $cartItem->medicine->nameLink() !!} ({{ $cartItem->quantity }} ks)
			</li>
		@endforeach
	</ul>
@endsection
