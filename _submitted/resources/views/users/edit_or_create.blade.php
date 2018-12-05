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
    <div class="container">
        <h1>{{ $mode == 'edit' ? "Upravit uživatele: {$user->name}" : 'Vytvořit uživatele' }}</h1>

        <br>
        <form method="POST" action="{{ $mode == 'edit' ? route('users.update', $user) : route('users.create') }}">
            @csrf

            <div>
                Jméno: <br>
                <input type="text" name="name" value="{{ old('name', $mode == 'edit' ? $user->name : null) }}" required>
            </div>
            <br>
            <div>
                Email: <br>
                <input type="email" name="email" value="{{ old('email', $mode == 'edit' ? $user->email : null) }}" required>
            </div>
            <br>
            <div>
                Heslo: <br>
                <input type="password" name="password" value="" {{ $mode == 'edit' ? '' : 'required' }}>
            </div>
            <br>
            <div>
                Heslo znovu: <br>
                <input type="password" name="password_confirmation" value="" {{ $mode == 'edit' ? '' : 'required' }} autocomplete="off">
            </div>
            @if($mode == 'edit')
                <em>Heslo zůstane beze změny pokud jej nevyplníte</em>
            @endif
            <br>
            <div>
                Role: <br>
                <select name="role_id">
                    @foreach(Role::all() as $role)
                        {{-- @if(auth()->user()->isAuthorised($role)) --}}
                        <option value="{{ $role->id }}" {{ old('role_id', ($mode == 'edit' ? $user->role->id : null)) == $role->id ? 'selected' : '' }}>{{ $role->name }}</option>
                    @endforeach
                </select>
            </div>
            <br>
            <div>
                Pobočka: <br>
                <select name="branch_id">
                    @foreach(Branch::all() as $branch)
                        {{-- @if(auth()->user()->isAuthorised($role)) --}}
                        <option value="{{ $branch->id }}" {{ old('branch_id', ($mode == 'edit' ? $user->branch : null)) == $branch ? 'selected' : '' }}>{{ $branch->name }}</option>
                    @endforeach
                </select>
            </div>
            <br><br>
            <div>
                <button type="submit" class="btn btn-success btn-lg">{{ $mode == 'edit' ? 'Aktualizovat' : 'Vytvořit' }}</button>
            </div>
        </form>
    </div>
@endsection
