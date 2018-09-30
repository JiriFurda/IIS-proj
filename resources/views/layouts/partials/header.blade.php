<?php
	use App\Classes\Cart;
	use App\Branch;
?>

@auth
	<!-- User detail section start -->
    <div>
    	<b>{{ auth()->user()->name }}</b> -
   
    
	    <a href="{{ route('logout') }}"
	       onclick="event.preventDefault();
	                     document.getElementById('logout-form').submit();">
	        {{ __('Odhlásit se') }}
	    </a>
	    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
	        @csrf
    	</form>
    </div>
    <!-- User detail section end -->



    <div>
    	Pobočka: {!! Branch::current()->nameLink() !!}
    </div>



    <!-- Cart summary section start -->
	<div>
		@if(!Cart::isEmpty())
			<a href="{{ route('cart.index') }}" title="Košík">{{ Cart::count() }} položek</a>
		@else
			Košík je prázdný
		@endif
	</div>
	<!-- Cart summary section end -->


	
	<!-- Navigation menu section start -->
	<nav>
		<ul>
			<li>
				<a href="{{ route('medicines.index') }}">Léky</a>
			</li>
			<li>
				<a href="#">Rezervace</a>
			</li>
			<li>
				<a href="#">Prodeje</a>
			</li>
			<li>
				<a href="{{ route('branches.index') }}">Pobočky</a>
			</li>
			<li>
				<a href="#">Pojiťovny</a>
			</li>
			<li>
				<a href="{{ route('suppliers.index') }}">Dodavatelé</a>
			</li>
			<li>
				<a href="#">Uživatelé</a>
			</li>
		</ul>
	</nav>
	<!-- Navigation menu section end -->
@endauth
