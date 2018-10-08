@extends('layouts.app')

@section('content')


	<h1>Uživatelé v databázi:</h1>
	@if(empty($users))
		<p>V databázi nejsou žádní uživatelé.</p>
	@else

		@if(auth()->user()->isAuthorised('superior'))
			<a href="{{ route('users.create') }}">Přidat uživatele</a>
		@endif

		<table>
			<thead>
				<tr>
					<th>Jméno uživatele</th>
					<th>Role</th>
					@if(auth()->user()->isAuthorised('admin'))
						<th colspan="2">Akce</th>
					@endif
				</tr>
			</thead>
			<tbody>
				@foreach($users as $user)
					<tr>
						<td>
							{{ $user->name }}
						</td>
						<td>
							{{ $user->role->name }}
						</td>
						@if(auth()->user()->isAuthorised('admin'))
							<td>
								<a href="{{ route('users.edit', $user) }}" title="Upravit uživatele">Upravit</a>
							</td>
							@if($user->id != auth()->user()->id)
							<td>
								<a href="{{ route('users.login', $user) }}" title="Přihlásit se jako uživatel">Přihlásit se</a>
							</td>
							@endif
						@endif
					</tr>
				@endforeach
			</tbody>
		</table>
	@endif
@endsection
