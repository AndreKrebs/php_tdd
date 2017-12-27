<?php
declare(strict_types=1);

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
}
