@extends('layouts.app')

@section('content')
    <h1>Hrazení pojišťovny: {{ $insuranceCompany->name }} ({{ $insuranceCompany->code }})</h1>

    {{$errors}}

    @if(empty($medicines))
        <p>V databázi nejsou žádné léky.</p>
    @else
        <form method="post" action="{{route('insurance_companies.contributions.update', $insuranceCompany)}}">
            @csrf
            <table>
                <thead>
                    <th>
                        Název léku
                    </th>
                    <th>
                        Cena celkem
                    </th>
                    <th>
                        Hrazeno
                    </th>
                </thead>
                <tbody>
                    @foreach($medicines as $medicine)
                        <tr>
                            <td>{!! $medicine->nameLink() !!}</td>
                            <td>{{ $medicine->price }} Kč</td>
                            <td>
                                <input type="number"
                                       name="contribution[{{$medicine->id}}]"
                                       min="0"
                                       max="{{$medicine->price}}"
                                       step="0.01"
                                       value="{{ old('contribution['.$medicine->id.']', ($medicine->insuranceCompanies->count() ? $medicine->insuranceCompanies[0]->pivot->amount : null)) }}"
                                >
                                Kč
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
            <button type="send">Aktualizovat</button>
        </form>
    @endif
@endsection
