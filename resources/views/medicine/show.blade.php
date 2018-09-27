<?php
  use App\Medicine;
?>


<h1>Lék: {{ $medicine->name }}</h1>

<h2>Informace:</h2>
<ul>
	<li>Cena: {{ $medicine->price }} Kč</li>
	<li>Nutnost předpisu: {{ $medicine->prescription ? 'Ano' : 'Ne' }}</li>
</ul>

<h2>Dostupnost:</h2>
<?php
	$query = $medicine->branches()->wherePivot('amount', '>', 0);
?>
	
	@if($query->count())
		
		<ul>
			@foreach ($query->get() as $branch)
				<li>
					{!! $branch->nameLink() !!} ({{$branch->pivot->amount}} ks)
				</li>
			@endforeach
		<ul>

	@else
		Lék není na skladě na žádné z poboček
	@endif
