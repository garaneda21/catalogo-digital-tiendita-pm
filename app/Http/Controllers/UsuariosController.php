<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Registro;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\Validation\Rules;

class UsuariosController extends Controller
{
    public function index()
    {
        $usuarios = User::all();

        foreach ($usuarios as $usuario) {
            $usuario['ultimo_cambio'] = Registro::where('user_id', $usuario->id)
                ->whereNotIn('accion_id', [1, 2])
                ->latest('fecha_registro')
                ->first()->fecha_registro ?? null;
        }

        return view('admin.usuarios.index', compact('usuarios'));
    }

    public function create()
    {
        return view('admin.usuarios.create');
    }

    public function store(Request $request)
    {
        $atributos = request()->validate([
            'name' => ['required', 'string', 'max:255', 'unique:users'],
            'email' => ['required', 'string', 'lowercase', 'email', 'max:255', 'unique:users'],
            'password'     => ['required', 'string', 'confirmed', Rules\Password::defaults()],
        ]);

        $usuario = User::create($atributos);

        Registro::registrar_accion($usuario, 'user', 5);

        return redirect('/admin/usuarios');
    }

    /**
     * Display the specified resource.
     */
    public function show(User $usuario)
    {
        $registros = Registro::with('accion')
            ->orderBy('fecha_registro', 'desc')
            ->take(10)
            ->get();

        foreach ($registros as $registro) {
            $registro['dato_modificado'] = Registro::obtener_modelo_registro($registro->id_entidad_modificada, $registro->entidad_modificada);
        }

        $usuario['ultimo_login'] = $registros->first(function ($registro) {
            return $registro->accion_id === 1;
        })->fecha_registro;

        return view('admin.usuarios.show', [
            'usuario'     => $usuario,
            'registros' => $registros,
        ]);
    }

    public function edit(User $usuario)
    {
        return view('admin.usuarios.edit', ['usuario' => $usuario]);
    }

    public function update(User $usuario)
    {
        request()->validate([
            'name' => ['required', 'string', 'max:255', Rule::unique('users')->ignore($usuario->id)],
            'email' => ['required', 'string', 'lowercase', 'email', 'max:255', Rule::unique('users')->ignore($usuario->id)],
        ]);

        $usuario->update([
            'name' => request('name'),
            'email' => request('email'),
        ]);

        Registro::registrar_accion($usuario, 'user', 6);

        return redirect('/admin/usuarios');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(User $usuario)
    {
        //
    }
}
