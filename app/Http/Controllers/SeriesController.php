<?php

namespace App\Http\Controllers;

use App\Http\Requests\SeriesFormRequest;
use App\Models\Serie;
use Illuminate\Http\Request;


class SeriesController extends Controller
{
    public function index(Request $request)
    {
        $mensagem = $request->session()->get('mensagem');

        $series = Serie::query()->orderBy('nome')->get();

        return view('series.index', compact('series', 'mensagem'));
    }

    public function create()
    {
        return view('series.create');
    }

    public function store(SeriesFormRequest $request)
    {


        $serie = Serie::create($request->all());

        $request->session()->flash('mensagem', "Série ID: {$serie->id} Nome: {$serie->nome} foi criada com sucesso");

        return redirect()->route('listar_series');
    }

    public function destroy(Request $request)
    {
        Serie::destroy($request->id);

        $request->session()->flash(
            'mensagem',
            'Série Excluida com sucesso'
        );
        return redirect()->route('listar_series');
    }
}
