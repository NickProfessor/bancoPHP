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
            $contasExistentes = $this->contasCorrentes->listaDeContas();
            foreach ($contasExistentes as $contasCorrente) {
                if($contasCorrente->getNumeroDaCC() == $numeroConta){
                    echo "\n\t CONTA JÁ EXISTE!!";
                    return;
                }
            }
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
            echo "\n\t================================================\n";
            echo "\t|||||| Obrigado por se cadastrar, $nome |||||\n";
            echo "\t================================================\n";
                $this->contasCorrentes->adicionaContaCorrente($conta);

        }

        public function acessarUmaConta($numeroDaConta, $agencia){
            $lista = $this->contasCorrentes->listaDeContas();
            $conta = null;
            foreach($lista as $key => $value) {
                if($value->getNumeroDaCC() == $numeroDaConta 
                && $value->getAgencia() == $agencia) {
                    global $conta;
                     $conta = $value;
                     break;
                }
            }
            return $conta;
        }

        public function sacarDinheiro($conta, $valor){
            $lista = $this->contasCorrentes->listaDeContas();
            foreach($lista as $key => $value) {
                if($value == $conta) {
                    $novoSaldo = $value->getSaldo() - $valor;
                    $value->setSaldo($novoSaldo);
                     break;
                }
            }

        }

        public function depositarDinheiro($conta, $valor){
            $lista = $this->contasCorrentes->listaDeContas();
            foreach($lista as $key => $value) {
                if($value == $conta) {
                    $novoSaldo = $value->getSaldo() + $valor;
                    $value->setSaldo($novoSaldo);
                     break;
                }
            }

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