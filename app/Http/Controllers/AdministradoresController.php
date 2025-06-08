<?php

namespace App\Http\Controllers;

use App\Models\Administrador;
use App\Models\Permisos;
use App\Models\PermisosAdmin;
use App\Models\Registro;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\Validation\Rules;

class AdministradoresController extends Controller
{
    public function index()
    {
        $administradores = Administrador::all();

        foreach ($administradores as $admin) {
            $admin['ultimo_cambio'] = Registro::where('administrador_id', $admin->id)
                ->whereNotIn('accion_id', [1, 2])
                ->latest('fecha_registro')
                ->first()->fecha_registro ?? null;
        }

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
            'correo_admin' => ['required', 'string', 'lowercase', 'email', 'max:255', 'unique:'.Administrador::class],
            'password'     => ['required', 'string', 'confirmed', Rules\Password::defaults()],
        ]);

        $admin = Administrador::create($atributos);

        Registro::registrar_accion($admin, 'administrador', 5);

        return redirect('/admin/administradores');
    }

    /**
     * Display the specified resource.
     */
    public function show(Administrador $administrador)
    {
        $registros = Registro::with('accion')
            ->orderBy('fecha_registro', 'desc')
            ->take(10)
            ->get();

        foreach ($registros as $registro) {
            $registro['dato_modificado'] = Registro::obtener_modelo_registro($registro->id_entidad_modificada, $registro->entidad_modificada);
        }

        $administrador['ultimo_login'] = $registros->first(function ($registro) {
            return $registro->accion_id === 1;
        })->fecha_registro;

        return view('admin.administradores.show', [
            'admin'     => $administrador,
            'registros' => $registros,
        ]);
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
            'correo_admin' => request('correo_admin'),
        ]);

        Registro::registrar_accion($administrador, 'administrador', 6);

        return redirect('/admin/administradores');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Administrador $administrador)
    {
        //
    }

    public function edit_permisos(Administrador $administrador)
    {
        $permisos_asignados = $administrador->permisos()->pluck('id');
        $permisos = Permisos::all()->groupBy('categoria_permiso');

        return view('admin.administradores.edit-permisos', [
            'admin'    => $administrador,
            'permisos' => $permisos,
            'permisos_asignados' => $permisos_asignados,
        ]);
    }

    public function update_permisos(Administrador $administrador)
    {
        request()->validate([
            'permisos'   => ['nullable', 'array'], // los permisos recibidos vienen en un array
            'permisos.*' => ['integer', 'exists:permisos,id'], // los permisos deben existir
        ]);

        // Obtenemos solo los IDs de los permisos activos desde el form (los checkboxes marcados)
        $permisosActivos = request()->input('permisos', []); // si no hay ninguno, será un array vacío

        // Actualizamos la tabla pivote: se eliminan los que no estén, se agregan los nuevos
        $administrador->permisos()->sync($permisosActivos);

        // Registro::registrar_accion($administrador, 'administrador', 6);

        return redirect()->back();
    }
}
