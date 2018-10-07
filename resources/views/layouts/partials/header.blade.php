<?php
	use App\Classes\Cart;
	use App\Branch;
?>

@auth
	<header>

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
	    	<div>Pobočka: {!! Branch::current()->nameLink() !!}</div>
	    	<div>Role: {{ auth()->user()->role->name }}</div>
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

		<hr>
		
		<!-- Navigation menu section start -->
		<nav>
			Menu:

			<ul>
				<li>
					<a href="{{ route('medicines.index') }}">Léky</a>
				</li>
				<li>
					<a href="#">//Rezervace</a>
				</li>
				<li>
					<a href="{{ route('sales.index') }}">Prodeje</a>
				</li>
				<li>
					<a href="{{ route('branches.index') }}">Pobočky</a>
				</li>
				<li>
					<a href="#">//Pojiťovny</a>
				</li>
				<li>
					<a href="{{ route('suppliers.index') }}">Dodavatelé</a>
				</li>
				@if(auth()->user()->isAuthorised('superior'))
					<li>
						<a href="#">Uživatelé</a> {{-- @todo No idea why {{ route('users.index') }} is not working --}}
					</li>
				@endif
			</ul>
		</nav>
		<!-- Navigation menu section end -->

		<hr>

	</header>
@endauth
