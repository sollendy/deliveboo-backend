@extends('layouts.app')

@section('content')

<div class="restaurant-container">
    <div class="container-fluid">
        <div class="row justify-content-center">
        <h1 class="text-center my-3">
            Benvenuto!  {{Auth::user()->name}}
        </h1>

        @if(session ('delete'))
            <div class="col-12 col-md-10 col-lg-11 alert alert-warning">
                Il Piatto {{ session('delete') }}  è stato eliminato
            </div>
        @elseif(session('update'))
            <div class="col-12 col-md-10 col-lg-11 alert alert-primary">
                Il Piatto {{ session('update') }}   è stato aggiornato
            </div>
        @elseif(session('created'))
            <div class="col-12 col-md-10 col-lg-11 alert alert-success">
                Il Piatto {{ session('created') }}  è stato creato con successo
            </div>
        @endif

        @foreach($restaurant as $single_restaurant)
            <div class="card-image p-0 mb-4">
                <div class="layer-black"></div>
                <img class="img-fluid image-owner w-100" src="{{ $single_restaurant->photo }}" alt="{{ $single_restaurant->name }}">
                <div class="card__title text-white">{{ $single_restaurant->name }}</div>
                <div class="card__subtitle text-white">{{ $single_restaurant->address }}</div>
                <div class="card__wrapper pb-4">
                    <button class="card__btn button-add">
                        <a class="text-black onhover text-decoration-none" href="{{ route('admin.restaurant.create') }}">
                            Aggiungi Piatto
                        </a>
                    </button>
                    <button class="card__btn card__btn-solid button-detail">
                        <a class="text-decoration-none" href="{{ route('admin.restaurant.dashboard', $single_restaurant->id) }}">
                            Dettagli
                        </a>
                    </button>
                </div>
            </div>
        @endforeach
        </div>
    </div>
        <div class="container">
            <div class="row">
                <div class="col-11 col-md-12 mb-5">
                    <h1 class="text-center mb-5">
                        Le Tue Pietanze
                    </h1>
                    @foreach ($single_restaurant->dishes as $dish)
                        <div class="row">
                            <div class="col-12">
                                <p class="fw-semibold">{{ $dish->name }}</p>
                                <img src="{{$dish->image}}" class="img-fluid img-thumbnail width-200" alt="{{$dish->name}}">
                                <p>{{ $dish->description }}</p>
                                <p> <span class="fw-semibold">Ingredienti: </span> {{ $dish->ingredients }}</p>
                                <p>{{ $dish->price }} €</p>
                            </div>
                        </div>
                        <div class="row justify-content-center mb-5">
                            <div class="col-5 col-md-2">
                                <button class="card__btn">
                                    <a class='text-decoration-none text-black onhover' href="{{ route('admin.restaurant.edit', ['id' => $dish->id]) }}">
                                        Modifica
                                    </a>
                                </button>
                            </div>
                            <div class="col-5 col-md-2">
                                <form class='delete-button' action="{{ route ('admin.restaurant.destroy', ['id' => $dish->id]) }}" method='POST'>
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" onclick="return confirm( 'Vuoi eliminare questo piatto??')"  class="card__btn card__btn-solid">
                                        Elimina
                                    </button>
                                </form>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
</div>

@endsection
