@extends('layouts.app')

@section('content')
    <h1>Pojišťovna: {{ $insuranceCompany->name }} ({{ $insuranceCompany->code }})</h1>

    <form method="get" action="{{route('insurance_companies.sales', $insuranceCompany)}}">
        <div>Od <input type="text" id="datepicker-from" name="from" value="{{$from}}"></div>
        <div>Do <input type="text" id="datepicker-to" name="to" value="{{$to}}"></div>
        <button type="send">Zobrazit</button>
    </form>

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
