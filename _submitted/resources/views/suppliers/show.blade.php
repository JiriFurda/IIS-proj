@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Dodavatel: {{ $supplier->name }}</h1>
        <br>
        <h2>Nabídka:</h2>
        @if($supplier->medicines()->count())

            <table class="table table-dark">
                <thead>
                <tr>
                    <th>Název dodavatele</th>
                    <th>Cena</th>
                </tr>
                </thead>
                <tbody>
                @foreach($supplier->medicines as $medicine)
                    <tr>
                        <th>{!! $medicine->nameLink() !!}</th>
                        <th>({{$medicine->pivot->price}} kč)</th>
                    </tr>
                @endforeach
                </tbody>
            </table>

        @else
            Tento dodvatel aktuálně nedodává žádné léky.
        @endif
    </div>

@endsection
