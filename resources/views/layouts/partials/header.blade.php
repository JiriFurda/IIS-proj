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
		<!--<nav>
			Menu:-->

        <div>
            Menu
			<ul class="my-ul">
                <li>
                    <a href="{{ route('medicines.index') }}"><button type="button" class="btn btn-primary btn-xs">Léky</button></a>
                </li>
				<li>
                    <a href="{{ route('reservations.create') }}"><button type="button" class="btn btn-primary btn-xs">Rezervace</button></a>
                <li>
                    <a href="{{ route('sales.index') }}"><button type="button" class="btn btn-primary btn-xs">Prodeje</button></a>
				</li>
				<li>
                    <a href="{{ route('branches.index') }}"><button type="button" class="btn btn-primary btn-xs">Pobočky</button></a>
				</li>
				<li>
                    <a href="#"><button type="button" class="btn btn-primary btn-xs">//Pojišťovny</button></a>
				</li>
				<li>
                    <a href="{{ route('suppliers.index') }}"><button type="button" class="btn btn-primary btn-xs">Dodavatelé</button></a>
				</li>
				@if(auth()->user()->isAuthorised('superior'))
					<li>
                        <a href="{{ route('users.index') }}"><button type="button" class="btn btn-primary btn-xs">Uživatelé</button></a>
					</li>
				@endif
			</ul>
        </div>
		<!--</nav> -->
		<!-- Navigation menu section end -->

		<hr>

	</header>
@endauth
