<?php


namespace App\Services;


use App\Models\Serie;
use App\Models\Temporada;
use Illuminate\Support\Facades\DB;

class CriadorDeSerie
{
    public function criarSerie(string $nomeSerie, int $qtdTemporadas, int $epPorTemporadas, ?string $capa): Serie
    {
        DB::beginTransaction();
        $serie = Serie::create(['nome' => $nomeSerie,'capa'=>$capa]);
        $this->criarTemporadas($qtdTemporadas, $serie, $epPorTemporadas);
        DB::commit();
        return $serie;
    }


    public function criarTemporadas(int $qtdTemporadas, Serie $serie, int $epPorTemporadas): void
    {
        for ($i = 1; $i <= $qtdTemporadas; $i++) {
            $temporada = $serie->temporadas()->create(['numero' => $i]);
            $this->criarEpisodios($epPorTemporadas, $temporada);
        }
    }

    public function criarEpisodios(int $epPorTemporadas, Temporada $temporada): void
    {
        for ($j = 1; $j <= $epPorTemporadas; $j++) {
            $temporada->episodios()->create(['numero' => $j]);
        }
    }
}
