<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;
use App\Restaurant;
use App\Plate;


class PlateController extends Controller
{

    private $plateValidation = [
        'name' => 'required|max:30',
        'description' => 'required',
        'price' => 'required|numeric',
        'photo' => 'image|max:5000',
        // 'required|file|size:5000',
    ];
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function showPlates($id) {
        $newId = intval($id);

        $restaurant = Restaurant::where('user_id', Auth::id())
        ->where('id', $newId)->get();

        $plates = Plate::where('restaurant_id', $newId)->get();

        return view("admin.plates.showPlates", compact("plates", 'restaurant'));
    }


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Restaurant $restaurant)
    {

        // $id = User::where('email', $email)->first()->id;

        return view("admin.plates.create", compact("restaurant"));
    }

    public function createPlate(Restaurant $restaurant , $id)
    {

        $id = intval($id);


        // $id = User::where('email', $email)->first()->id;

        return view('admin.plates.createPlate', compact('id', 'restaurant'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate($this->plateValidation);


        $data = $request->all();

        //return a model
        $restaurant = Restaurant::where('id', $data['id'])->first();
        $newPlate = new Plate();

        // GESTIONE FOTO
        if (!empty($data['photo'])) {
            $data['photo'] = Storage::disk('public')->put('img', $data['photo']);
        }

        $newPlate['restaurant_id'] = $data['id'];

        $newPlate->fill($data);
        $newPlate->save();


        return redirect()
            ->route('admin.restaurants.show', compact('restaurant'))
            ->with('message', 'Il piatto ' . $newPlate->name . ' è stato creato con successo');

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
    public function edit(Plate $plate)
    {
        return view('admin.plates.edit', compact('plate'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Plate $plate)
    {
        $request->validate($this->plateValidation);
        $data = $request->all();
        // dd($data);

         // GESTIONE FOTO
         if (!empty($data['photo'])) {
            $data['photo'] = Storage::disk('public')->put('img', $data['photo']);
        }

        $plate->fill($data);
        $restaurant = $plate->restaurant;
        $plate->update();

        return redirect()
            ->route('admin.restaurants.show', compact('restaurant'))
            ->with('message', 'Il piatto ' . $plate->name . ' è stato modificato con successo');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Plate $plate)
    {
        $restaurant = $plate->restaurant;
        $plate->delete();
        return redirect()
            ->route('admin.restaurants.show', compact('restaurant'))
            ->with('message', 'Il piatto ' . $plate->name . ' è stato eliminato con successo');
    }
}
