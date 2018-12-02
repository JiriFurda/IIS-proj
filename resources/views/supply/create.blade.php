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
                    <?php
                        $index = 0;
                    ?>

                        @foreach($medicines as $medicine)
                            <?php
                                $index++;
                            ?>
                            <tr>
                                <td>{!! $medicine->nameLink() !!}</td>
                                <td>
                                    <input type="number"
                                           name="supply[{{$medicine->id}}]"
                                           min="0">
                                    Ks
                                    @if ($errors->has("supply.{$index}"))
                                        @foreach ($errors->get("supply.{$index}") as $error)
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
