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
    @method('PUT')

     <div class="row">

        <div class="col-xs-12 col-sm-12 col-md-12">

            <div class="form-group">

                <input type="text" name="name" class="form-control" placeholder="Nome" value="{{  old('name', $dish->name) }}">

                <textarea name="description" id="description" cols="30" rows="10" placeholder="descrizione">{{  old('description', $dish->description)}}</textarea>

                <input type="text" name="ingredients" class="form-control" placeholder="ingredienti" value="{{  old('ingredients', $dish->ingredients) }}">

                <label for="visible" class="ms-1">Visibile</label>
                <input type="checkbox" @if ($dish->visible)
                    checked
                @endif
                 id="visible" name="visible"  placeholder="visible">

                <input type="number" name="price" class="form-control" min="0" step="0.01" placeholder="price" value="{{  old('price', $dish->price) }}">

            </div>

        </div>

        <div class="col-xs-12 col-sm-12 col-md-12 text-center">

                <button type="submit" class="btn btn-primary mt-5">Submit</button>

        </div>

    </div>



</form>

@endsection
