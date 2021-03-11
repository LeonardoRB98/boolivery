<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Restaurant;
use App\Plate;


class PlateController extends Controller
{

    private $plateValidation = [
        'name' => 'required',
        'description' => 'required',
        'price' => 'required|numeric',
        'photo' => 'image',
    ];
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function showPlates(Restaurant $restaurant) {

        $plates = Plate::where('restaurant_id', $restaurant->id)->get();

        // return view("admin.plates.showPlates", compact("plates", 'restaurant'));
    }
    // public function index(Restaurant $restaurant)
    // {
    //     $plates = Plate::where('restaurant_id', $restaurant->id)->get();
    //    return view("admin.plates.index", compact("plates", "restaurant"));
    // }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    // public function create(Restaurant $restaurant)
    // {

    //     // $id = User::where('email', $email)->first()->id;

    //     return view("admin.plates.create", compact("restaurant"));
    // }
    public function createPlate(Restaurant $restaurant)
    {

        // $id = User::where('email', $email)->first()->id;

        return view("admin.plates.create", compact("restaurant"));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, Restaurant $restaurant)
    {
        $request->validate($this->plateValidation);


        $data = $request->all();

        $newPlate = new Plate();

        // GESTIONE FOTO
        if (!empty($data['photo'])) {
            $data['photo'] = Storage::disk('public')->put('img', $data['photo']);
        }

        $newPlate['restaurant_id'] = $restaurant->id;

        $newPlate->fill($data);
        $newPlate->save();



        return redirect()
            ->route('admin.plates.index')
            ->with('message', 'Il piatto ' . $newPlate->name . 'è stato creato con successo');

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
