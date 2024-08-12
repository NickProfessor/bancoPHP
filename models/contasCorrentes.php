<?php
    class ContasCorrentes{
    private array $contasCorrentes = [];
    private array $contasPF = [];
    private array $contasPJ = [];

    public function adicionaContaCorrente(ContaCorrente $conta): void{
        $this->contasCorrentes[] = $conta;
    }

    public function adicionaContaPF(ContaCorrente $conta): void{
        $this->contasPF[] = $conta;
    }

    public function adicionaContaPJ(ContaCorrente $conta): void{
        $this->contasPJ[] = $conta;
    }

     public  function listaDeContas(): array{
        return $this->contasCorrentes;
    }

     public function listaDeContasPF(): array{
        return $this->contasPF;
    }

     public function listaDeContasPJ(): array{
        return $this->contasPJ;
    }
}