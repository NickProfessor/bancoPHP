<?php
    include"./controllers/contaCorrente-controller.php";
    class Banco {
        public static  function main (){
            $controller = new ContaCorrenteController();
            echo "\n\nSeja bem-vindo(a) ao Banco PHP!\n\n";
                Banco::operacoes($controller);
              
        }

        public static function operacoes ($controller) {
            echo"\n\tQue operação deseja fazer hoje?\n";
            Banco::template(1);
            $operacao = Banco::lerEntrada();
            switch ($operacao){
                case "1":
                    Banco::acessarContaCorrente($controller);
                case "2": 
                    Banco::criarContaCorrente($controller);
                    break;
                case "3":
                    Banco::consultarContasCriadas($controller);
                    break;
                case "4";
                    die();
                default:
                Banco::template(404);
                Banco::operacoes($controller);
            }
        }

        public static function acessarContaCorrente($controller){
            echo "\t------ ACESSAR CONTA CORRENTE ------\n ";
            echo "\n\t1. Informe o numero da sua conta: ";
            $numeroConta = Banco::lerEntrada();
            echo "\n\t2. Informe o numero da sua agência: ";
            $agencia = Banco::lerEntrada();
            $conta = $controller->acessarUmaConta($numeroConta, $agencia);
            if($conta){
                Banco::operacoesContaCorrente($conta, $controller);
            }else{
                echo "Conta não existe!";
                Banco::operacoes($controller);
            }    
        }

        public static function operacoesContaCorrente($conta, $controller){
            echo "\t------ O QUE DESEJA ".$conta->getNomeDoUser()."? ------\n";
            Banco::template("4");
            $operacao = Banco::lerEntrada();
            while($operacao != "1" && $operacao != "2" && $operacao != "3" && $operacao != "4") {
                Banco::template(404);
                Banco::template(4);
                $operacao = Banco::lerEntrada();
            }
            if($operacao == "1"){
                echo "\t------ SACAR DINHEIRO ------\n ";
                echo "\n\tInforme o valor do saque: ";
                $saque = Banco::lerEntrada();
                $saque = floatval($saque);
                if($saque > $conta->getSaldo()){
                    echo "\n\t############################\n";
                    echo "\t#### SALDO INSUFICUENTE ####\n";
                    echo "\t############################\n";
                    Banco::operacoesContaCorrente($conta, $controller);
                }else if($saque <= 0 || !is_numeric($saque)){
                    echo "\n\t############################\n";
                    echo "\t#### VALOR INVÁLIDO ########\n";
                    echo "\t############################\n";
                    Banco::operacoesContaCorrente($conta, $controller);
                }else{
                    $controller->sacarDinheiro($conta, $saque);
                    echo "\n\t===========================\n";
                    echo "\t|||||| SAQUE REALIZADO |||||\n";
                    echo "\t============================\n";
                }
            }
            else if($operacao == "2"){
                echo "\t------ DEPOSITAR DINHEIRO ------\n ";
                echo "\n\tInforme o valor do deposito: ";
                $deposito = Banco::lerEntrada();
                $deposito = floatval($deposito);
                if($deposito <= 0 || !is_numeric($deposito)){
                    echo "\n\t############################\n";
                    echo "\t#### VALOR INVÁLIDO ########\n";
                    echo "\t############################\n";
                    Banco::operacoesContaCorrente($conta, $controller);
                }else{
                    $controller->depositarDinheiro($conta, $deposito);
                    echo "\n\t==============================\n";
                    echo "\t|||||| DEPOSITO REALIZADO |||||\n";
                    echo "\t===============================\n";
                }
            }
            else if($operacao == "3"){
                echo "\t------ CONSULTAR DADOS ------\n ";
                $controller->dadosDaConta($conta);
                echo "\t\n Pressione enter...";
                Banco::lerEntrada();
                Banco::operacoesContaCorrente($conta, $controller);
            }
            else if($operacao == "4"){
                Banco::operacoes($controller);
            }
            Banco::operacoesContaCorrente($conta, $controller);
        }
        public static function criarContaCorrente ($controller) {
            Banco::template(2);
            $operacao = Banco::lerEntrada();
            while($operacao != "1" && $operacao != "2" && $operacao != "3") {
                Banco::template(404);
                Banco::template(2);
                $operacao = Banco::lerEntrada();
            }
            if($operacao == "1"){
                echo "\t------ CONTA CORRENTE PF ------\n ";
                echo "\n\tInforme seu nome: ";
                $nome = Banco::lerEntrada();
                echo "\n\tInforme seu conta: ";
                $conta = Banco::lerEntrada();
                echo "\n\tInforme seu agencia: ";
                $agencia = Banco::lerEntrada();
                echo "\n\tInforme seu CPF: ";
                $cpf = Banco::lerEntrada();
                $controller->criaContaCorrente($nome, $conta, $agencia, "PF", $cpf);
            }else if($operacao == "2"){
                echo "\t------ CONTA CORRENTE PJ ------\n";
                echo "\n\tInforme seu nome: ";
                $nome = Banco::lerEntrada();
                echo "\n\tInforme seu conta: ";
                $conta = Banco::lerEntrada();
                echo "\n\tInforme seu agencia: ";
                $agencia = Banco::lerEntrada();
                echo "\n\tInforme seu CNPJ: ";
                $cnpj = Banco::lerEntrada();
                $controller->criaContaCorrente($nome, $conta, $agencia, "PJ", $cnpj);
            }else if($operacao == "3"){
                Banco::operacoes($controller);
            }
            Banco::operacoes($controller);
        }

        public static function consultarContasCriadas($controller){
            Banco::template(3);
            $operacao = Banco::lerEntrada();
            while($operacao != "1" && $operacao != "2"&& $operacao != "3" && $operacao != "4"){
                Banco::template(404);
                Banco::template(3);
                $operacao = Banco::lerEntrada();
            }
            if($operacao == "1"){
                echo "\t------ TODAS AS CONTAS CADASTRADAS ------\n";
                $controller->contasCorrentesCadastradas();
                echo "\n\t Pressione enter...";
                Banco::lerEntrada();
                Banco::operacoes($controller);
            }else if($operacao == "2"){
                echo "\t------ TODAS AS CONTAS PF CADASTRADAS ------\n";
                $controller->contasPFCadastradas();
                echo "\n\t Pressione enter...";
                Banco::lerEntrada();
                Banco::operacoes($controller);
            }else if($operacao == "3"){
                echo "\t------ TODAS AS CONTAS PJ CADASTRADAS ------\n";
                $controller->contasPJCadastradas();
                echo "\n\t Pressione enter...";
                Banco::lerEntrada();
                Banco::operacoes($controller);
            }else if($operacao == "4"){
                Banco::operacoes($controller);
            }
        }

        public static function template($tipo){
            switch ($tipo){
                case "1": 
                    echo"\t------ OPÇÕES ------\n";
                    echo"\t1-> Acessar sua conta corrente\n";
                    echo"\t2-> Criar conta corrente\n";
                    echo"\t3-> Consultar contas criadas\n";
                    echo"\t4-> Encerrar\n";
                    break;
                case "2":
                    echo "\t------ CRIAR CONTA CORRENTE ------\n";
                    echo "\tSelecione uma opção:\n\n";
                    echo "\t1-> Conta PF (pessoa fisica)\n";
                    echo "\t2-> Conta PJ (pessoa jurídica)\n";
                    echo "\t3-> Voltar para página inicial\n";
                    break;
                case "3":
                    echo "\t------ CONSULTAR CONTAS EXISTENTES ------\n";
                    echo "\t1-> Todas\n";
                    echo "\t2-> Conta PF (pessoa fisica)\n";
                    echo "\t3-> Conta PJ (pessoa jurídica)\n";
                    echo "\t4-> Voltar para página inicial\n";
                    break;
                case "4":
                    echo "\t1-> Sacar dinheiro\n";
                    echo "\t2-> Depositar dinheiro \n";
                    echo "\t3-> Consultar dados \n";
                    echo "\t4-> Voltar para página inicial\n";
                    break;
                case "404":
                    echo "\t#######################\n";
                    echo "\t#### AÇÃO INVÁLIDA ####\n";
                    echo "\t#######################\n";
            }
        }

        public static function lerEntrada () {
            return trim(fgets(STDIN));
        }
    }
    Banco::main();