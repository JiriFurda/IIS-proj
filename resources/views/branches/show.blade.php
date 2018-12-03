@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Pobočka: {{ $branch->name }}</h1>

            {{ $branch->address }}
    </div>
    <br>
    <div class="container">
        <h2>Sklad:</h2>
        <?php
            $query = $branch->medicines()->wherePivot('amount', '>', 0);
        ?>

        @if($query->count())
            <table class="table table-dark">
                <thead>
                <tr>
                    <th>Název pobočky</th>
                    <th>Počet</th>
                </tr>
                </thead>

                <tbody>
                @foreach($query->get() as $medicine)
                    <tr>
                        <th>{!! $medicine->nameLink() !!}</th>
                        <th>{{$medicine->pivot->amount}} ks</th>
                    </tr>
                @endforeach
                </tbody>
            </table>

        @else
            Na skladě není žádný lék.
        @endif

    </div>
@endsection
