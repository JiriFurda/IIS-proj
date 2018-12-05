@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Hrazení pojišťovny: {{ $insuranceCompany->name }} ({{ $insuranceCompany->code }})</h1>

        @if(empty($medicines))
            <p>V databázi nejsou žádné léky.</p>
        @else
            <form method="post" action="{{route('insurance_companies.contributions.update', $insuranceCompany)}}">
                @csrf
                <table class="table table-dark">
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
                                    <br>
                                    @if ($errors->has("contribution.{$medicine->id}"))
                                        @foreach ($errors->get("contribution.{$medicine->id}") as $error)
                                            <div class="errorMessage">
                                                <strong>{{$error}}</strong>
                                            </div>
                                        @endforeach
                                    @endif
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
                <button type="send" class="btn btn-success btn-lg">Aktualizovat</button>
            </form>
    </div>
    @endif
@endsection
