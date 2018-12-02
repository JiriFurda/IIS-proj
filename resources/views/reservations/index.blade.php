@extends('layouts.app')

@section('content')

    <div class="container">
        <h1>Rezervace pobočky {{ \App\Branch::current()->name }}</h1>
        @if(empty($reservations))
            <p>V databázi nejsou žádné rezervace.</p>
        @else
            <table class="table table-bordered table-dark">
                <thead>
                    <tr>
                        <th scole="col">ID rezervace</th>
                        <th scole="col">Jméno zákazníka</th>
                        <th scole="col">Stav</th>
                        <th scole="col">Čas vytvoření</th>
                        <th scole="col">Akce</th>
                    </tr>
                </thead>
                <tbody>
                @foreach($reservations as $reservation)
                    <tr>
                        <td>
                            {{ $reservation->id }}
                        </td>
                        <td>
                            {{ $reservation->customer_name }}
                        </td>
                        <td>
                            {{ $reservation->rich_state }}
                        </td>
                        <td>
                            {{ $reservation->created_at }}
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        @endif
    </div>
@endsection
