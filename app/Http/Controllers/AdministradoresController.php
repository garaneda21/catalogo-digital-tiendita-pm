<?php

namespace App\Http\Controllers;

use App\Models\Administrador;
use App\Models\Permisos;
use App\Models\Registro;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\Rule;
use Illuminate\Validation\Rules;

class AdministradoresController extends Controller
{
    public function index()
    {
        if (request()->user('admin')->cannot('viewAny', Administrador::class)) {
            return view('admin.administradores.index'); // salir sin enviar datos
        }

        $administradores = Administrador::all();

        foreach ($administradores as $admin) {
            $admin['ultimo_cambio'] = Registro::where('administrador_id', $admin->id)
                ->whereNotIn('accion_id', [1, 2])
                ->latest('fecha_registro')
                ->first()->fecha_registro ?? null;
        }

        return view('admin.administradores.index', compact('administradores'));
    }

    public function create(Request $request)
    {
        if (request()->user('admin')->cannot('create', Administrador::class)) {
            abort(403);
        }

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

        Registro::registrar_accion($admin, 'Crea un nuevo admin');

        session()->flash('success', 'Nuevo admin creado');

        return redirect('/admin/administradores');
    }

    /**
     * Display the specified resource.
     */
    public function show(Administrador $administrador)
    {
        if (request()->user('admin')->cannot('view', Administrador::class)) {
            return view('admin.administradores.show', ['admin' => $administrador]); // salir sin enviar datos
        }

        $registros = Registro::with('accion')
            ->where('administrador_id', $administrador->id)
            ->orderBy('fecha_registro', 'desc')
            ->take(10)
            ->get();

        foreach ($registros as $registro) {
            $registro['dato_modificado'] = Registro::obtener_modelo_registro($registro->id_entidad_modificada, $registro->entidad_modificada);
        }

        $administrador['ultimo_login'] = $registros->first(function ($registro) {
            return $registro->accion_id === 1;
        })->fecha_registro ?? 'No ha accedido aún';

        $permisos_actuales = $administrador->permisos()->get()->groupBy('categoria_permiso');

        return view('admin.administradores.show', [
            'admin'             => $administrador,
            'permisos_actuales' => $permisos_actuales,
            'registros'         => $registros,
        ]);
    }

    public function edit(Administrador $administrador)
    {
        if (request()->user('admin')->cannot('update', Administrador::class)) {
            abort(403);
        }

        return view('admin.administradores.edit', ['admin' => $administrador]);
    }

    public function update(Administrador $administrador)
    {
        if (request()->user('admin')->cannot('update', Administrador::class)) {
            abort(403);
        }

        request()->validate([
            'nombre_admin' => ['required', 'string', 'max:255', Rule::unique('administradores')->ignore($administrador->id)],
            'correo_admin' => ['required', 'string', 'lowercase', 'email', 'max:255', Rule::unique('administradores')->ignore($administrador->id)],
        ]);

        $administrador->update([
            'nombre_admin' => request('nombre_admin'),
            'correo_admin' => request('correo_admin'),
        ]);

        Registro::registrar_accion($administrador, 'Edita los datos de un admin');

        session()->flash('success', 'Datos actualizados');

        return redirect('/admin/administradores');
    }

    public function disable(Administrador $administrador)
    {
        if (request()->user('admin')->cannot('disable', Administrador::class)) { abort(403); }

        if ($administrador->activo) {
            $administrador->update(['activo' => false]);
        } else {
            $administrador->update(['activo' => true]);
        }

        return redirect('/admin/administradores');
    }

    public function edit_permisos(Administrador $administrador)
    {
        if ($administrador->superadmin) {
            abort(403, 'No se pueden editar los permisos de un SuperAdmin');
        }

        if (request()->user('admin')->cannot('update_permisos', Administrador::class)) {
            abort(403);
        }

        $permisos_asignados = $administrador->permisos()->pluck('id');
        $permisos = Permisos::all()->groupBy('categoria_permiso');

        return view('admin.administradores.edit-permisos', [
            'admin'              => $administrador,
            'permisos'           => $permisos,
            'permisos_asignados' => $permisos_asignados,
        ]);
    }

    public function update_permisos(Administrador $administrador)
    {
        if (request()->user('admin')->cannot('update_permisos', Administrador::class)) {
            abort(403);
        }

        request()->validate([
            'permisos'   => ['nullable', 'array'], // los permisos recibidos vienen en un array
            'permisos.*' => ['integer', 'exists:permisos,id'], // los permisos deben existir
        ]);

        // Obtenemos solo los IDs de los permisos activos desde el form (los checkboxes marcados)
        $permisosActivos = array_map('intval', request()->input('permisos', [])); // si no hay ninguno, será un array vacío

        if (! in_array(1, $permisosActivos) && collect($permisosActivos)->intersect([2, 3, 4, 5])->isNotEmpty()) {
            session()->flash('warning', 'El permiso [Ver Todos Los Productos] está desactivado, pero tienes permisos específicos habilitados, por lo que el administrador no podrá acceder a algunas funciones normalmente.');
        }
        if (! in_array(6, $permisosActivos) && collect($permisosActivos)->intersect([7, 8, 9, 10, 11, 12])->isNotEmpty()) {
            session()->flash('warning', 'El permiso [Ver Todos Los Admin] está desactivado, pero tienes permisos específicos habilitados, por lo que el administrador no podrá acceder a algunas funciones normalmente.');
        }

        // Actualizamos la tabla pivote: se eliminan los que no estén, se agregan los nuevos
        $administrador->permisos()->sync($permisosActivos);

        Registro::registrar_accion($administrador, 'Edita los permisos de un admin');

        session()->flash('success', 'Permisos Actualizados');

        return redirect()->back();
    }

    public function index_historial(Administrador $administrador)
    {
        $query = Registro::with('accion')
            ->where('administrador_id', $administrador->id);

        // Filtro por acción
        if ($accion = request('accion')) {
            $query->whereHas('accion', fn ($q) => $q->where('nombre_accion', $accion));
        }

        // Filtro por entidad modificada
        if ($entidad = request('entidad')) {
            if ($entidad === 'sin_entidad') {
                $query->whereNull('entidad_modificada');
            } else {
                $query->where('entidad_modificada', $entidad);
            }
        }

        // Filtro por fecha (desde)
        if ($desde = request('desde')) {
            $query->whereDate('fecha_registro', '>=', $desde);
        }

        // Filtro por fecha (hasta)
        if ($hasta = request('hasta')) {
            $query->whereDate('fecha_registro', '<=', $hasta);
        }

        $registros = $query->orderBy('fecha_registro', 'desc')->paginate(20);

        foreach ($registros as $registro) {
            $registro['dato_modificado'] = Registro::obtener_modelo_registro($registro->id_entidad_modificada, $registro->entidad_modificada);
        }

        // Para los selects del filtro
        $acciones = DB::table('acciones')->pluck('nombre_accion');
        $entidades = Registro::distinct()
            ->whereNotNull('entidad_modificada')
            ->pluck('entidad_modificada');

        return view('admin.administradores.index-historial', [
            'admin'     => $administrador,
            'registros' => $registros,
            'acciones'  => $acciones,
            'entidades' => $entidades,
        ]);
    }
}
