@extends('layouts.app')

@section('content')
    <h1>Výkazy pojišťovny: {{ $insuranceCompany->name }} ({{ $insuranceCompany->code }})</h1>

    <form method="get" action="{{route('insurance_companies.sales', $insuranceCompany)}}">
        <div>Od <input type="text" id="datepicker-from" name="from" value="{{$from}}"></div>
        <div>Do <input type="text" id="datepicker-to" name="to" value="{{$to}}"></div>
        <button type="send">Zobrazit</button>
    </form>

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
@endsection
