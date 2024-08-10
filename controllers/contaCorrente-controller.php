<?php
    include"./models/contasCorrentes.php";
    include"./models/contaPF.php";
    include"./models/contaPJ.php";
    class ContaCorrenteController {
        private $contasCorrentes;

        public function __construct() {
            $this->contasCorrentes = new ContasCorrentes();
        }

        
        public function criaContaCorrente($nome, $numeroConta, $agencia, $tipo, $documento){
            if($tipo == "PF"){
            $conta = new ContaPF($nome,$numeroConta,$agencia, $tipo, $documento);
            $this->contasCorrentes->adicionaContaPF($conta);
            }else if($tipo == "PJ"){
                $conta = new ContaPJ($nome,$numeroConta,$agencia, $tipo, $documento);
                $this->contasCorrentes->adicionaContaPJ($conta);
            }else{
                echo "Conta precisa de um tipo";
                die();
            }
            echo "\n\tObrigado por se cadastrar, $nome!\n";
                $this->contasCorrentes->adicionaContaCorrente($conta);
                return $conta;

        }

        public function contasCorrentesCadastradas(){
            $lista = $this->contasCorrentes->listaDeContas()?? null;
            if(!$lista){
                echo "\t NENHUMA CONTA CADASTRADA\n";
            }
            $this->percorreALista($lista);
        }

        public function contasPFCadastradas(){
            $lista = $this->contasCorrentes->listaDeContasPF()?? null;
            if(!$lista){
                echo "\t NENHUMA CONTA PF CADASTRADA\n";
            }
            $this->percorreALista($lista);
        }

        public function contasPJCadastradas(){
            $lista = $this->contasCorrentes->listaDeContasPJ()?? null;
            if(!$lista){
                echo "\t NENHUMA CONTA PJ CADASTRADA\n";
            }
            $this->percorreALista($lista);
        }
        public  function dadosDaConta ($contaCorrente){
            echo "\tNome: ". $contaCorrente->getNomeDoUser()."\n";
            echo "\tConta corrente: ". $contaCorrente->getNumeroDaCC()."\n";
            echo "\tAgência: ". $contaCorrente->getAgencia()."\n";
            echo "\tSaldo: R$". $contaCorrente->getSaldo()."\n";
            echo "\tTipo: ". $contaCorrente->getTipo()."\n";
            if($contaCorrente->getTipo() == "PF"){
                echo "\tCPF: ". $contaCorrente->getDocumento()."\n";
            }else if($contaCorrente->getTipo() == "PJ"){
                echo "\tCNPJ: ". $contaCorrente->getDocumento()."\n";
            }
        }

        private function percorreALista($lista){
            foreach ($lista as $key => $conta) {
                echo"\n\t------ Conta ".($key + 1)." ------\n";
                $this->dadosDaConta($conta);
            }
        }
        
    }