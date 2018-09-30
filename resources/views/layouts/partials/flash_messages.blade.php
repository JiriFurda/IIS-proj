@if($msg = session('error'))
	Chyba: {{ $msg }}
@endif