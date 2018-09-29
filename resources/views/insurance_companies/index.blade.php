@extends('layouts.app')

@section('content')
	<h1>Pojišťovny v databázi:</h1>
	<ul>
		@foreach(InsuranceCompany::all() as $insuranceCompany)
			<li>
				{!! $insuranceCompany->nameLink() !!}
			</li>
		@endforeach
	</ul>
@endsection