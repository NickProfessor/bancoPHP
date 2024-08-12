<?php
include"./models/contaCorrente.php";
class ContaPF extends ContaCorrente{
    protected string $tipo = "PF";
    private string $cpf;

    public function __construct(string $nome, int $contaCorrente, int $agencia, string $tipo, string $documento) {
        $this->nomeDoUser = $nome;
        $this->numeroDaCC = $contaCorrente;
        $this->agencia = $agencia;
        $this->tipo = $tipo;
        $this->cpf = $documento;
    }

    public function getDocumento(): string{
        return $this->cpf;
    }
}