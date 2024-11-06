<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\AreaInteresse;

class AreaDeInteresseController extends Controller
{
    public function store(Request $request)
    {
        AreaInteresse::create($request->all());
        return redirect()->route('inicio');

    }
}
