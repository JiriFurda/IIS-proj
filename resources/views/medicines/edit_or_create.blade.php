<?php
	use App\Classes\Cart;
	use App\Branch;
?>

@extends('layouts.app')

@section('content')
	<h1>Lék: {{ $medicine->name }}</h1>

	<h2>Informace:</h2>
	<form method="POST" action="{{ route('medicines.update', $medicine) }}">
		@csrf

		<div>
			Název:
			<input type="text" name="name" value="{{ old('name', $medicine->name) }}" required>
		</div>
		<div>
			Cena:
			<input type="number" name="price" value="{{ old('price', $medicine->price) }}" min=0 step=0.01 required>
		</div>
		<div>
			Nutnost předpisu:
			<select name="prescription">
				<option value="1" {{ old('prescription', $medicine->prescription) == 1 ? 'selected' : '' }}>Ano</option>
				<option value="0" {{ old('prescription', $medicine->prescription) == 1 ? 'selected' : '' }}>Ne</option>
			</select>
		</div>
		<div>
			<button type="submit">Aktualizovat</button>
		</div>
	</form>
@endsection
