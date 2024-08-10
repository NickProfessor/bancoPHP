<?php
    class ContasCorrentes{
    private $contasCorrentes = [];
    private $contasPF = [];
    private $contasPJ = [];

    public function adicionaContaCorrente($conta){
        $this->contasCorrentes[] = $conta;
    }

    public function adicionaContaPF($conta){
        $this->contasPF[] = $conta;
    }

    public function adicionaContaPJ($conta){
        $this->contasPJ[] = $conta;
    }

     public  function listaDeContas(){
        return $this->contasCorrentes;
    }

     public function listaDeContasPF(){
        return $this->contasPF;
    }

     public function listaDeContasPJ(){
        return $this->contasPJ;
    }
}