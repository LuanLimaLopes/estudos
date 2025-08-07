<?php

class caneta{
    public $modelo; //modelo publico
    private $cor; //
    private $ponta; 
    protected $marca;
    private $tampada;

    public function rabiscar() {
        if($this->tampada == true) {
            echo"Erro, não pode rabiscar!";
        } else {
            echo"Estou rabiscando...";
        }
    }
}

 public function tampar() {
    $this->tampada = true;
}

 public function destampar() {
    $this->tampada = false;
}