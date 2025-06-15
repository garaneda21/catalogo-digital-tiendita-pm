<?php

namespace App\Http\Controllers;

use App\Models\Categoria;
use App\Models\Producto;
use App\Models\Registro;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Validation\Rule;

class CategoriaController extends Controller
{
    public function index(Request $request)
    {
        $categorias = Categoria::all();
        return view('admin.categorias.index', compact('categorias'));
    }

    public function create()
    {
        return view('admin.categorias.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nombre_categoria'      => ['required', 'max:250', 'unique:categorias'],
            'descripcion_categoria' => [],
        ]);

        $categoria = Categoria::create([
            'nombre_categoria'      => request('nombre_categoria'),
            'descripcion_categoria' => request('descripcion_categoria'),
        ]);

        Registro::registrar_accion($categoria, 'Crea nueva categoría');

        session()->flash('success', 'Categoría creada exitosamente!');

        return redirect('/admin/categorias/');
    }

    public function edit(Categoria $categoria)
    {
        return view('admin.categorias.edit', compact('categoria'));
    }

    public function update(Request $request, Categoria $categoria)
    {
        $request->validate([
            'nombre_categoria' => ['required', 'max:250', Rule::unique('categorias')->ignore($categoria->id)],
            'descripcion_categoria' => [],
        ]);

        $categoria->update([
            'nombre_categoria'      => $request->input('nombre_categoria'),
            'descripcion_categoria' => $request->input('descripcion_categoria'),
        ]);

        Registro::registrar_accion($categoria, 'Edita una categoría');

        session()->flash('success', 'Categoría actualizada exitosamente!');

        return redirect()->route('categorias.index');
    }

    public function destroy(Categoria $categoria)
    {
        $categoria->delete();

        Registro::registrar_accion($categoria, 'Elimina una categoría');

        session()->flash('success', '¡Categoría eliminada exitosamente!');

        return redirect()->route('categorias.index');
    }
}
