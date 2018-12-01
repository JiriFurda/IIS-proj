<?php
	use App\Medicine;
?>

@extends('layouts.app')

@section('content')
    <div class="container-fluid">
        <h1>Léky v databázi:</h1>

        @if(auth()->user()->isAuthorised('superior'))
            <div>
                <a href="{{ route('medicines.create') }}"><button type="button" class="btn btn-success btn-lg">Přidat nový</button></a>
            </div>
        @endif
    </div>

	@if(empty($medicines))
		<p>V databázi nejsou žádné léky.</p>
	@else
		<ul>
			@foreach($medicines as $medicine)
				<li>
					{!! $medicine->nameLink() !!}
				</li>
			@endforeach
		</ul>
	@endif
@endsection
