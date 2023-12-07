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
        </div>



    <!-- Dashboard -->

        <div class="dashboard pt-5 col-12 col-md-10 col-lg-10 text-white">
            <!-- Main content area for the dashboard -->
            <h1 class="text-black">Dashboard</h1>
            <div class="row">

                <div class="col-md-9 mb-4">
                    <!-- GRAFICO -->
                    <canvas id="myChart" class="bg-transparent rounded mb-3 p-4" height="160">
                                        
                   </canvas>

                   <div class="col-md-3">
                    <!-- Pulsanti di selezione -->
                    <div class="btn-group">
                        <button class="btn btn-primary me-3" onclick="changeChart('orders')">Ordini</button>
                        <button class="btn btn-primary" onclick="changeChart('sales')">Vendite</button>
                    </div>
                </div>

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

  let myChart = null

  // Dati predefiniti per ordini
  const ordersData = [
    { x: 'Gennaio'},
    { x: 'Febbraio'},
    { x: 'Marzo'},
    { x: 'Aprile'},
    { x: 'Maggio'},
    { x: 'Giugno'},
    { x: 'Luglio'},
    { x: 'Agosto'},
    { x: 'Settembre'},
    { x: 'Ottobre'},
    { x: 'Novembre'},
    { x: 'Dicembre'}
  ];

  // Dati predefiniti per vendite
  const salesData = [
    { x: 'Gennaio'},
    { x: 'Febbraio'},
    { x: 'Marzo'},
    { x: 'Aprile'},
    { x: 'Maggio'},
    { x: 'Giugno'},
    { x: 'Luglio'},
    { x: 'Agosto'},
    { x: 'Settembre'},
    { x: 'Ottobre'},
    { x: 'Novembre'},
    { x: 'Dicembre'}
  ];

  // Funzione per cambiare il grafico tra ordini e vendite
  function changeChart(chartType) {

    if (myChart !== null) {
    myChart.destroy();
    }

    myChart = new Chart(ctx, {
      type: 'bar',
      data: {
        datasets: [{
          label: chartType === 'orders' ? 'Ordini' : 'Vendite',
          data: chartType === 'orders' ? ordersData : salesData,
          backgroundColor: ['rgb(0, 0, 255)', 'rgb(112, 0, 11,0.4)', 'rgb(112, 0, 11,0.6)', 'rgb(112, 0, 11,0.7)', 'rgb(112, 0, 11,0.9)'],
          borderColor: ['rgb(0, 0, 255)', 'rgb(112, 0, 11,0.4)', 'rgb(112, 0, 11,0.6)', 'rgb(112, 0, 11,0.7)', 'rgb(112, 0, 11,0.9)'],
          borderWidth: 2,
        }]
      },
      options: {
        scales:{
            y:{
                min:2013,
                max:2023
            },
        },
        type:"time",
        time:{
            unit: 'year', // Specifica l'unità temporale (anno)
            displayFormats: {
            year: 'YYYY' // Formato di visualizzazione dell'anno
          }
        }
      }
    });
  }

  changeChart('orders');
  changeChart('sales');

</script>
@endsection