<?php
	use App\Classes\Cart;
	use App\Branch;

	if(isset($medicine))
		$mode = 'edit';
	else
		$mode = 'create';
?>

@extends('layouts.app')

@section('content')
	<h1>{{ $mode == 'edit' ? "Upravit lék: {$medicine->name}" : 'Vytvořit lék' }}</h1>

	<h2>Informace:</h2>
	<form method="POST" action="{{ $mode == 'edit' ? route('medicines.update', $medicine) : route('medicines.create') }}">
		@csrf

		<div>
			Název:
			<input type="text" name="name" value="{{ old('name', $mode == 'edit' ? $medicine->name : null) }}" required>
		</div>
		<div>
			Cena:
			<input type="number" name="price" value="{{ old('price', $mode == 'edit' ? $medicine->price : null  ) }}" min=0 step=0.01 required>
		</div>
		<div>
			Nutnost předpisu:
			<select name="prescription">
				<option value="1" {{ old('prescription', $mode == 'edit' ? $medicine->prescription : null) == 1 ? 'selected' : '' }}>Ano</option>
				<option value="0" {{ old('prescription', $mode == 'edit' ? $medicine->prescription : null) == 0 ? 'selected' : '' }}>Ne</option>
			</select>
		</div>
		<div>
			<button type="submit">{{ $mode == 'edit' ? 'Aktualizovat' : 'Vytvořit' }}</button>
		</div>
	</form>
@endsection
