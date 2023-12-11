@extends('layouts.app')

@section('content')

<div class="image-wrapper create-container">
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

                <form action="{{ route('admin.restaurant.store') }}" enctype="multipart/form-data" method="POST">
                    @csrf

                    <div class="row">
                        <div class="col-xs-12 col-sm-12 col-md-12 bg-form rounded my-5 py-3 px-4 px-md-5">
                            <div class="d-flex justify-content-center py-3">
                                <img class="img-fluid logo-size-form" src="{{ asset('img/logo_deliveboo-03.png') }}" >
                            </div>

                            <h1 class="text-center text-white py-3">Crea il tuo Piatto!</h1>

                            <div class="form-group">
                                <input type="text" name="name" class="form-control mb-4" placeholder="Nome Piatto" required minlength="5" maxlength="100">
                                <textarea name="description" id="description" class="mb-4 w-100" cols="30" rows="10" minlength="10" placeholder="Descrizione"></textarea>
                                <input type="text" name="ingredients" class="form-control mb-4" placeholder="Ingredienti" required minlength="10">
                                <label for="image" class="text-white fs-4">Immagine</label>
                                <input id="image" type="file" class="form-control mb-2 @error('image') is-invalid @enderror" name="image" value="{{ old('image') }}"  autocomplete="image" autofocus>

                                @error('image')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                                <label for="visible" class="ms-1 mb-4 text-white">Visibilita'</label>
                                <input type="checkbox" id="visible" name="visible" placeholder="Visibilita'">
                                <input type="number" name="price" class="form-control" min="0" value="0.00" step="0.01" placeholder="Prezzo" required>
                            </div>

                            <div class="col-xs-12 col-sm-12 col-md-12 text-center">
                                <button type="submit" class="mt-5 card__btn">Crea Piatto</button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>



@endsection
