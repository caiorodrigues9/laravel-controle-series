<?php

namespace App\Http\Controllers;

use App\Http\Requests\SeriesFormRequest;
use App\Mail\NovaSerie;
use App\Models\Serie;
use App\Models\User;
use App\Services\CriadorDeSerie;
use App\Services\RemovedorDeSerie;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;


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

    public function store(SeriesFormRequest $request, CriadorDeSerie $criadorDeSerie)
    {
        $serie = $criadorDeSerie->criarSerie(
            $request->nome,
            $request->qtd_temporadas,
            $request->ep_por_temporadas
        );


        $users = User::all();

        foreach ($users as $user) {
            $email = new NovaSerie(
                $request->nome,
                $request->qtd_temporadas,
                $request->ep_por_temporadas
            );

            $email->subject = 'Nova Série Adicionada';

            Mail::to($user)->send($email);
            sleep(5);
        }

        $request->session()->flash(
            'mensagem',
            "Série ID: {$serie->id} Nome: {$serie->nome} e suas temporadas e episodios foram criados com sucesso"
        );

        return redirect()->route('listar_series');
    }

    public function destroy(Request $request, RemovedorDeSerie $removedorDeSerie)
    {
        $nomeSerie = $removedorDeSerie->removerSerie($request->id);

        $request->session()->flash(
            'mensagem',
            "Série {$nomeSerie} foi removida com sucesso"
        );
        return redirect()->route('listar_series');
    }

    public function editaNome(int $id, Request $request)
    {
        $novoNome = $request->nome;
        $serie = Serie::find($id);
        $serie->nome = $novoNome;
        $serie->save();
    }
}
