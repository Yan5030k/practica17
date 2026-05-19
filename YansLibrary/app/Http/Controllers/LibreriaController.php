<?php

namespace App\Http\Controllers;

use App\Models\Libro;
use Inertia\Inertia;

class LibreriaController extends Controller
{
    public function inicio()
    {
        $libros = Libro::with('categoria')
            ->latest()
            ->get();

        return Inertia::render('Libreria/Inicio', [
            'libros' => $libros,
        ]);
    }
}