<?php
	use App\Branch;
?>

@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Pobočky v databázi:</h1>

        @if(empty($branches))
            <p>V databázi nejsou žádné pobočky.</p>
        @else
            <table class="table table-dark">
                <thead>
                <tr>
                    <th>Název pobočky</th>
                </tr>
                </thead>

                <tbody>
                @foreach($branches as $branch)
                    {!! $branch == Branch::current() ? '<b>' : '' !!}
                    <tr>
                        <th>{!! $branch->nameLink() !!}</th>
                    </tr>
                    {!! $branch == Branch::current() ? '</b>' : '' !!}
                @endforeach
                </tbody>
            </table>
        @endif
    </div>
@endsection
