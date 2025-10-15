<?php

abstract class animal
{

    private $peso;
    private $idade;
    private $membros;

    abstract public function locomover();
    abstract public function alimentar();
    abstract public function emitir_som();

    public function get_peso()
    {
        return $this->peso;
    }
    public function set_peso($p)
    {
        $this->peso = $p;
    }

    public function get_idade()
    {
        return $this->idade;
    }
    public function set_idade($i)
    {
        $this->idade = $i;
    }

    public function get_membros()
    {
        return $this->membros;
    }
    public function set_membros($mb)
    {
        $this->membros = $mb;
    }
}
