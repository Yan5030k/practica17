<?php

namespace App\Http\Controllers;

use App\Models\Libro;
use App\Models\Categoria;
use Illuminate\Http\Request;
use Inertia\Inertia;

class LibroController extends Controller
{
    public function create()
    {
        $categorias = Categoria::orderBy('nombre')->get();

        return Inertia::render('Libros/Create', [
            'categorias' => $categorias,
        ]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'nombre' => 'required|string|max:150',
            'autor' => 'required|string|max:120',
            'editorial' => 'required|string|max:120',
            'edicion' => 'required|string|max:80',
            'fecha_lanzamiento' => 'required|date',
            'imagen_portada' => 'required|image|mimes:jpg,jpeg,png,webp|max:2048',
            'categoria_id' => 'required|exists:categorias,id',
        ]);

        $rutaImagen = $request->file('imagen_portada')->store('portadas', 'public');

        Libro::create([
            'nombre' => $request->nombre,
            'autor' => $request->autor,
            'editorial' => $request->editorial,
            'edicion' => $request->edicion,
            'fecha_lanzamiento' => $request->fecha_lanzamiento,
            'imagen_portada' => $rutaImagen,
            'categoria_id' => $request->categoria_id,
        ]);

        return redirect()->route('inicio')
            ->with('success', 'Libro registrado correctamente.');
    }
}