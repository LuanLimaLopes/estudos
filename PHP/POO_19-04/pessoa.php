<?php
class pessoa
{
    private $nome;
    private $idade;
    private $genero;

    public function __construct()
    {
        $this->idade = 18;
    }

    public function fazerAniversario()
    {
        $this->idade++;
    }

    public function get_nome()
    {
        return $this->nome;
    }
    public function set_nome($n)
    {
        $this->nome = $n;
    }

    public function get_idade()
    {
        return $this->idade;
    }
    public function set_idade($i)
    {
        $this->idade = $i;
    }

    public function get_genero()
    {
        return $this->genero;
    }
    public function set_genero($g)
    {
        $this->genero = $g;
    }
}
