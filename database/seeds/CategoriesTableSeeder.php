<?php

use Illuminate\Database\Seeder;
use App\Category;

class CategoriesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $categories = [
            'Italiano',
            'Internazionale' ,
            'Cinese',
            'Giapponese',
            'Vegano',
            'Indiano',
            'Messicano',
            'Pizza',
            'Carne',
            'Pesce'
        ];

        foreach ($categories as $cat) {
            
            $newCat = New Category();
            $newCat->category = $cat;

            $newCat->save();
        }
    }
}
