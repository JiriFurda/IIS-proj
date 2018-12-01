@extends('layouts.app')

@section('content')
    <h1>Pojišťovna: {{ $insuranceCompany->name }} ({{ $insuranceCompany->code }})</h1>

    <div>Od <input type="text" id="datepicker-from" name="from" value="{{$from}}"></div>
    <div>Do <input type="text" id="datepicker-to" name="to" value="{{$to}}"></div>

    {{dd($sales)}}

    @push('scripts')
        <script>
            {{-- @todo datepicker is not working --}}
            $(function()
            {
                $('#datepicker-from').datepicker();
                $('#datepicker-to').datepicker();
            });
        </script>
    @endpush
@endsection
