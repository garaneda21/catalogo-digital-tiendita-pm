<?php

namespace App\Http\Controllers;

use App\Models\Categoria;
use App\Models\Registro;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;

class CategoriaController extends Controller
{
    public function index(Request $request)
    {
        if (request()->user('admin')->cannot('viewAny', Categoria::class)) {
            return view('admin.categorias.index'); // salir sin enviar datos
        }

        $categorias = Categoria::all();

        return view('admin.categorias.index', compact('categorias'));
    }

    public function create()
    {
        if (request()->user('admin')->cannot('create', Categoria::class)) {
            abort(403);
        }

        return view('admin.categorias.create');
    }

    public function store(Request $request)
    {
        if (request()->user('admin')->cannot('create', Categoria::class)) {
            abort(403);
        }

        $request->validate([
            'nombre_categoria'      => ['required', 'max:250', 'unique:categorias'],
            'descripcion_categoria' => [],
        ]);

        $categoria = Categoria::create([
            'nombre_categoria'      => request('nombre_categoria'),
            'slug'                  => Str::slug(request('nombre_categoria')),
            'descripcion_categoria' => request('descripcion_categoria'),
        ]);

        Registro::registrar_accion($categoria, 'Crea nueva categoría');

        session()->flash('success', 'Categoría creada exitosamente!');

        return redirect('/admin/categorias/');
    }

    public function edit(Categoria $categoria)
    {
        if (request()->user('admin')->cannot('update', Categoria::class)) {
            abort(403);
        }

        return view('admin.categorias.edit', compact('categoria'));
    }

    public function update(Request $request, Categoria $categoria)
    {
        if (request()->user('admin')->cannot('update', Categoria::class)) {
            abort(403);
        }

        $request->validate([
            'nombre_categoria'      => ['required', 'max:250', Rule::unique('categorias')->ignore($categoria->id)],
            'descripcion_categoria' => [],
        ]);

        $categoria->update([
            'nombre_categoria'      => $request->input('nombre_categoria'),
            'slug'                  => Str::slug($request->input('nombre_categoria')),
            'descripcion_categoria' => $request->input('descripcion_categoria'),
        ]);

        Registro::registrar_accion($categoria, 'Edita una categoría');

        session()->flash('success', 'Categoría actualizada exitosamente!');

        return redirect()->route('categorias.index');
    }

    public function destroy(Categoria $categoria)
    {
        if (request()->user('admin')->cannot('delete', Categoria::class)) {
            abort(403);
        }

        $categoria->delete();

        Registro::registrar_accion($categoria, 'Elimina una categoría');

        session()->flash('success', '¡Categoría eliminada exitosamente!');

        return redirect()->route('categorias.index');
    }
}
