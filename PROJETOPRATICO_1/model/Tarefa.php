<?php
class Tarefa {
    private $id;
    private $titulo;
    private $descricao;
    private $dataPrazo;
    private $status;
    private $categoriaId;

    public function __construct($titulo, $descricao, $dataPrazo, $categoriaId, $status = false, $id = null) {
        $this->titulo = $titulo;
        $this->descricao = $descricao;
        $this->dataPrazo = $dataPrazo;
        $this->categoriaId = $categoriaId;
        $this->status = $status;
        $this->id = $id;
    }

    public function getId() { return $this->id; }
    public function getTitulo() { return $this->titulo; }
    public function getDescricao() { return $this->descricao; }
    public function getDataPrazo() { return $this->dataPrazo; }
    public function getStatus() { return $this->status; }
    public function getCategoriaId() { return $this->categoriaId; }
}