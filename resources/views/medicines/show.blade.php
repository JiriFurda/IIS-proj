<?php
	use App\Classes\Cart;
	use App\Branch;
?>

@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Lék: {{ $medicine->name }}</h1>

        <form method="POST" action="{{ route('medicines.store', $medicine) }}">
            @csrf
            <input type="number" name="quantity" placeholder="Počet" value="{{ old('quantity', 1) }}" required>
            <button type="submit" class="btn btn-success">Přidat do košíku</button>
        </form>

        <h2>Informace:</h2>
        <ul class="list-group list-unstyled">
            <li class="list-group-item-dark border">Cena: {{ $medicine->price }} Kč</li>
            <li class="list-group-item-dark border">Nutnost předpisu: {{ $medicine->prescription ? 'Ano' : 'Ne' }}</li>
        </ul>
        <br>
        @if(auth()->user()->isAuthorised('superior'))
            <a href="{{ route('medicines.edit', $medicine) }}"><button type="button" class="btn btn-danger btn-lg">Upravit</button></a>
        @endif

        <br><br>
        <h2>Dostupnost:</h2>
        Na této pobočce {{ Branch::current()->getQuantityInStock($medicine) }} ks

        <br><br>
        <h2>Dostupnost na dalších pobočkách:</h2>
        <?php
            $query = $medicine->branches()->exceptCurrent()->wherePivot('amount', '>', 0);
        ?>

            @if($query->count())

            <table class="table table-dark">
                <tbody>
                    @foreach ($query->get() as $branch)
                        <tr>
                            <th>{!! $branch->nameLink() !!} ({{$branch->pivot->amount}} ks)</th>
                        </tr>

                    @endforeach
                </tbody>
            </table>


            @else
                Lék není na skladě na žádné z poboček.
                <br>
            @endif



        <br>
        <?php
            $query = $medicine->suppliers;
        ?>


        <h2>Dodavatelé:</h2>
        @if($query->count())
            <table class="table table-dark">

                <tbody>
                @foreach($query as $supplier)
                    <tr>
                        <th>{!! $supplier->nameLink() !!} ({{ $supplier->pivot->price }} Kč)</th>
                    </tr>

                @endforeach
                </tbody>
            </table>

        @else
            Lék není dodáván ani jedním z dodavatelů.
        @endif
    </div>
@endsection
