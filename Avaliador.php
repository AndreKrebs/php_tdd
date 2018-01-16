<?php
class Avaliador {
    private $maiorDeTodos = -INF;
    private $menorDeTodos = INF;
    private $somaLances = 0;
    private $totalLances = 0;
    private $maiores = array();
    
    public function avalia(Leilao $leilao) {
        foreach($leilao->getLances() as $lance) {
            if($lance->getValor() > $this->maiorDeTodos)
                $this->maiorDeTodos = $lance->getValor();
            if($lance->getValor() < $this->menorDeTodos)
                $this->menorDeTodos = $lance->getValor();

            $this->somaLances += $lance->getValor();
            $this->totalLances++;
        }

        $this->pegaOsMaioresNo($leilao);
    }
    
    public function pegaOsMaioresNo(Leilao $leilao) {
        $lances = $leilao->getLances();
        usort($lances,function ($a,$b) {
            if($a->getValor() == $b->getValor()) return 0;
            return ($a->getValor() < $b->getValor()) ? 1 : -1;
        });

        $this->maiores = array_slice($lances, 0,3);
    }

    public function getTresMaiores() {
        return $this->maiores;
    }
    
    public function getMaiorLance() {
        return $this->maiorDeTodos;
    }

    public function getMenorLance() {
        return $this->menorDeTodos;
    }
    
    public function getMediaLances() {
        return $this->somaLances/$this->totalLances;
    }
    
}
