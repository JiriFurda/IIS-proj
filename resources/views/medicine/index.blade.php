<?php
  use App\Medicine;
?>


<h1>Léky v databázi:</h1>
<ul>
	@foreach(Medicine::all() as $medicine)
		<li>
			<a href="{{ route('medicine.show', compact('medicine')) }}">
				{{ $medicine->name }}
			</a>
		</li>
	@endforeach
</ul>
