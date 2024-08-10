<?php
class ContaPJ extends ContaCorrente{
    protected $tipo = "PJ";
    private $cnpj;
    
    public function __construct($nome, $contaCorrente, $agencia, $tipo, $documento) {
        $this->nomeDoUser = $nome;
        $this->numeroDaCC = $contaCorrente;
        $this->agencia = $agencia;
        $this->tipo = $tipo;
        $this->cnpj = $documento;
    }

    public function getDocumento() {
        return $this->cnpj;
    }
}