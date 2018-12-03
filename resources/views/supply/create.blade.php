@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Přidat dodávku</h1>


        @if(empty($medicines))
            <p>V databázi nejsou žádné léky.</p>
        @else
            <form method="post" action="{{route('supply.store')}}">
                @csrf
                <table class="table table-dark">
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
                                    @if ($errors->has("supply.{$medicine->id}"))
                                        @foreach ($errors->get("supply.{$medicine->id}") as $error)
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
                <br>
                <button type="send" class="btn btn-success btn-lg">Přidat</button>
            </form>
        @endif
    </div>
@endsection
