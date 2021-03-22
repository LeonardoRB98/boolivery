@extends('layouts.main')

@section('content')
    <div class="curved-top">
        <div class="img-container">
            @if (!is_null($restaurant->photo_jumbo))
                <img src="{{ asset('storage/' . $restaurant->photo_jumbo) }}" alt="{{ $restaurant->name }}">
            @else
                <img src="{{ asset('image/download.png') }}" alt="{{ $restaurant->name }}">
            @endif
            <div class="img-layover"></div>
        </div>

        <svg class="img-layer img-layer-bottom" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1440 310">
            <path fill="#ED4521" fill-opacity="1"
                d="M0,160L48,181.3C96,203,192,245,288,266.7C384,288,480,288,576,288C672,288,768,288,864,240C960,192,1056,96,1152,48C1248,0,1344,0,1392,0L1440,0L1440,320L1392,320C1344,320,1248,320,1152,320C1056,320,960,320,864,320C768,320,672,320,576,320C480,320,384,320,288,320C192,320,96,320,48,320L0,320Z">
            </path>
        </svg>
        {{-- <svg class="img-layer img-layer-bottom" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1440 316">
                <path fill="#131E52" fill-opacity="1"
                    d="M0,256L48,218.7C96,181,192,107,288,117.3C384,128,480,224,576,261.3C672,299,768,277,864,261.3C960,245,1056,235,1152,213.3C1248,192,1344,160,1392,144L1440,128L1440,320L1392,320C1344,320,1248,320,1152,320C1056,320,960,320,864,320C768,320,672,320,576,320C480,320,384,320,288,320C192,320,96,320,48,320L0,320Z">
                </path>
            </svg> --}}
        <svg class="img-layer img-layer-bottom" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1440 316">
            <path fill="#131E52" fill-opacity="1"
                d="M0,224L80,213.3C160,203,320,181,480,186.7C640,192,800,224,960,213.3C1120,203,1280,149,1360,122.7L1440,96L1440,320L1360,320C1280,320,1120,320,960,320C800,320,640,320,480,320C320,320,160,320,80,320L0,320Z">
            </path>
        </svg>
        <h2 class="title-layer">{{ $restaurant->name }}</h2>

    </div>
    <div class="curved-bottom">
        {{-- <svg class="img-layer" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1440 319">
                <path fill="white" fill-opacity="1"
                    d="M0,256L48,218.7C96,181,192,107,288,69.3C384,32,480,32,576,37.3C672,43,768,53,864,69.3C960,85,1056,107,1152,101.3C1248,96,1344,64,1392,48L1440,32L1440,320L1392,320C1344,320,1248,320,1152,320C1056,320,960,320,864,320C768,320,672,320,576,320C480,320,384,320,288,320C192,320,96,320,48,320L0,320Z">
                </path>
            </svg> --}}

    </div>
    <div class="main-content">
        @if (session('message'))
            <div class="alert alert-success">
                {{ session('message') }}
            </div>
        @endif
        <div class="container">
            <div class="row">
                <div class="col-md-4">
                    <div class="wrapper">
                        <div class="d-flex justify-content-between align-items-center">
                            <h2>Le tue info</h2>
                            <a href="{{ route('admin.restaurants.edit', $restaurant) }}">
                                <i class="fas fa-edit"></i>
                            </a>
                        </div>

                        <div class="info">
                            <i class="fas fa-phone"></i>
                            <span>{{ $restaurant->phone }}</span>
                        </div>
                        <div class="info">
                            <i class="fas fa-at"></i>
                            <span>{{ $restaurant->address }}</span>
                        </div>
                        <div class="info">
                            <i class="fas fa-map-marked-alt"></i>
                            <span>{{ $restaurant->email }}</span>
                        </div>
                        <div class="info">
                            <i class="fas fa-briefcase"></i>
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
                    <div class="d-flex justify-content-between align-items-center">
                        <h2>I tuoi piatti</h2>
                        <a href="{{ route('admin.plates.createPlate', ['restaurant_id' => $restaurant->id]) }}">
                            <span>
                                Aggiungi piatto
                                <i class="fas fa-plus-square"></i>
                            </span>

                        </a>
                    </div>



                </div>

            </div>
            <div class="clearfix mb-4">
                <a href="{{ route('admin.restaurants.index') }}" class="btn btn-primary float-right">Elenco
                    Ristoranti</a>
            </div>



        </div>

    </div>




    {{-- <table class="table table-striped table-bordered">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Nome</th>
                        <th>Foto</th>
                        <th>Prezzo</th>
                        <th>Descrizione</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($plates as $plate)
                        <tr>
                            <td> {{ $plate->id }}</td>
                            <td> <a href="#">{{ $plate->name }}</a> </td>
                            @if (!is_null($plate->photo))
                                <td>
                                    <img style="width: 200px" class="img-fluid"
                                        src="{{ asset('storage/' . $plate->photo) }}" alt="{{ $plate->name }}">
                                </td>
                            @else
                                <td>
                                    <img style="width: 200px" class="img-fluid" src="{{ asset('image/download.png') }}"
                                        alt="{{ $plate->name }}">
                                </td>
                            @endif
                            <td>{{ $plate->price }}</td>
                            <td>{{ $plate->description }}</td>


                            <td>
                                <a href="{{ route('admin.plates.edit', $plate) }}">Modifica</a>
                            </td>
                            <td>
                                <form action="{{ route('admin.plates.destroy', $plate) }}" method="POST">
                                    @csrf
                                    @method('DELETE')
                                    <input type="submit" value="Elimina">
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table> --}}
    {{-- </div>
    </div> --}}

@endsection
