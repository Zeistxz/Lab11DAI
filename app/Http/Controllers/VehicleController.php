<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Vehicle;
use App\Models\Customer;

class VehicleController extends Controller
{
    // crud con validaciones para vehiculos
    public function index()
    {
        $vehicles = Vehicle::all();
        $customers = Customer::all();
        return view('vehicles.index', compact('vehicles', 'customers'));
    }

    public function create()
    {
        return view('vehicles.create');
    }

    public function store(Request $request)
    {
        // dd($request->all());
        $request->validate([
            'brand' => 'required|max:255',
            'model' => 'required|max:255',
            'year' => 'required|numeric|digits:4',
            'color' => 'required|max:255',
            // 'price' => 'required|numeric',
            'description' => 'required|max:255',
            // 'image' => 'required|image',
            'plate' => 'required|max:10',
            'customer_id' => 'required|exists:customers,_id',
        ]);

        $vehicle = new Vehicle();
        $vehicle->brand = $request->brand;
        $vehicle->model = $request->model;
        $vehicle->year = $request->year;
        $vehicle->color = $request->color;
        // $vehicle->price = $request->price;
        $vehicle->description = $request->description;
        // $vehicle->image = $request->image->store('public/vehicles');
        $vehicle->plate = $request->plate;
        $vehicle->customer_id = $request->customer_id;
        

        $vehicle->save();
        return redirect()->route('vehicles.index')->with('success', 'Vehiculo Agregado');
    }

    public function show($id)
    {
        $vehicle = Vehicle::find($id);
        return view('vehicles.show', compact('vehicle'));
    }

    public function edit($id)
    {
        $vehicle = Vehicle::find($id);
        return view('vehicles.edit', compact('vehicle'));
    }
    
    public function update(Request $request, $id)
    {
        // dd($request->all());
        $request->validate([
            'brand' => 'required|max:255',
            'model' => 'required|max:255',
            'year' => 'required|numeric|digits:4',
            'color' => 'required|max:255',
            // 'price' => 'required|numeric',
            'description' => 'required|max:255',
            // 'image' => 'required|image',
            'plate' => 'required|max:10',
            'customer_id' => 'required|exists:customers,_id',
        ]);

        $vehicle = Vehicle::find($id);
        $vehicle->brand = $request->brand;
        $vehicle->model = $request->model;
        $vehicle->year = $request->year;
        $vehicle->color = $request->color;
        // $vehicle->price = $request->price;
        $vehicle->description = $request->description;
        // $vehicle->image = $request->image->store('public/vehicles');
        $vehicle->plate = $request->plate;
        $vehicle->customer_id = $request->customer_id;        

        $vehicle->save();
        return redirect()->route('vehicles.index')->with('success', 'Vehiculo Actualizado');
    }

    public function destroy($id)
    {
        $vehicle = Vehicle::find($id);
        $vehicle->delete();
        return redirect()->route('vehicles.index')->with('success', 'Vehiculo Eliminado');
    }
    
}
