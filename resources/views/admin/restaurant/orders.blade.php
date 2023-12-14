@extends('layouts.app')

@section('content')

<div class="container-fluid dashboard-container">
    <div class="row">

    <!-- Sidebar -->

        <div class="side-bar d-none d-md-block col-md-2 col-lg-2 bg-primary text-white">
            <h5 class="pt-5">Gestore Ristorante {{Auth::user()->name}}</h5>
            @foreach($restaurants as $restaurant)
            <img class="owner-image" src="{{ $restaurant->photo }}" alt="">
            <p>
                Nome Ristorante: {{ $restaurant->name }}
            </p>
            <div class="types">
                Tipologia:
                @foreach ($restaurant->types as $type)
            <span class="">
                {{ $type->name }}
            </span>
            @endforeach
            </div>
            <p>
                Indrizzo: {{ $restaurant->address }}
            </p>
            @endforeach
            <button class="card__btn">
                <a class='text-decoration-none text-black onhover' href="{{ route('admin.restaurant.editAccount', $restaurant->id) }}">
                    Modifica
                </a>
            </button>
            <button class="card__btn">
                <a class='text-decoration-none text-black onhover' href="{{ route('admin.restaurant.orders') }}">
                    Lista ordini
                </a>
            </button>
        </div>



    <!-- Dashboard -->

        <div class="dashboard overflow-scroll pt-5 col-12 col-md-10 col-lg-10">
            <!-- Main content area for the dashboard -->
            <h1 class="text-black">Ordini ricevuti</h1>
            @foreach ($orders as $order)
            <div class="row mb-3">
                <div class="col-3">
                    <h5 class="fw-semibold">Ordine con ID {{$order->id}}</h5>
                    <p class="fw-bold">Dati utente</p>
                    <p class="m-0">Nome: {{$order->name}}</p>
                    <p class="m-0">Cognome: {{$order->last_name}}</p>
                    <p class="m-0">Indirizzo: {{$order->address}}</p>
                    <p>Telefono: {{$order->phone}}</p>
                </div>
                <div class="col-3">
                    <p class="fw-bold">Piatti ordinati</p>
                    @foreach ($order->dishes as $dish)
                    <p class="m-0">Piatto: {{$dish->name}}</p>
                    <p class="m-0">Quantità: {{$dish->pivot->quantity}}</p>
                    <p>Prezzo: {{$dish->price}} &euro;</p>
                    @endforeach

                </div>

                <div class="col-3">
                    <p class="fw-semibold">Informazioni pagamento</p>
                    <p class="m-0">Data: {{$order->created_at}}</p>
                    <p class="m-0">Totale ordine: {{$order->total_price}} &euro;</p>
                    <p class="text-uppercase fw-bold">Pagato:<span class="{{$order->status === 1 ? 'text-success' : 'text-danger'}}"> {{$order->status === 1 ? 'SI' : 'NO'}}</span></p>
                </div>
<p>-----------------------------------------------------------------------------------------</>------------------------------------------------------------------------------</p>
            </div>

        @endforeach
        </div>
        <footer class="footer-dashboard mt-auto py-3 bg-dark text-white">
            <div class="container text-center">
                <img class="logo-footer mt-3" src="{{ asset('img/logo_deliveboo-03.png') }}" alt="logo-deliveboo">
                <p>&copy; 2023 Deliveboo</p>
            </div>
        </footer>
    </div>
</div>

@endsection
