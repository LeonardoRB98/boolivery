<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\DB;
use App\Restaurant;
use App\Category;
use App\Plate;
use App\Order;

class RestaurantController extends Controller
{

    private $restaurantValidation = [
        'name' => 'required|max:30',
        'email' => 'required|max:50',
        'address' => 'required|max:50',
        'phone' => 'required|min:6|max:15',
        'description' => 'required',
        'p_iva' => 'required|digits:11',
        'photo' => 'image',
        'photo_jumbo' => 'image'

    ] ;
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $restaurants = Restaurant::where('user_id', Auth::id())->get();

        return view('admin.restaurants.index', compact('restaurants'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = Category::all();

        return view('admin.restaurants.create', compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {


        $request->validate($this->restaurantValidation);

        $data = $request->all();


        $newRestaurant = new Restaurant();

        $data['user_id'] = Auth::id();
        $data["slug"] = Str::slug($data["name"]);



        if($data['sponsored'] == 'true') {
            $data['sponsored'] = true;
        } else {
            $data['sponsored'] = false;
        };


        // GESTIONE FOTO
        if(!empty($data['photo'])) {
            $data['photo'] = Storage::disk('public')->put('img', $data['photo']);
        }


        if(!empty($data['photo_jumbo'])) {
            $data['photo_jumbo'] = Storage::disk('public')->put('img', $data['photo_jumbo']);
        }

        $newRestaurant->fill($data);
        $newRestaurant->save();


        if(!empty($data['categories'])) {
            $newRestaurant->categories()->attach($data["categories"]);
        }


        return redirect()
               ->route('admin.restaurants.index')
               ->with('message' , 'Il ristorante ' . $newRestaurant->name . ' è stato creato con successo');

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Restaurant $restaurant)
    {
        $plates = Plate::where('restaurant_id', $restaurant->id)->get();

        // prendo la tabella order_plate,
        $orders = DB::table('order_plate')
        // aggiungo i piatti con id == order_plate.plate_id
        ->join('plates', 'order_plate.plate_id' ,'=', 'plates.id')
        // recupero i piatti che hanno l'id del ristorante
        ->where('restaurant_id', $restaurant->id)->get();
        // dd($orders);

        //best option
        // $graphicsOrder = [ '', '', '', '', '', '', '', '', '', '', '', '',];
        $graphicsOrder = array_fill(0, 11, 0);

        // $graphicsOrder[5] =   'mario';
        // $graphicsOrder[] =   'giovbann';
        // array_splice($graphicsOrder, 0, 0, '$inserted' );
        // dd($graphicsOrder);

        foreach($orders as $order) {
            $orderWithDate = Order::where('id', $order->order_id)->first();
            $currentDate = new \DateTime($orderWithDate->date);
            $currentMonth = intval(date_format($currentDate, "m"));
            // dd($currentMonth);
            $graphicsOrder[$currentMonth - 1] += $order->price * $order->quantity;

        }

        
        //  dd($graphicsOrder);
        // dd($orders);

        return view('admin.restaurants.show', compact('restaurant', 'plates', 'orders' , 'graphicsOrder'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Restaurant $restaurant)
    {
        $categories = Category::all();
        return view('admin.restaurants.edit', compact('restaurant', 'categories'));

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Restaurant $restaurant)
    {
        $request->validate($this->restaurantValidation);
        $data = $request->all();
        $data["slug"] = Str::slug($data["name"]);

        if($data['sponsored'] == 'true') {
            $data['sponsored'] = true;
        } else {
            $data['sponsored'] = false;
        }



        if(!empty($data["photo"])) {
            // verifico se è presente un'immagine precedente, se si devo cancellarla
            $data['photo'] = Storage::disk('public')->put('img', $data['photo']);
            if(!empty($restaurant->photo)) {
                Storage::disk('public')->delete($restaurant->photo);

            }
        }
            if(!empty($data["photo_jumbo"])) {
                // verifico se è presente un'immagine precedente, se si devo cancellarla
                $data['photo_jumbo'] = Storage::disk('public')->put('img', $data['photo_jumbo']);
                if(!empty($restaurant->photo_jumbo)) {
                    Storage::disk('public')->delete($restaurant->photo_jumbo);
                }
            }

        if(empty($data['categories'])) {
            $restaurant->categories()->detach();
        } else {
            $restaurant->categories()->sync($data["categories"]);
        }

        $restaurant->update($data);

        return redirect()->route('admin.restaurants.index')->with('message', 'il ristorante ' . $restaurant->name . ' è stato modificato correttamente.' );



    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Restaurant $restaurant)
    {
        $restaurant->delete();
        return redirect()->route('admin.restaurants.index')->with('message', 'il ristorante ' . $restaurant->name . ' è stato eliminato correttamente.' );
    }
}
