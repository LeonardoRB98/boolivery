@extends('layouts.main')

@section('content')
    <div class="curved-top">
        <div class="img-container">
            @if (!is_null($restaurant->photo_jumbo))
                <img src="{{ asset('storage/' . $restaurant->photo_jumbo) }}" alt="{{ $restaurant->name }}">
            @else
                <img src="{{ asset('image/restaurant-placeholder.jpg') }}" alt="{{ $restaurant->name }}">
            @endif
            <div class="img-layover"></div>
        </div>
        <svg class="img-layer img-layer-bottom" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1440 310">
            <path fill="#ED4521" fill-opacity="1"
                d="M0,160L48,181.3C96,203,192,245,288,266.7C384,288,480,288,576,288C672,288,768,288,864,240C960,192,1056,96,1152,48C1248,0,1344,0,1392,0L1440,0L1440,320L1392,320C1344,320,1248,320,1152,320C1056,320,960,320,864,320C768,320,672,320,576,320C480,320,384,320,288,320C192,320,96,320,48,320L0,320Z">
            </path>
        </svg>
        <svg class="img-layer img-layer-bottom" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1440 316">
            <path fill="#131E52" fill-opacity="1"
                d="M0,224L80,213.3C160,203,320,181,480,186.7C640,192,800,224,960,213.3C1120,203,1280,149,1360,122.7L1440,96L1440,320L1360,320C1280,320,1120,320,960,320C800,320,640,320,480,320C320,320,160,320,80,320L0,320Z">
            </path>
        </svg>
        <h2 class="title-layer">{{ $restaurant->name }}</h2>
    </div>
    <div class="main-content">

        <div class="container">
            @if (session('message'))
                <div class="alert alert-success">
                    {{ session('message') }}
                </div>
            @endif
            <div class="button-box">
                <h1>{{ $restaurant->name }}</h1>
                <a class="blue-button" href="{{ route('admin.restaurants.index') }}">I tuoi Ristoranti</a>
            </div>
            <div class="row">
                <div class="col-md-4">
                    <div class="info-box">
                        <div class="info-box__title">
                            <h2>Le tue info</h2>
                            <a class="icon-blue" href="{{ route('admin.restaurants.edit', $restaurant) }}">
                                <i class="fas fa-edit"></i>
                            </a>
                        </div>
                        <div class="info">
                            <i class="fas fa-phone-alt icon-blue"></i>
                            <span>{{ $restaurant->phone }}</span>
                        </div>
                        <div class="info">
                            <i class="fas fa-map-marked-alt icon-blue"></i>
                            <span>{{ $restaurant->address }}</span>
                        </div>
                        <div class="info">
                            <i class="fas fa-at icon-blue"></i>
                            <span>{{ $restaurant->email }}</span>
                        </div>
                        <div class="info">
                            <i class="fas fa-briefcase icon-blue"></i>
                            <span>{{ $restaurant->p_iva }}</span>
                        </div>
                        <div class="info">
                            <h5>Descrizione</h5>
                            <span>{{ $restaurant->description }}</span>
                        </div>
                        <div class="info">
                            <h5>Sponsorizzato</h5>
                            <span>{{ $restaurant->sponsored ? 'Si' : 'No' }}</span>
                        </div>
                        <div class="info">
                            <h5>Categorie</h5>
                            @foreach ($restaurant->categories as $category)
                                <span class="tag">{{ $category->category }}</span>
                            @endforeach
                        </div>

                    </div>
                </div>
                <div class="col-md-8">
                    @if (!count($plates))
                        <div class="info-box__title">
                            <div class="fail">
                                <h2>Non hai ancora inserito nessun piatto</h2>
                                <a class="blue-btn" href="{{ route('admin.plates.createPlate', ['restaurant_id' => $restaurant->id]) }}" class="btn btn-primary">Aggiungi Piatto</a>
                            </div>
                        </div>
                    @else
                        <div class="info-box__title">
                            <h2>I tuoi piatti</h2>
                            <a class="icon-blue"
                                href="{{ route('admin.plates.createPlate', ['restaurant_id' => $restaurant->id]) }}">
                                <i class="fas fa-plus-square"></i>
                            </a>
                        </div>
                        <div class="plates-box">
                            <div class="row">
                                @foreach ($plates as $plate)
                                    <div class="col-md-6 col-lg-4">
                                        <div class="card">
                                            <div class="image-box">
                                                @if (!is_null($plate->photo))
                                                    <img class="img-fluid" src="{{ asset('storage/' . $plate->photo) }}"
                                                        alt="{{ $plate->name }}">
                                                @else
                                                    <img src="{{ asset('image/plate-placeholder.jpeg') }}" alt="{{ $plate->name }}">
                                                @endif
                                            </div>
                                            <div class="card-content">
                                                <div>
                                                    <h4>{{ $plate->name }}</h4>
                                                    <p class="desc">{{ $plate->description }}</p>
                                                </div>
                                                <div class="d-flex justify-content-between align-items-center">
                                                    <div class="card-bottom">
                                                        <a href="{{ route('admin.plates.edit', $plate) }}"><i
                                                            class="fas fa-edit"></i>
                                                        </a>
                                                        <form action="{{ route('admin.plates.destroy', $plate) }}" method="POST">
                                                            @csrf
                                                            @method('DELETE')
                                                            <button type="submit" value="Elimina"
                                                                onclick='return confirm("Sei sicuro di voler cancellare l&apos;elemento?")'>
                                                                <i class="fas fa-trash-alt"></i>
                                                            </button>
                                                        </form>
                                                    </div>
                                                    <div class="price">
                                                        {{ number_format($plate->price, 2) }}€
                                                    </div>

                                                </div>
                                            </div>
                                        </div>

                                    </div>
                                @endforeach
                            </div>
                        </div>
                    @endif
                </div>
            </div>
            {{-- analythics --}}
            <h2 class="mt-5">I tuoi ordini</h2>
            <div id="analythics">
                <canvas id="myChart" width="90%" height="50%"></canvas>
            </div>
            {{-- /analythics --}}
        </div>
    </div>

@endsection
@section('chart')
    <script>
        var orderArray = @json($graphicsOrder);
        var ctx = document.getElementById('myChart').getContext('2d');
        var myChart = new Chart(ctx, {
            type: 'bar',
            data: {
                labels: ['Gennaio', 'Febbraio', 'Marzo', 'Aprile', 'Maggio', 'Giugno', 'Luglio', 'Agosto',
                    'Settembre', 'Ottobre', 'Novembre', 'Dicembre'
                ],
                datasets: [{
                    label: 'I tuoi incassi mensili',
                    data: orderArray,
                    backgroundColor: [
                        'rgba(255, 99, 132, 0.2)',
                        'rgba(54, 162, 235, 0.2)',
                        'rgba(255, 206, 86, 0.2)',
                        'rgba(75, 192, 192, 0.2)',
                        'rgba(153, 102, 255, 0.2)',
                        'rgba(255, 159, 64, 0.2)'
                    ],
                    borderColor: [
                        'rgba(255, 99, 132, 1)',
                        'rgba(54, 162, 235, 1)',
                        'rgba(255, 206, 86, 1)',
                        'rgba(75, 192, 192, 1)',
                        'rgba(153, 102, 255, 1)',
                        'rgba(255, 159, 64, 1)'
                    ],
                    borderWidth: 1
                }]
            },
            options: {
                scales: {
                    yAxes: [{
                        ticks: {
                            beginAtZero: true
                        }
                    }]
                }
            }
        });

    </script>
@endsection
