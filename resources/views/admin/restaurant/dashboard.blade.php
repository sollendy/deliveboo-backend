@extends('layouts.app')

@section('content')

<div class="container-fluid dashboard-container">
    <div class="row">

    <!-- Sidebar -->

        <div class="side-bar d-none d-md-block col-md-2 col-lg-2 bg-primary text-white">
            <h5 class="pt-5">Gestore Ristorante {{Auth::user()->name}}</h5>
            @foreach($restaurant as $single_restaurant)
            <img class="owner-image" src="{{ $single_restaurant->photo }}" alt="">
            <p>
                Nome Ristorante: {{ $single_restaurant->name }}
            </p>
            <p>
                Cucina: {{ $single_restaurant->name }}
            </p>
            <p>
                Indrizzo: {{ $single_restaurant->address }}
            </p>
            @endforeach
            <button class="card__btn">
                <a class='text-decoration-none text-black onhover' href="#">
                    Modifica
                </a>
            </button>
        </div>



    <!-- Dashboard -->

        <div class="dashboard pt-5 col-12 col-md-10 col-lg-10 bg-secondary text-white">
            <!-- Main content area for the dashboard -->
            <h1>Dashboard</h1>
            <div class="row">

                <div class="col-md-9">
                    <!-- GRAFICO -->
                    <canvas id="myChart" height="170">
                                        
                   </canvas>
                </div>

                <div class="col-md-3 bg-black">
                    <!-- Ordini Cliente -->
                    <div class="card text-white bg-dark my-3">
                        <div class="card-header">Ordini Cliente</div>
                        <div class="card-body">
                            <p class="card-text">Ordine #1 - Dettagli</p>
                            <p class="card-text">Ordine #2 - Dettagli</p>
                        </div>
                    </div>
                </div>

            </div>
        </div>
        <footer class="footer-dashboard mt-auto py-3 bg-dark text-white">
            <div class="container text-center">
                <img class="logo-footer mt-3" src="{{ asset('img/logo_deliveboo-03.png') }}" alt="logo-deliveboo">
                <p>&copy; 2023 Deliveboo</p>
            </div>
        </footer>
    </div>
</div>



<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<script>
  const ctx = document.getElementById('myChart');


  new Chart(ctx, {
    type: 'bar',
    data: {
      labels: ['1 star','2 stars','3 stars','4 stars','5 stars'],
      datasets: [{
        label: 'Feedback From Customers',
        data: [{{"1"}}, {{ "2"}}, {{"3"}}, {{"4"}},{{"5"}}],
        backgroundColor: ['rgb(112, 0, 11,0.3)', 'rgb(112, 0, 11,0.4)', 'rgb(112, 0, 11,0.6)', 'rgb(112, 0, 11,0.7)','rgb(112, 0, 11,0.9)'],
        borderColor:['rgb(112, 0, 11,0.3)', 'rgb(112, 0, 11,0.4)', 'rgb(112, 0, 11,0.6)', 'rgb(112, 0, 11,0.7)','rgb(112, 0, 11,0.9)'],
        borderWidth: 2,
      }]
    },
    options: {
      scales: {
        y: {
          title:{
            display: true,
            text: 'Range',
            color:'white'
          },
          min: 0,
          max: 10,
          grid: {
                color: 'rgba(0, 0, 0, 0.2)' // Cambia il colore della griglia
            },
            ticks: {
                color: 'white',
            }
        },
        x:{
            ticks: {
                color: 'white',
            }
        }
      },
      plugins:{
        legend:{
            labels:{
                color:'white',
            }
        }
      },
      responsive:true,
      maintainAspectRatio: true,
    }
  });
</script>
@endsection