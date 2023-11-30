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

   

<form action="{{ route('admin.restaurant.store') }}" method="POST">

    @csrf
  

     <div class="row">

        <div class="col-xs-12 col-sm-12 col-md-12">

            <div class="form-group">

                <input type="number" name="restaurant_id" class="form-control" placeholder="restaurant_id">

                <input type="text" name="name" class="form-control" placeholder="Name">

                <textarea name="description" id="description" cols="30" rows="10" placeholder="description"></textarea>

                <input type="text" name="ingredients" class="form-control" placeholder="ingredients">

                <input type="text" name="visible" class="form-control" placeholder="visible">

                <input type="number" name="price" class="form-control" placeholder="price">

            </div>

        </div>

        <div class="col-xs-12 col-sm-12 col-md-12 text-center">

                <button type="submit" class="btn btn-primary mt-5">Submit</button>

        </div>

    </div>

   

</form>

@endsection