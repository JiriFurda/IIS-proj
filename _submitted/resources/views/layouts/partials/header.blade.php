<?php
	use App\Classes\Cart;
	use App\Branch;
?>

@auth
	<header>

        <div class="container-fluid " style="background-color:#1F2631; margin-bottom: 30px;">
            <div class="container">
                <div class="row">
                    <div class="col-sm-9">
                        <ul class="my-ul">
                            <li>
                                <a href="{{ route('medicines.index') }}"><button type="button" class="btn btn-info btn-sm">Léky</button></a>
                            </li>
                            <li>
                                <a href="{{ route('reservations.index') }}"><button type="button" class="btn btn-info btn-sm">Rezervace</button></a>
                            </li>
                            <li>
                                <a href="{{ route('sales.index') }}"><button type="button" class="btn btn-info btn-sm">Prodeje</button></a>
                            </li>
                            <li>
                                <a href="{{ route('branches.index') }}"><button type="button" class="btn btn-info btn-sm">Pobočky</button></a>
                            </li>
                            <li>
                                <a href="{{ route('insurance_companies.index') }}"><button type="button" class="btn btn-info btn-sm">Pojišťovny</button></a>
                            </li>
                            <li>
                                <a href="{{ route('suppliers.index') }}"><button type="button" class="btn btn-info btn-sm">Dodavatelé</button></a>
                            </li>
                            <li>
                                <a href="{{ route('supply.create') }}"><button type="button" class="btn btn-info btn-sm">Dodávka</button></a>
                            </li>
                            @if(auth()->user()->isAuthorised('admin'))
                                <li>
                                    <a href="{{ route('users.index') }}"><button type="button" class="btn btn-info btn-sm">Uživatelé</button></a>
                                </li>
                            @endif
                        </ul>
                    </div>

            <!-- User detail section start -->
                <div class="col-sm-3">
                    <div class="d-flex flex-row">
                        <div class="text-truncate">
                            <i class="fas fa-user"></i>
                            <b>{{ auth()->user()->name }}</b>
                        </div>

                        <div class="px-1">
                            <i>({{ auth()->user()->role->name }})</i>
                        </div>
                        <div>
                            <a class="btn-link" href="{{ route('logout') }}" title="Odhlásit se"
                               onclick="event.preventDefault();
                                             document.getElementById('logout-form').submit();">
                                <i class="fas fa-sign-out-alt"></i>
                            </a>
                            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                @csrf
                            </form>
                        </div>
                    </div>

                    <!-- User detail section end -->


                    <div class="text-truncate">
                        <i class="fas fa-warehouse"></i>

                        @if(auth()->user()->isAuthorised('superior'))
                            <a class="dropdown-toggle" href="#" role="button" id="dropdownBranchSwitch" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                {{ Branch::current()->name }}
                            </a>
                            <div class="dropdown-menu" aria-labelledby="dropdownBranchSwitch">
                                <h6 class="dropdown-header">Změnit aktuální pobočku</h6>

                                @foreach(Branch::all() as $branch)
                                    <a class="dropdown-item" href="{{ route('branches.switch', $branch) }}">{{ $branch->name }}</a>
                                @endforeach
                            </div>
                        @else
                            {!! Branch::current()->nameLink() !!}
                        @endif
                    </div>



                    <!-- Cart summary section start -->
                    <div>
                        <i class="fas fa-shopping-cart"></i>
                        @if(!Cart::isEmpty())
                            <a href="{{ route('cart.index') }}" title="Košík">
                                @php $count = Cart::count(); @endphp

                                {{$count}}
                                @if($count > 4 || $count == 0)
                                    položek
                                @elseif($count > 1)
                                    položky
                                @elseif($count == 1)
                                    položka
                                @endif
                            </a>
                        @else
                            Košík je prázdný
                        @endif
                    </div>

                </div>
                <!-- Cart summary section end -->



            </div>

        </div>
    </div>
	</header>
@endauth
