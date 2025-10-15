<?php
require_once('pessoa.php');

class professor extends pessoa
{

    private $especial;
    private $salario;

    public function aumento_salario($aum)
    {
        $this->salario += $aum;
    }

    public function get_especial()
    {
        return $this->especial;
    }
    public function set_especial($e)
    {
        $this->especial = $e;
    }

    public function get_salario()
    {
        return $this->salario;
    }
    public function set_salario($s)
    {
        $this->salario = $s;
    }
}
