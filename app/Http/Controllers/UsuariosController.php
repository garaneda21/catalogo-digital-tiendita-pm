<?php

namespace App\Http\Controllers;

use App\Models\Registro;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\Validation\Rules;

class UsuariosController extends Controller
{
    public function index()
    {
        if (request()->user('admin')->cannot('viewAny', User::class)) {
            return view('admin.usuarios.index'); // salir sin enviar datos
        }

        $usuarios = User::all();

        foreach ($usuarios as $user) {
            $user['ultimo_cambio'] = Registro::where('user_id', $user->id)
                ->whereNotIn('accion_id', [1, 2])
                ->latest('fecha_registro')
                ->first()->fecha_registro ?? null;
        }

        return view('admin.usuarios.index', compact('usuarios'));
    }

    public function create()
    {
        if (request()->user('admin')->cannot('create', User::class)) {
            abort(403);
        }

        return view('admin.usuarios.create');
    }

    public function store(Request $request)
    {
        if (request()->user('admin')->cannot('create', User::class)) {
            abort(403);
        }

        $atributos = $request->validate([
            'name'     => ['required', 'string', 'max:255', 'unique:users'],
            'email'    => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
        ]);

        $user = User::create($atributos);

        Registro::registrar_accion($user, 'Crea un nuevo usuario cliente'); // acción: creación

        session()->flash('success', 'Usuario creado exitosamente!');

        return redirect('/admin/usuarios');
    }

    public function show(User $usuario)
    {
        if (request()->user('admin')->cannot('view', User::class)) {
            return view('admin.usuarios.show', [
                'usuario' => $usuario,
            ]);
        }

        $registros = Registro::where('user_id', $usuario->id)
            ->with('accion')
            ->orderBy('fecha_registro', 'desc')
            ->take(10)
            ->get();

        foreach ($registros as $registro) {
            $registro['dato_modificado'] = Registro::obtener_modelo_registro($registro->id_entidad_modificada, $registro->entidad_modificada);
        }

        $ultimo_login = $registros->first(function ($registro) {
            return $registro->accion_id === 1;
        });
        $usuario['ultimo_login'] = $ultimo_login ? $ultimo_login->fecha_registro : null;

        return view('admin.usuarios.show', [
            'usuario'   => $usuario,
            'registros' => $registros,
        ]);
    }

    public function edit(User $usuario)
    {
        if (request()->user('admin')->cannot('update', User::class)) { abort(403); }

        return view('admin.usuarios.edit', ['usuario' => $usuario]);
    }

    public function update(Request $request, User $usuario)
    {
        if (request()->user('admin')->cannot('update', User::class)) { abort(403); }

        $request->validate([
            'name'  => ['required', 'string', 'max:255', Rule::unique('users')->ignore($usuario->id)],
            'email' => ['required', 'string', 'email', 'max:255', Rule::unique('users')->ignore($usuario->id)],
        ]);

        $usuario->update([
            'name'  => $request->input('name'),
            'email' => $request->input('email'),
        ]);

        Registro::registrar_accion($usuario, 'Edita un usuario cliente'); // acción: edición

        session()->flash('success', 'Usuario actualizado exitosamente!');

        return redirect('/admin/usuarios');
    }

    public function destroy(User $usuario)
    {
        if (request()->user('admin')->cannot('delete', User::class)) { abort(403); }

        $usuario->delete();

        Registro::registrar_accion($usuario, 'Elimina un usuario cliente'); // acción: eliminación

        session()->flash('success', 'Usuario Eliminado exitosamente!');

        return redirect('/admin/usuarios');
    }
}
