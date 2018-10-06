@if($msg = session('alert-error'))
	<p>Chyba: {{ $msg }}</p>
@endif

@if($msg = session('alert-success'))
	<p>Úspěch: {{ $msg }}</p>
@endif