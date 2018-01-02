<?php
class Avaliador {
    private $maiorDeTodos = -INF;
    private $menorDeTodos = INF;
    private $somaLances = 0;
    private $totalLances = 0;
    
    public function avalia(Leilao $leilao) {
        foreach($leilao->getLances() as $lance) {
            foreach($leilao->getLances() as $lance) {
                if($lance->getValor() > $this->maiorDeTodos)
                    $this->maiorDeTodos = $lance->getValor();
                if($lance->getValor() < $this->menorDeTodos)
                    $this->menorDeTodos = $lance->getValor();
                
                $this->somaLances += $lance->getValor();
                $this->totalLances++;
            }
        }
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
