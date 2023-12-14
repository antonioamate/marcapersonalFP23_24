<?php

namespace App\Http\Controllers;

use App\Models\Docente;
use App\Models\Proyecto;
use Illuminate\Http\Request;

class CatalogController extends Controller
{
    public function getIndex()
    {
        $proyecto = Proyecto::all();
        return view('catalog.index', ['arrayProyectos' => $proyecto]);
    }

    public function getShow($id)
    {
        $proyecto = Proyecto::FindOrFail($id);
        $docente = Docente::FindOrFail($proyecto->docente_id);
        return view('catalog.show')
            ->with('proyecto', $proyecto)
            ->with('docente', $docente);

    }

    public function putEdit($id)
    {
        $proyecto = Proyecto::FindOrFail($id);
        $proyecto->metadatos = unserialize($proyecto->metadatos);
        return view('catalog.edit')
            ->with('proyecto', $proyecto)
            ->with('id', $proyecto->id);
    }

    public function getEdit($id)
    {
        $proyecto = Proyecto::FindOrFail($id);
        return view('catalog.edit')
            ->with('proyecto', $proyecto)
            ->with('id', $proyecto->id);
    }

    public function getCreate()
    {
        return view('catalog.create');
    }

    public function store(Request $request)
    {
        $proyecto = Proyecto::create($request->all());

        return redirect(action([self::class, 'getShow'], ['id' => $proyecto->id]));
    }
}
