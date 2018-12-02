<?php
	use App\Classes\Cart;
	use App\Branch;
?>

@auth
	<header>

        <div class="container" style="background-color:#1F2631;">
            <div class="row">
                <div class="col-sm-10">
                    <ul class="my-ul">
                        <li>
                            <a href="{{ route('medicines.index') }}"><button type="button" class="btn btn-info btn-sm">Léky</button></a>
                        </li>
                        <li>
                            <a href="{{ route('reservations.create') }}"><button type="button" class="btn btn-info btn-sm">Rezervace</button></a>
                        <li>
                            <a href="{{ route('sales.index') }}"><button type="button" class="btn btn-info btn-sm">Prodeje</button></a>
                        </li>
                        <li>
                            <a href="{{ route('branches.index') }}"><button type="button" class="btn btn-info btn-sm">Pobočky</button></a>
                        </li>
                        <li>
                            <a href="#"><button type="button" class="btn btn-info btn-sm">//Pojišťovny</button></a>
                        </li>
                        <li>
                            <a href="{{ route('suppliers.index') }}"><button type="button" class="btn btn-info btn-sm">Dodavatelé</button></a>
                        </li>
                        @if(auth()->user()->isAuthorised('superior'))
                            <li>
                                <a href="{{ route('users.index') }}"><button type="button" class="btn btn-info btn-sm">Uživatelé</button></a>
                            </li>
                        @endif
                    </ul>
                </div>

            <!-- User detail section start -->
                <div class="col-sm-2">
                    <b>{{ auth()->user()->name }}</b> -


                    <a class="btn-link" href="{{ route('logout') }}"
                       onclick="event.preventDefault();
                                     document.getElementById('logout-form').submit();">
                        {{ __('Odhlásit se') }}
                    </a>
                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                        @csrf
                    </form>

                    <!-- User detail section end -->



                    <div>
                        <!--<div>Pobočka: {!! Branch::current()->nameLink() !!}</div>-->
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

                </div>
                <!-- Cart summary section end -->



            </div>

        </div>
    <br><br>

	</header>
@endauth
