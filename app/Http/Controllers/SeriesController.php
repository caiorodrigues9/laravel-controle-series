<?php

namespace App\Http\Controllers;

use App\Models\Serie;
use Illuminate\Http\Request;


class SeriesController extends Controller
{
    public function index()
    {

        $series = Serie::query()->orderBy('nome')->get();

        return view('series.index',compact('series'));
    }

    public function create()
    {
        return view('series.create');
    }

    public function store(Request $request)
    {
        $serie = Serie::create($request->all());
        echo "Serie com ID: {$serie->id} com nome {$serie->nome} criada.";
    }
}
