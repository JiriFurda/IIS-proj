@extends('layouts.app')

@section('content')
	<h1>Pojišťovny v databázi:</h1>
	@if(empty($insuranceComapnies))
		<p>V databázi nejsou žádné pojišťovny.</p>
	@else
		<ul>
			@foreach($insuranceComapnies as $insuranceCompany)
				<li>
					{!! $insuranceCompany->nameLink() !!}
				</li>
			@endforeach
		</ul>
	@endif
@endsection