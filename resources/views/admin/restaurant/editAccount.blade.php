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

                    <h1 class="text-center text-white py-3">Aggiorna il tuo Profilo</h1>

                    @foreach($restaurants as $restaurant)
                    <form action="{{ route('admin.restaurant.update', $restaurant->id) }}" method="POST">
                        @csrf
                        @method('PUT')

                        <div class="row">
                            <div class="col-xs-12 col-sm-12 col-md-12">
                                <div class="form-group">
                                    <input type="text" name="name" class="form-control mb-4" placeholder="Nome" value="{{ old('name', $restaurant->name) }}" required minlength="5" maxlength="100">
                                    <input type="text" name="address" class="mb-4 w-100" id="description" cols="30" rows="10" placeholder="Descrizione" value="{{ old('address', $restaurant->address) }}">
                                    <input type="text" name="piva" class="form-control mb-4" placeholder="Partita IVA" value="{{ old('piva', $restaurant->piva) }}" required minlength="20">
                                    <input id="photo" type="file" class="form-control @error('photo') is-invalid @enderror mb-4" name="photo" value="{{ old('photo', $restaurant->photo) }}" required autocomplete="photo" autofocus placeholder="">


                        <div class="col-xs-12 col-sm-12 col-md-12">
                                <div class="form-group">
                                    <select @error('types') is-invalid @enderror name="types[]" multiple multiselect-search="true" id="types">
                                    @foreach($list_types as $type)
                                    <option value="{{$type->id}}"    @foreach($restaurants[0]->types()->get() as $type_check)
                                           @if($type_check->id === $type->id) selected @endif 
                                        @endforeach>
                                        {{$type->name}}
                                    </option>
                                    @endforeach
                                  </select>
                                </div>
                        </div>


                                    @endforeach
                                </div>
                            </div>

                            <div class="col-xs-12 col-sm-12 col-md-12 text-center">
                                <button type="submit" class="card__btn mt-5">Applica Modifiche</button>
                            </div>
                        </div>
                    </form>

                </div>
            </div>
        </div>
    </div>


    @vite(['resources/js/multi-select.js'])

@endsection
