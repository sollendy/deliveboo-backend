@extends('layouts.app')

@section('content')

    <div class="edit-container">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-10 pt-4">
                    @if ($errors->any())
                        <div class="alert alert-danger">
                            <strong>Whoops!</strong> Qualcosa è andato storto.<br><br>
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    <div class="col-xs-12 col-sm-12 col-md-12 bg-form rounded my-5 py-3 px-4 px-md-5">
                            <div class="d-flex justify-content-center py-3">
                                <img class="img-fluid logo-size-form" src="{{ asset('img/logo_deliveboo-03.png') }}" >
                            </div>

                    <h1 class="text-center text-white py-3">Aggiorna il tuo Piatto !</h1>

                    <form action="{{ route('admin.restaurant.update', $dish->id) }}" method="POST">
                        @csrf
                        @method('PUT')

                        <div class="row">
                            <div class="col-xs-12 col-sm-12 col-md-12">
                                <div class="form-group">
                                    <input type="text" name="name" class="form-control mb-4" placeholder="Nome" value="{{ old('name', $dish->name) }}" required minlength="5" maxlength="100">
                                    <textarea name="description" class="mb-4 w-100" id="description" cols="30" rows="10" placeholder="Descrizione">{{ old('description', $dish->description) }}</textarea>
                                    <input type="text" name="ingredients" class="form-control mb-4" placeholder="Ingredienti" value="{{ old('ingredients', $dish->ingredients) }}" required minlength="20">
                                    <label for="visible" class="ms-1 text-white">Visibile</label>
                                    <input type="checkbox" @if ($dish->visible) checked @endif id="visible" name="visible" placeholder="visible">
                                    <input type="number" name="price" class="form-control mb-4" min="0" step="0.01" placeholder="Prezzo" value="{{ old('price', $dish->price) }}" required>
                                </div>
                            </div>

                            <div class="col-xs-12 col-sm-12 col-md-12 text-center">
                                <button type="submit" class="card__btn mt-5">Modifica Piatto</button>
                            </div>
                        </div>
                    </form>

                </div>
            </div>
        </div>
    </div>

@endsection
