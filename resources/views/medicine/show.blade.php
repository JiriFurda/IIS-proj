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
@todo