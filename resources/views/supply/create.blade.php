@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Přidat dodávku</h1>

        {{$errors}}

        @if(empty($medicines))
            <p>V databázi nejsou žádné léky.</p>
        @else
            <form method="post" action="{{route('supply.store')}}">
                @csrf
                <table>
                    <thead>
                        <th>
                            Název léku
                        </th>
                        <th>
                            Množství
                        </th>
                    </thead>
                    <tbody>
                        @foreach($medicines as $medicine)
                            <tr>
                                <td>{!! $medicine->nameLink() !!}</td>
                                <td>
                                    <input type="number"
                                           name="supply[{{$medicine->id}}]"
                                           min="0">
                                    Ks
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
                <button type="send">Přidat</button>
            </form>
        @endif
    </div>
@endsection
