<?php
require_once('animal.php');

class mamifero extends animal
{

    private $cor_pelo;

    public function get_cor_pelo()
    {
        return $this->cor_pelo;
    }
    public function set_cor_pelo($cp)
    {
        $this->cor_pelo = $cp;
    }


    public function locomover()
    {
        echo "<p> anda por ai </p>";
    }
    public function emitir_som()
    {
        echo "<p> som de mamifero </p>";
    }
    public function alimentar()
    {
        echo "<p> mama muito </p>";
    }
}
