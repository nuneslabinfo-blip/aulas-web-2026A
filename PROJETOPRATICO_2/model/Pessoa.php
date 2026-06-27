<?php
class Pessoa {
    private $id;
    private $nome;
    private $cpf;
    private $cep;
    private $logradouro;
    private $bairro;
    private $cidade;
    private $estado;

    public function __construct($nome, $cpf, $cep, $logradouro, $bairro, $cidade, $estado, $id = null) {
        $this->nome = $nome;
        $this->cpf = $cpf;
        $this->cep = $cep;
        $this->logradouro = $logradouro;
        $this->bairro = $bairro;
        $this->cidade = $cidade;
        $this->estado = $estado;
        $this->id = $id;
    }

    public function getId() { return $this->id; }
    public function getNome() { return $this->nome; }
    public function getCpf() { return $this->cpf; }
    public function getCep() { return $this->cep; }
    public function getLogradouro() { return $this->logradouro; }
    public function getBairro() { return $this->bairro; }
    public function getCidade() { return $this->cidade; }
    public function getEstado() { return $this->estado; }
}