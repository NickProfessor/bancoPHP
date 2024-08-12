<?php
class ContaPJ extends ContaCorrente{
    protected string $tipo = "PJ";
    private string $cnpj;
    
    public function __construct(string $nome, int $contaCorrente, int $agencia, string $tipo, string $documento) {
        $this->nomeDoUser = $nome;
        $this->numeroDaCC = $contaCorrente;
        $this->agencia = $agencia;
        $this->tipo = $tipo;
        $this->cnpj = $documento;
    }

    public function getDocumento(): string {
        return $this->cnpj;
    }
}