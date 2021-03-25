<?php

use Illuminate\Database\Seeder;
use App\Restaurant;

class RestaurantsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // PRENDO IL FILE CON IL DB
        $data = config('restaurantsSEED');

        foreach ($data as $restaurant) {

            $newRestaurant = new Restaurant();
            $newRestaurant->fill($restaurant);
            $newRestaurant->save();
        }
    }
}
