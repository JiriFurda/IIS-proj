@extends('layouts.app')

@section('content')
    <div class="container">
	<h1>Pojišťovny v databázi:</h1>

    {{$errors}}

    @if(empty($insuranceCompanies))
		<p>V databázi nejsou žádné pojišťovny.</p>
	@else
		<ul>
			@foreach($insuranceCompanies as $insuranceCompany)
				<li>
                    {{$insuranceCompany->name}} ({{$insuranceCompany->code}})
                    @if(auth()->user()->isAuthorised('superior'))
                        <a href="{{route('insurance_companies.contributions.edit', $insuranceCompany)}}">Upravit příspěvky</a>
                        <a href="{{route('insurance_companies.sales', $insuranceCompany)}}">Export výkazů</a>
                    @endif
				</li>
			@endforeach
		</ul>
	@endif
    </div>
@endsection
