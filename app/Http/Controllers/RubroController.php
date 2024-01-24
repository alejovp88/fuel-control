<?php

namespace App\Http\Controllers;

use App\Models\Rubro;
use Illuminate\Http\Request;

class RubroController extends Controller
{
    function index() {
        $rubros = Rubro::all();

        return view('rubros.index')->with([
            'rubros' => $rubros
        ]);
    }

    function show (Rubro $rubro) {

        return view('rubros.show')->with([
            'rubro' => $rubro
        ]);
    }

    function create() {

        return view('rubros.create');
    }

    function store() {
        Rubro::create(request()->all());

        return $this->index();
    }

    function edit(Rubro $rubro) {

        return view('rubros.edit')->with([
            'rubro' => $rubro
        ]);
    }

    function update(Rubro $rubro) {
        $rubro->update(request()->all());

        return $this->index();
    }
}
