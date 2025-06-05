<?php

namespace App\Http\Controllers;

use App\Models\Categoria;
use Illuminate\Http\Request;

class CategoriaController extends Controller
{
    public function index()
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

        Categoria::create([
            'nombre_categoria' => request('nombre_categoria'),
            'descripcion_categoria' => request('descripcion_categoria'),
        ]);

        // return redirect()->route('/admin/categorias/'); // implementar después ._.
        return redirect('/admin/productos/');
    }

    public function edit(Categoria $categoria)
    {
        return view('admin.categorias.edit', compact('categoria'));
    }

    public function update(Request $request, Categoria $categoria)
    {
        $request->validate([
            'nombre_categoria'      => 'required|max:250',
            'descripcion_categoria' => 'nullable',
        ]);

        $categoria->update($request->all());

        return redirect()->route('admin.categorias.index');
    }

    public function destroy(Categoria $categoria)
    {
        $categoria->delete();

        return redirect()->route('admin.categorias.index');
    }
}
