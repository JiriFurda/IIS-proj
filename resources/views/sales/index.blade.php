<?php
	use App\Sale;
?>

@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Prodeje v databázi:</h1>

	@if(empty($sales))
		<p>V databázi nejsou žádné prodeje.</p>
	@else
		<ul>
			@foreach($sales as $sale)
				<li>
                    {!! $sale->nameLink() !!} <a style="color:red">{{$sale->confirmed ? null : '(Nepotvrzen)'}}</a>
				</li>
			@endforeach
		</ul>
	@endif
    </div>
@endsection
