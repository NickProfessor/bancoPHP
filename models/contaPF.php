<?php
include"./models/contaCorrente.php";
class ContaPF extends ContaCorrente{
    protected $tipo = "PF";
    private $cpf;

    public function __construct($nome, $contaCorrente, $agencia, $tipo, $documento) {
        $this->nomeDoUser = $nome;
        $this->numeroDaCC = $contaCorrente;
        $this->agencia = $agencia;
        $this->tipo = $tipo;
        $this->cpf = $documento;
    }

    public function getDocumento(){
        return $this->cpf;
    }
}