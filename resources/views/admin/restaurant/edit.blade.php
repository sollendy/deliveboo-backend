@extends('layouts.app')

  

@section('content')   

@if ($errors->any())

    <div class="alert alert-danger">

        <strong>Whoops!</strong> There were some problems with your input.<br><br>

        <ul>

            @foreach ($errors->all() as $error)

                <li>{{ $error }}</li>

            @endforeach

        </ul>

    </div>

@endif

   

<form action="{{ route('admin.restaurant.update', $dish->id) }}" method="POST">

    @csrf
    @method('PATCH')

     <div class="row">

        <div class="col-xs-12 col-sm-12 col-md-12">

            <div class="form-group">

                <input type="number" name="dish_id" class="form-control" placeholder="ID pietanza" value="{{  old('dish_id', $dish->id) }}">

                <input type="text" name="name" class="form-control" placeholder="Nome" value="{{  old('name', $dish->name) }}">

                <textarea name="description" id="description" cols="30" rows="10" placeholder="descrizione">{{  old('description', $dish->description)}}</textarea>

                <input type="text" name="ingredients" class="form-control" placeholder="ingredienti" value="{{  old('ingredients', $dish->ingredients) }}">

                <input type="text" name="visible" class="form-control" placeholder="visibile" value="">

                <input type="number" name="price" class="form-control" placeholder="prezzo" value="{{  old('price', $dish->price) }}">

            </div>

        </div>

        <div class="col-xs-12 col-sm-12 col-md-12 text-center">

                <button type="submit" class="btn btn-primary mt-5">Submit</button>

        </div>

    </div>

   

</form>

@endsection