<?php
	use App\Role;
	use App\Branch;

    if(isset($user))
        $mode = 'edit';
    else
        $mode = 'create';
?>

@extends('layouts.app')

@section('content')
	<h1>{{ $mode == 'edit' ? "Upravit uživatele: {$user->name}" : 'Vytvořit uživatele' }}</h1>

	<h2>Informace:</h2>
	<form method="POST" action="{{ $mode == 'edit' ? route('users.update', $user) : route('users.create') }}">
		@csrf

		<div>
			Jméno:
			<input type="text" name="name" value="{{ old('name', $mode == 'edit' ? $user->name : null) }}" required>
		</div>
		<div>
			Email:
			<input type="email" name="email" value="{{ old('email', $mode == 'edit' ? $user->email : null) }}" required>
		</div>
		<div>
			Heslo:
			<input type="password" name="password" value="" {{ $mode == 'edit' ? '' : 'required' }}>
		</div>
		<div>
			Heslo znovu:
			<input type="password" name="password_confirmation" value="" {{ $mode == 'edit' ? '' : 'required' }} autocomplete="off">
		</div>
        @if($mode == 'edit')
            <em>Heslo zůstane beze změny pokud jej nevyplníte</em>
        @endif
		<div>
			Role:
			<select name="role_id">
				@foreach(Role::all() as $role)
					{{-- @if(auth()->user()->isAuthorised($role)) --}}
					<option value="{{ $role->id }}" {{ old('role_id', ($mode == 'edit' ? $user->role->id : null)) == $role->id ? 'selected' : '' }}>{{ $role->name }}</option>
				@endforeach
			</select>
		</div>
        <div>
            Pobočka:
            <select name="branch_id">
                @foreach(Branch::all() as $branch)
                    {{-- @if(auth()->user()->isAuthorised($role)) --}}
                    <option value="{{ $branch->id }}" {{ old('branch_id', ($mode == 'edit' ? $user->branch : null)) == $branch ? 'selected' : '' }}>{{ $branch->name }}</option>
                @endforeach
            </select>
        </div>
		<div>
			<button type="submit">{{ $mode == 'edit' ? 'Aktualizovat' : 'Vytvořit' }}</button>
		</div>
	</form>
@endsection
