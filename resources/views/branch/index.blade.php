<?php
  use App\Branch;
?>


<h1>Léky v databázi:</h1>
<ul>
	@foreach(Branch::all() as $branch)
		<li>
			{!! $branch->nameLink() !!}
		</li>
	@endforeach
</ul>
