<?php
class Carro {
    private $id;
    private $modelo;
    private $placa;

    public function __construct($modelo, $placa, $id = null) {
        $this->modelo = $modelo;
        $this->placa = $placa;
        $this->id = $id;
    }

    public function getId() { return $this->id; }
    public function getModelo() { return $this->modelo; }
    public function getPlaca() { return $this->placa; }
}