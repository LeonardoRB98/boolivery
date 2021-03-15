@extends('layouts.guests.main')

@section('content')
<div class="jumbo">
    <div class="restaurant">
        <h1>Nome ristorante</h1>
    </div>

</div>
<div class="main-menu">
    <section>
        <div class="card">
            <div class="card-body">
              This is some text within a card body.
            </div>
          </div>
          <div class="card">
            <div class="card-body">
              This is some text within a card body.
            </div>
          </div>
          <div class="card">
            <div class="card-body">
              This is some text within a card body.
            </div>
          </div>
    </section>
    <div class="chart">
        <h1>Carrello</h1>
        <h2>pasta <input type="number" id="tentacles" name="tentacles" min="0" max="100"></h2>
    </div>
</div>

@endsection
