<?php
    use App\InsuranceCompany;
?>

@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Pojišťovny v databázi:</h1>
        @if(empty($insuranceCompanies))
            <p>V databázi nejsou žádné pojišťovny.</p>
        @else
            @foreach($insuranceCompanies as $insuranceCompany)
                <div class="row">
                    <div class="col-2">{{$insuranceCompany->name}} ({{$insuranceCompany->code}})</div>
                    @if(auth()->user()->isAuthorised('superior'))
                        <div class="col-2"><a class="btn btn-sm btn-success" href="{{route('insurance_companies.contributions.edit', $insuranceCompany)}}">Upravit příspěvky</a></div>
                        <div class="col-2"><a class="btn btn-sm btn-success" href="{{route('insurance_companies.sales', $insuranceCompany)}}">Export výkazů</a></div>
                    @endif

                </div>
                <br>
                    @endforeach
        @endif
    </div>
@endsection
