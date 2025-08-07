<?php
require_once('animal.php');

class reptil extends animal
{
    private $cor_escama;

    public function get_cor_escama()
    {
        return $this->cor_escama;
    }
    public function set_cor_escama($ce)
    {
        $this->cor_escama = $ce;
    }

    public function locomover()
    {
        echo "<p> rasteja </p>";
    }
    public function emitir_som()
    {
        echo "<p> som de reptil </p>";
    }
    public function alimentar()
    {
        echo "<p> come vegetal </p>";
    }
}
