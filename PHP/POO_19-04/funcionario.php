<?php

require_once('pessoa.php');

class funcionario extends pessoa
{

    private  $trabalho;
    private  $setor;

    public function mudar_trabalho()
    {
        $this->trabalho = !$this->trabalho;
    }

    public function get_trabalho()
    {
        return $this->trabalho;
    }
    public function set_trabalho($t)
    {
        $this->trabalho = $t;
    }

    public function get_setor()
    {
        return $this->setor;
    }
    public function set_setor($s)
    {
        $this->setor = $s;
    }
}
