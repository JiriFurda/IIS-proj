<?php
  use App\Medicine;
?>


<h1>Léky v databázi:</h1>
<ul>
	@foreach(Medicine::all() as $medicine)
		<li>
			{!! $medicine->nameLink() !!}
		</li>
	@endforeach
</ul>
