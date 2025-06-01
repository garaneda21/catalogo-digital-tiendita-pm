<?php

namespace App\Http\Controllers;

use App\Models\Administrador;
use Illuminate\Http\Request;
use Illuminate\Validation\Rules;

class AdministradoresController extends Controller
{
    public function index()
    {
        $administradores = Administrador::all();

        return view('administradores.index', compact('administradores'));
    }

    public function create()
    {
        return view('administradores.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $atributos = request()->validate([
            'nombre_admin' => ['required', 'string', 'max:255', 'unique:'.Administrador::class],
            'correo_admin' => ['required', 'string', 'lowercase', 'email', 'max:255', 'unique:'.Administrador::class ],
            'password' => ['required', 'string', 'confirmed', Rules\Password::defaults()],
        ]);

        Administrador::create($atributos);

        return redirect('/admin/administradores');
    }

    /**
     * Display the specified resource.
     */
    public function show(Administrador $administrador)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Administrador $administrador)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Administrador $administrador)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Administrador $administrador)
    {
        //
    }
}
