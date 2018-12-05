<?php
	use App\Classes\Cart;
	use App\Branch;
	use App\InsuranceCompany;

	if(isset($medicine))
		$mode = 'edit';
	else
		$mode = 'create';
?>

@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>{{ $mode == 'edit' ? "Upravit lék: {$medicine->name}" : 'Vytvořit lék' }}</h1>

        <!--<h2>Informace:</h2>-->
        <form method="POST" action="{{ $mode == 'edit' ? route('medicines.update', $medicine) : route('medicines.create') }}">
            @csrf

            <div>
                Název:<br>
                <input type="text" name="name" placeholder="Název" value="{{ old('name', $mode == 'edit' ? $medicine->name : null)}}" required>
                @if ($errors->has("name"))
                    @foreach ($errors->get("name") as $error)
                        <div class="errorMessage">
                            <strong>{{$error}}</strong>
                        </div>
                    @endforeach
                @endif
            </div>
            <br>
            <div>
                Cena:<br>
                <input type="number" name="price" placeholder="Cena > 0" value="{{ old('price', $mode == 'edit' ? $medicine->price : null  ) }}" min=0 step=0.01 required>
                @if ($errors->has("price"))
                    @foreach ($errors->get("price") as $error)
                        <div class="errorMessage">
                            <strong>{{$error}}</strong>
                        </div>
                    @endforeach
                @endif
            </div>
            <br>
            <div>
                Nutnost předpisu:
                <select name="prescription">
                    <option value="1" {{ old('prescription', $mode == 'edit' ? $medicine->prescription : null) == 1 ? 'selected' : '' }}>Ano</option>
                    <option value="0" {{ old('prescription', $mode == 'edit' ? $medicine->prescription : null) == 0 ? 'selected' : '' }}>Ne</option>
                </select>
            </div>
            <div>
                <br>
                <button type="submit" class="btn btn-success">{{ $mode == 'edit' ? 'Aktualizovat' : 'Vytvořit' }}</button>
            </div>
        </form>
    </div>
@endsection
