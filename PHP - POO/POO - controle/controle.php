<?php
require_once 'icontrolador.php';

class controle implements icontrolador
{
    // Atributos
    private $volume;
    private $ligado;
    private $tocando;

    // metodo construtor
    function __construct()
    {
        $this->volume = 50;
        $this->ligado = false;
        $this->tocando = false;
    }

    // Metodo especiais
    public function getVolume()
    {
        return $this->volume;
    }

    public function setVolume($v)
    {
        $this->volume = $v;
    }

    public function getligado()
    {
        return $this->ligado;
    }

    public function setligado($l)
    {
        $this->ligado = $l;
    }

    public function getTocando()
    {
        return $this->tocando;
    }

    public function setTocando($t)
    {
        $this->tocando = $t;
    }

    public function ligar()
    {
        $this->setligado(l: true);
    }

    public function desligar()
    {
        $this->setligado(l: false);
    }

    public function abrirMenu()
    {
        $volume = "";
        for ($v = 0; $v < $this->getVolume(); $v = $v + 10) {
            $volume .= "| ";
        }
        echo "<p>Status: " . ($this->getligado() ? "Ligado" : "Desligado") . "</p>";
        echo "<p>Volume:  {$this->getVolume()} = {$volume}</p>";
        echo "<p>Tocando: " . ($this->getTocando() ? "Sim" : "Mudo") . "</p>";
    }
    public function fecharMenu()
    {
        echo "<p>Fechar Menu. </p>";
    }
    public function maisVolume()
    {
        if ($this->getligado()) {
            $this->setVolume(v: $this->getVolume() + 5);
        }
    }
    public function menosVolume()
    {
        if ($this->getligado()) {
            $this->setVolume(v: $this->getVolume() - 5);
        }
    }

    public function ligarMudo()
    {
        if ($this->getLigado() && $this->getVolume() > 0) {
            $this->setVolume(v: 0);
        }
    }

    public function desligarMudo()
    {
        if ($this->getLigado() && $this->getVolume() == 0) {
            $this->setVolume(v: 50);
        }
    }

    public function play()
    {
        if ($this->getLigado() && $this->getTocando()) {
            $this->setTocando(t: true);
        }
    }

    public function pause()
    {
        if ($this->getLigado() && $this->getTocando()) {
            $this->SetTocando(t: false);
        }
    }
}
