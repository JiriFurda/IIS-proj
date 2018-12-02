@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Výkazy pojišťovny: {{ $insuranceCompany->name }} ({{ $insuranceCompany->code }})</h1>

        <form method="get" action="{{route('insurance_companies.sales', $insuranceCompany)}}">
            <div>Od:  <input type="text" id="datepicker-from" name="from" value="{{$from}}"></div>
            @if ($errors->has("from"))
                @foreach ($errors->get("from") as $error)
                    <div class="errorMessage">
                        <strong>{{$error}}</strong>
                    </div>
                @endforeach
            @endif
            <div>Do:  <input type="text" id="datepicker-to" name="to" value="{{$to}}"></div>
            @if ($errors->has("to"))
                @foreach ($errors->get("to") as $error)
                    <div class="errorMessage">
                        <strong>{{$error}}</strong>
                    </div>
                @endforeach
            @endif
            <br>
            <button type="send" class="btn btn-success btn-lg">Zobrazit</button>
        </form>

        <br>
        @if(empty($reports))
            <p>V období od {{$from}} do {{$to}} není pro danou pojišťovnu evidován žádný výkaz.</p>
        @else
            <table>
                <thead>
                    <th>Období</th>
                    <th>Výše hrazení</th>
                </thead>
                <tbody>
                    @foreach($reports as $report)
                        <tr>
                            <td>
                                {{$report['date']}}
                            </td>
                            <td>
                                {{$report['price']}} Kč
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
            Celkem: <strong>{{$sum}} Kč</strong>
        @endif

        @push('scripts')
            <script>
                $(function()
                {
                    $('#datepicker-from').datepicker($.datepicker.regional['cs']);
                    $('#datepicker-to').datepicker($.datepicker.regional['cs']);
                });
            </script>
        @endpush
    </div>
@endsection
