@extends('layouts.main')
@section('content')
<span id="emilio">
    <div class="container">
        <div class="jumbo">
            <div class="restaurant">
                <h1>{{$restaurant->name}}</h1>
            </div>

        </div>
        <div class="main-menu">
            <div class="cart">
                <h2>Carrello</h2>
                <div v-for='plate in cart'>
                    <span class="plateName">@{{ plate.name }}</span>

                    <span class="platePrice"> @{{ plate.price*plate.counter }}</span>
                    <span class="plateCounter">@{{ plate.counter }}</span>
                </div>
                <h4>@{{ totalPrice }}</h4>

            </div>

            <section>
                <h1>I Nostri Piatti</h1>
                <plate-component
                    v-for="plate in plates"
                    :name="plate.name"
                    :id="plate.id"
                    :price="plate.price"
                    :key="plate.id">
                </plate-component>
            </section>
        </div>
    </div>
</span>
@endsection
<script>
    var id = {!! json_encode($restaurant->id) !!};
</script>
