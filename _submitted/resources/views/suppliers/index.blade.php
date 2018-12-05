<?php
	use App\Supplier;
?>

@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Dodavatelé v databázi:</h1>
        @if(empty($suppliers))
            <p>V databázi nejsou žádní dodavatelé.</p>
        @else
            <table class="table table-dark">

                <tbody>
                @foreach($suppliers as $supplier)
                    <tr>
                        <th>{!! $supplier->nameLink() !!}</th>
                    </tr>
                @endforeach
                </tbody>
            </table>
        @endif
    </div>
@endsection
