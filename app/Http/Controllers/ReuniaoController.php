<?php

namespace App\Http\Controllers;
use App\Models\Discente;
use App\Models\Docente;
use App\Models\Reuniao;
use Illuminate\Http\Request;

class ReuniaoController extends Controller
{
    public function create()
    {
        $docente= Docente::all();
        $discente= Discente::all();

        return view('sistema.cadReuniao', compact('docente','discente'));
    }

    public function store(Request $request)
    { 
        Reuniao::create($request->all());
        return redirect()->route('indexProfessor');
    }
}
