<?php
class Agendamento {
    private $id;
    private $motivo;
    private $descricao;
    private $dataUso;
    private $status;
    private $carroId;

    public function __construct($motivo, $descricao, $dataUso, $carroId, $status = false, $id = null) {
        $this->motivo = $motivo;
        $this->descricao = $descricao;
        $this->dataUso = $dataUso;
        $this->carroId = $carroId;
        $this->status = $status;
        $this->id = $id;
    }

    public function getId() { return $this->id; }
    public function getMotivo() { return $this->motivo; }
    public function getDescricao() { return $this->descricao; }
    public function getDataUso() { return $this->dataUso; }
    public function getStatus() { return $this->status; }
    public function getCarroId() { return $this->carroId; }
}