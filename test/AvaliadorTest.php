<?php

set_include_path('/var/www/html/php_tdd');

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

        $this->assertEquals($leiloeiro->getMaiorLance(),$maiorEsperado);
        $this->assertEquals($leiloeiro->getMenorLance(),$menorEsperado);


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
    
        $this->assertEquals((250+300.22+400.35)/3, $leiloeiro->getMediaLances(), 0.0001);
        
    }
}
