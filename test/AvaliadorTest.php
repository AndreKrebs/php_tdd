<?php
//require_once 'vendor/autoload.php';

require "Usuario.php";
require "Lance.php";
require "Leilao.php";
require "Avaliador.php";


use PHPUnit\Framework\TestCase;

class AvaliadorTest extends TestCase {

    public function testAceitaLeilaoEmOrdemCrescente() {

        $joao = new Usuario("Joao");
        $renan = new Usuario("Renan");
        $felipe = new Usuario("Felipe");

        $leilao = new Leilao("Playstation 3");

        $leilao->propoe(new Lance($joao,250));
        $leilao->propoe(new Lance($renan,300));
        $leilao->propoe(new Lance($felipe,400));

        $leiloeiro = new Avaliador();
        $leiloeiro->avalia($leilao);

        $maiorEsperado = 400;
        $menorEsperado = 250;

        $this->assertEquals($maiorEsperado, $leiloeiro->getMaiorLance());
        $this->assertEquals($menorEsperado, $leiloeiro->getMenorLance());


    }
    
    public function testMediaDeLances() {
        $joao = new Usuario("Joao");
        $renan = new Usuario("Renan");
        $felipe = new Usuario("Felipe");

        $leilao = new Leilao("Playstation 3");

        $leilao->propoe(new Lance($joao,250));
        $leilao->propoe(new Lance($renan,300.22));
        $leilao->propoe(new Lance($felipe,400.35));

        $leiloeiro = new Avaliador();
        $leiloeiro->avalia($leilao);
        
        $somaLances = 0;
        $totalLances = count($leilao->getLances());
        
        foreach($leilao->getLances() as $lance) {
            $somaLances += $lance->getValor();
        }
    
        $mediaEsperada = $somaLances/$totalLances;
        
        $this->assertEquals($mediaEsperada, $leiloeiro->getMediaLances(), 0.0001);
        
    }
    
    public function testUnicoLanceValorMaiorEMenor() {
        
        $joao = new Usuario("João");
        
        $leilao = new Leilao("Playstation 4");
        
        $leilao->propoe(new Lance($joao, 200));
        
        $leiloeiro = new Avaliador();
        $leiloeiro->avalia($leilao);
        
        $this->assertEquals(200, $leiloeiro->getMenorLance());
        $this->assertEquals(200, $leiloeiro->getMaiorLance());
    }
    
    public function testLancesValoresForaDeOrdem() {
        $joao = new Usuario("Joao");
        $renan = new Usuario("Renan");
        $felipe = new Usuario("Felipe");

        $leilao = new Leilao("Playstation 4");

        $leilao->propoe(new Lance($joao,200));
        $leilao->propoe(new Lance($renan,450));
        $leilao->propoe(new Lance($felipe,120));
        $leilao->propoe(new Lance($joao,700));
        $leilao->propoe(new Lance($renan,630));
        $leilao->propoe(new Lance($felipe,230));
        
        $leiloeiro = new Avaliador();
        
        $leiloeiro->avalia($leilao);
        
        $this->assertEquals(120, $leiloeiro->getMenorLance());
        $this->assertEquals(700, $leiloeiro->getMaiorLance());
    }
    
    public function testLancesValorDecrescente() {
        $joao = new Usuario("Joao");
        $renan = new Usuario("Renan");
        $felipe = new Usuario("Felipe");

        $leilao = new Leilao("Playstation 4");

        $leilao->propoe(new Lance($joao,400));
        $leilao->propoe(new Lance($renan,300));
        $leilao->propoe(new Lance($felipe,200));
        $leilao->propoe(new Lance($joao,100));
        
        $leiloeiro = new Avaliador();
        
        $leiloeiro->avalia($leilao);
        
        $this->assertEquals(100, $leiloeiro->getMenorLance());
        $this->assertEquals(400, $leiloeiro->getMaiorLance());
    }
    
}
