<?php
    abstract class ContaCorrente {
        protected string $nomeDoUser;
        protected int $numeroDaCC;
        protected int $agencia;
        protected float $saldo = 0;
        protected string $tipo;

        protected string $documento;
        
        abstract public function __construct(string $nomeDoUser, int $numeroDaCC, int $agencia, string $tipo, string $documento);
        public function getNomeDoUser(): string {
            return $this->nomeDoUser;
        }
        public function getNumeroDaCC(): int {
            return $this->numeroDaCC;
        }
        public function getAgencia(): int {
            return $this->agencia;
        }
        public function getSaldo(): float {
            return $this->saldo;
        }

        public function getTipo(): string {
            return $this->tipo;
        }
        public function setSaldo($saldo): void {
            $this->saldo = $saldo;
        }


        abstract public function getDocumento(): string;
    }