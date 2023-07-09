<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Branch;

class BranchController extends Controller
{
    // crud para branches
    public function index()
    {
        $branches = Branch::all();
        return view('branches.index', compact('branches'));
    }

    public function create()
    {
        return view('branches.create');
    }

    public function store(Request $request)
    {
        // dd($request->all());
        $request->validate([
            'name' => 'required|max:255',
            'address' => 'required|max:255',
            'phone' => 'required|numeric|digits:9',
            'email' => 'required|email',
            'manager' => 'required|max:255',
        ]);

        $branch = new Branch();
        $branch->name = $request->name;
        $branch->address = $request->address;
        $branch->phone = $request->phone;
        $branch->email = $request->email;
        $branch->manager = $request->manager;

        $branch->save();
        return redirect()->route('branches.index')->with('success', 'Sucursal Agregada');
    }

    public function show($id)
    {
        $branch = Branch::find($id);
        return view('branches.show', compact('branch'));
    }

    public function edit($id)
    {
        $branch = Branch::find($id);
        return view('branches.edit', compact('branch'));
    }

    public function update(Request $request, $id)
    {
        // dd($request->all());
        $request->validate([
            'name' => 'required|max:255',
            'address' => 'required|max:255',
            'phone' => 'required|numeric|digits:9',
            'email' => 'required|email',
            'manager' => 'required|max:255',
        ]);

        $branch = Branch::find($id);
        $branch->name = $request->name;
        $branch->address = $request->address;
        $branch->phone = $request->phone;
        $branch->email = $request->email;
        $branch->manager = $request->manager;

        $branch->save();
        return redirect()->route('branches.index')->with('success', 'Sucursal Actualizada');
    }

    public function destroy($id)
    {
        $branch = Branch::find($id);
        $branch->delete();
        return redirect()->route('branches.index')->with('success', 'Sucursal Eliminada');
    }

    public function search(Request $request)
    {
        $branches = Branch::where('name', 'like', '%' . $request->search . '%')->get();
        return view('branches.index', compact('branches'));
    }

}
