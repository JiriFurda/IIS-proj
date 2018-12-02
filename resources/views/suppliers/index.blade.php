<?php
	use App\Supplier;
?>

@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Dodavatelé v databázi:</h1>
        @if(empty($sales))
            <p>V databázi nejsou žádní dodavatelé.</p>
        @else
            <ul>
                @foreach($suppliers as $supplier)
                    <li>
                        {!! $supplier->nameLink() !!}
                    </li>
                @endforeach
            </ul>
        @endif
    </div>
@endsection
