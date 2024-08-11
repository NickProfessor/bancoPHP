<?php
    abstract class ContaCorrente {
        protected $nomeDoUser;
        protected $numeroDaCC;
        protected $agencia;
        protected $saldo = 0;
        protected $tipo;

        protected $documento;
        
        abstract public function __construct($nomeDoUser, $numeroDaCC, $agencia, $tipo, $documento);
        public function getNomeDoUser() {
            return $this->nomeDoUser;
        }
        public function getNumeroDaCC() {
            return $this->numeroDaCC;
        }
        public function getAgencia(){
            return $this->agencia;
        }
        public function getSaldo() {
            return $this->saldo;
        }

        public function getTipo() {
            return $this->tipo;
        }
        public function setSaldo($saldo) {
            $this->saldo = $saldo;
        }


        abstract public function getDocumento();
    }