<?php
	use App\Medicine;
?>

@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Léky v databázi:</h1>

        @if(auth()->user()->isAuthorised('superior'))
            <div>
                <a href="{{ route('medicines.create') }}"><button type="button" class="btn btn-success btn-block">Přidat nový</button></a>
            </div>
        @endif


        @if(empty($medicines))
            <p>V databázi nejsou žádné léky.</p>
        @else
            <table class="table table-dark">
                <thead>
                <tr>
                    <th>Název léku</th>
                </tr>
                </thead>

                <tbody>
                @foreach($medicines as $medicine)
                    <tr>
                        <th>{!! $medicine->nameLink() !!}</th>
                    </tr>

                @endforeach
                </tbody>
            </table>
        @endif
    </div>
@endsection
