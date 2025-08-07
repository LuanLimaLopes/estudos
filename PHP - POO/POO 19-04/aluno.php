<?php

require_once('pessoa.php');

class aluno extends pessoa
{

    private $matr;
    private $curso;

    public function cancel_matr()
    {
        echo "<p>Matrícula cancelada</p>";
    }

    public function get_matr()
    {
        return $this->matr;
    }
    public function set_matr($m)
    {
        $this->matr = $m;
    }

    public function get_curso()
    {
        return $this->curso;
    }
    public function set_curso($c)
    {
        $this->curso = $c;
    }
}
