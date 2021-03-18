@extends('layouts.main')
@section('content')
<div class="jumbo">
    <div class="restaurant">
        <h1>Nome ristorante</h1>
    </div>

</div>
<div class="main-menu">
    <div class="cart">
        <h2>Carrello</h2>
        <div v-for='plate in cart'>
            <span>@{{ plate.name }}</span>
            <span> @{{ plate.price*plate.counter }}</span>
            <span>@{{ plate.counter }}</span>
        </div>
        <h4>@{{ totalPrice }}</h4>

    </div>

    <section>
        <h1>I piatti</h1>
        <plate-component
            v-for="plate in plates"
            :name="plate.name"
            :id="plate.id"
            :price="plate.price"
            :key="plate.id">
        </plate-component>
    </section>
</div>

@endsection
<script>
    var id = {!! json_encode($restaurant->id) !!};
</script>
