<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Branch;
use App\Models\Vehicle;
use App\Models\Customer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $countUsers = User::count();
        $countBranches = Branch::count();
        $countVehicles = Vehicle::count();
        $countCustomers = Customer::count();
        return view('dashboard', compact('countUsers', 'countBranches', 'countVehicles', 'countCustomers'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'last_name' => 'required',
            'username' => 'required|unique:users',
            'password' => 'required|confirmed',
        ]);

        $user = new User([
            'name' => $request->input('name'),
            'last_name' => $request->input('last_name'),
            'username' => $request->input('username'),
            'password' => Hash::make($request->input('password')),
        ]);

        $user->save();

        return redirect()->route('admin')->with('success', 'Usuario administrador creado exitosamente');
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

    public function authenticate(Request $request)
    {
        $request->validate([
            'username' => 'required',
            'password' => 'required',
        ]);

        $user = User::where('username', $request->input('username'))->first();

        if (!$user || !Hash::check($request->input('password'), $user->password)) {
            return redirect()->route('home')->with('error', 'Usuario o contraseña incorrectos');
        }

        // $request->session()->put('user', $user);
        auth()->login($user);

        return redirect()->route('admin');
    }

    public function login(Request $request)
    {
        $request->validate([
            'username' => 'required',
            'password' => 'required',
        ]);

        // $user = User::where('username', $request->input('username'))->first();
        // if (!$user || !Hash::check($request->input('password'), $user->password)) {
        //     return redirect()->route('login')->with('error', 'Usuario o contraseña incorrectos');
        // }

        $credentials = $request->only('username', 'password');
        if (!auth()->attempt($credentials)) {
            return redirect()->route('login')->with('error', 'Usuario o contraseña incorrectos');
        }

        return redirect()->route('dashboard');
    }

    public function logout(Request $request)
    {
        // $request->session()->forget('user');
        auth()->logout();
        return redirect()->route('home');
    }
}
