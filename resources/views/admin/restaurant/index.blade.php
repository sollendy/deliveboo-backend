@extends('layouts.app')


@section('content')

<div class="restaurant-container container">
    <div class="row justify-content-center">
            <h1 class="text-center mb-3">
                Welcome {{Auth::user()->name}}
            </h1>
        @if(session ('delete'))
            <div class="col-12 col-md-10 col-lg-11 alert alert-warning">
                The Dish {{ session('delete') }}  has been deleted
            </div>
        @elseif(session('update'))
        <div class="col-12 col-md-10 col-lg-11 alert alert-primary">
                The Dish {{ session('update') }}  has been updated
        </div>
        @elseif(session('created'))
        <div class="col-12 col-md-10 col-lg-11 alert alert-success">
                The Dish {{ session('created') }}  has been created
        </div>
        @endif
            <div class="card p-0  col-11 col-md-8">
                @foreach($restaurant as $single_restaurant)
                    <div class="card-image">
                        <img class="img-fluid" src="{{ $single_restaurant->photo }}" alt="{{ $single_restaurant->name }}">
                    </div>
                    <div class="card__title">{{ $single_restaurant->name }}</div>
                    <div class="card__subtitle">{{ $single_restaurant->address }}</div>
                    <div class="card__wrapper pb-4">
                        <button class="card__btn">
                            <a class="text-black onhover text-decoration-none" href="{{ route('admin.restaurant.create') }}">
                               Add New Dish
                            </a>
                        </button>
                        <button class="card__btn card__btn-solid">Details</button>
                    </div>
                </div>
                @endforeach
                <h1 class="text-center mt-4">
                    Your Dishes
                </h1>
                @foreach ($single_restaurant->dishes as $dish)
                    <p class="fw-semibold">{{ $dish->name }}</p>
                    <p>{{ $dish->description }}</p>
                    <p> <span class="fw-semibold">Ingredients:</span> {{ $dish->ingredients }}</p>
                    <p>{{ $dish->price }} €</p>
                    <button class="w-25 justify-self-start rounded">
                        <a class='text-decoration-none w-100' href="{{ route('admin.restaurant.edit', ['id' => $dish->id]) }}">
                            Modifica
                        </a>
                    <form class='delete-button' action="{{ route ('admin.restaurant.destroy', ['id' => $dish->id]) }}" method='POST'>
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="w-25 justify-self-start rounded">
                                Delete
                            </button>
                    </form>
                    </button>
                @endforeach
        </div>
</div>
@endsection
