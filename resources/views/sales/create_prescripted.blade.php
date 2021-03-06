<?php
    use App\Sale;
    use App\Classes\Cart;
    use App\InsuranceCompany;
?>

@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Prodej na předpis</h1>

        @if(Cart::isEmpty())
            <p>V databázi nejsou žádné pobočky.</p>
        @else
            <p>V košíku se nachází lék na předpis, proto prosím doplňte následující informace</p>
            <form method="POST" action="{{route('sales.store_prescripted')}}">
                @csrf
                <div>
                    Rodné číslo: <input type="text" name="customer_nin" value="{{ old('customer_nin') }}"> {{-- @todo check format --}}
                </div>
                <br>
                <div>
                    Pojišťovna :
                    <select name="insurance_company_id">
                        @foreach(InsuranceCompany::orderBy('code')->get() as $insuranceCompany)
                            <option value="{{ $insuranceCompany->id }}" {{ old('insurance_company_id') == $insuranceCompany->id ? 'selected' : '' }}>{{ $insuranceCompany->code }} - {{ $insuranceCompany->name }}</option>
                        @endforeach
                    </select>
                </div>
                <br>
                <div>
                    <button type="submit" class="btn btn-lg btn-success">Potvrdit</button>
                </div>
            </form>
        @endif
    </div>
@endsection
