<?php

class caneta{
    var $modelo; //Usar $ antes do nome da variavel
    var $cor;
    var $ponta;
    var $marca;
    var $tampada;

    function rabiscar() {
        if($this->tampada == true){
            echo"A caneta está tampada...";
        } else {
            echo"A caneta está destampada, Estou rabiscando...";
        }
    }

    function tampar() {
        $this->tampada = true
    }

    function destampar(){
        $this->tampada = false;
    }
}