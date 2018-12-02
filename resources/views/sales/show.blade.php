@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Prodej: {{ $sale->name }}</h1>
        <ul class="list-unstyled">
            <li>Stav: {{ $sale->state }}</li>
            <li>Pobočka: {!! $sale->branch->nameLink() !!}</li>
            <li>Vytvořil: {{ $sale->user->name }}</li>
            <li>Čas vytvoření: {{ $sale->created_at }}</li>
            @if($sale->confirmed)
                <li>Čas potvrzení: {{ $sale->confirmed_at }}</li>
            @endif
        </ul>

        @if(!$sale->confirmed)
                <a href="{{ route('sales.confirm', $sale) }}" title="Potvrdit prodej"><button type="button" class="btn btn-success btn-lg">Potvrdit</button></a>
        @endif

        <h2>Souhrn prodaného zboží</h2>
        <table class="table table-bordered table-dark">
            <thead>
                <tr>
                    <th scope="col"></th>
                    <th scope="col">Název léku</th>
                    <th scope="col">Množství</th>
                    <th scope="col">Cena za kus</th>
                    <th scope="col">Cena</th>
                </tr>
            </thead>
            <tbody>
                @foreach($sale->medicines as $medicine)
                    <tr>
                        <th scope="row">{!! $loop->index + 1 !!}</th>
                        <td>
                            {!! $medicine->nameLink() !!}
                        </td>
                        <td>
                            {{ $medicine->pivot->quantity }} ks
                        </td>
                        <td>
                            {{ $medicine->pivot->price_per_item }} Kč / ks
                        </td>
                        <td>
                            <b>{{ $medicine->overall_price }} Kč</b>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
            <center>Celková cena: <b>{{ $sale->overall_price }} Kč</b></center>
    </div>
@endsection
