<?php

namespace App\Http\Controllers;
use App\Models\Customer;
use Illuminate\Http\Request;

class CustomerController extends Controller
{
    // crea crud para customers

    public function index()
    {
        $customers = Customer::all();
        return view('customers.index', compact('customers'));
    }

    public function create()
    {
        return view('customers.create');
    }

    public function store(Request $request)
    {
        // dd($request->all());
        $request->validate([
            'name' => 'required|max:255',
            'lastname' => 'required|max:255',
            'email' => 'required|email',
            'phone' => 'required|numeric|digits:9',
            'dni' => 'required|unique:customers|numeric|digits:8',
            'address' => 'required|max:255',
        ]);

        $customer = new Customer();
        $customer->name = $request->name;
        $customer->lastname = $request->lastname;
        $customer->email = $request->email;
        $customer->phone = $request->phone;
        $customer->dni = $request->dni;
        $customer->address = $request->address;

        $customer->save();
        return redirect()->route('customers.index')->with('success', 'Cliente Agregado');
    }

    public function show($id)
    {
        $customer = Customer::find($id);
        return view('customers.show', compact('customer'));
    }

    public function edit($id)
    {
        $customer = Customer::find($id);
        return view('customers.edit', compact('customer'));
    }

    public function update(Request $request, $id)
    {
        // dd($request->all());
        $request->validate([
            'name' => 'required|max:255',
            'lastname' => 'required|max:255',
            'email' => 'required|email',
            'phone' => 'required|numeric|digits:9',
            // 'dni' => 'required|numeric|unique:customers|eq:8',
            'address' => 'required|max:255',
        ]);

        $customer = Customer::find($id);
        // si dni es diferente al que ya existe en la bd, validar que sea unico
        if ($customer->dni != $request->dni) {
            $request->validate([
                'dni' => 'required|numeric|unique:customers|digits:8',
            ]);
        }
        $customer->name = $request->name;
        $customer->lastname = $request->lastname;
        $customer->email = $request->email;
        $customer->phone = $request->phone;
        $customer->dni = $request->dni;
        $customer->address = $request->address;
        $customer->save();
        return redirect()->route('customers.index')->with('success', 'Cliente actualizado');
    }

    public function destroy($id)
    {
        $customer = Customer::find($id);
        $customer->delete();
        return redirect()->route('customers.index')->with('success', 'Cliente eliminado');
    }

    public function search(Request $request)
    {
        $search = $request->get('search');
        $customers = Customer::where('name', 'like', '%' . $search . '%')->paginate(5);
        return view('customers.index', ['customers' => $customers]);
    }
}
