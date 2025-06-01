<?php

namespace App\Http\Controllers;

use App\Models\Administrador;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\Validation\Rules;

class AdministradoresController extends Controller
{
    public function index()
    {
        $administradores = Administrador::all();

        return view('admin.administradores.index', compact('administradores'));
    }

    public function create()
    {
        return view('admin.administradores.create');
    }

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

    public function edit(Administrador $administrador)
    {
        return view('admin.administradores.edit', ['admin' => $administrador]);
    }

    public function update(Administrador $administrador)
    {
        request()->validate([
            'nombre_admin' => ['required', 'string', 'max:255', Rule::unique('administradores')->ignore($administrador->id)],
            'correo_admin' => ['required', 'string', 'lowercase', 'email', 'max:255', Rule::unique('administradores')->ignore($administrador->id)],
        ]);

        $administrador->update([
            'nombre_admin' => request('nombre_admin'),
            'correo_admin' => request('correo_admin')
        ]);

        return redirect('/admin/administradores');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Administrador $administrador)
    {
        //
    }
}
