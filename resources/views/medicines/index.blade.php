<?php
	use App\Medicine;
?>

@extends('layouts.app')

@section('content')
	<h1>Léky v databázi:</h1>
	<ul>
		@foreach(Medicine::all() as $medicine)
			<li>
				{!! $medicine->nameLink() !!}
			</li>
		@endforeach
	</ul>
@endsection
