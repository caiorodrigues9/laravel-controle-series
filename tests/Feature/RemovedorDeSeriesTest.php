<?php

namespace Tests\Feature;

use App\Models\Serie;
use App\Services\CriadorDeSerie;
use App\Services\RemovedorDeSerie;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class RemovedorDeSeriesTest extends TestCase
{
    private Serie $serie;

    use RefreshDatabase;

    protected function setUp(): void
    {
        parent::setUp();
        $criadorDeSeries = new CriadorDeSerie();
        $this->serie = $criadorDeSeries->criarSerie('Nome da série',1,1);
    }

    public function testRemoverUmaSerie()
    {
        $this->assertDatabaseHas('series',['id'=>$this->serie->id]);
        $removedorDeSerie = new RemovedorDeSerie();
        $nomeDaSerie = $removedorDeSerie->removerSerie($this->serie->id);
        $this->assertIsString($nomeDaSerie);
        $this->assertEquals('Nome da série',$nomeDaSerie);
        $this->assertDatabaseMissing('series',['id'=>$this->serie->id]);
    }
}
