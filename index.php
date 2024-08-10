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
                    Banco::criarContaCorrente($controller);
                    break;
                case "2":
                    Banco::consultarContasCriadas($controller);
                    break;
                case "3";
                    die();
                default:
                Banco::template(404);
                Banco::operacoes($controller);
            }
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
                echo "\n\t Pressione qualquer tecla...";
                Banco::lerEntrada();
                Banco::operacoes($controller);
            }else if($operacao == "2"){
                echo "\t------ TODAS AS CONTAS PF CADASTRADAS ------\n";
                $controller->contasPFCadastradas();
                echo "\n\t Pressione qualquer tecla...";
                Banco::lerEntrada();
                Banco::operacoes($controller);
            }else if($operacao == "3"){
                echo "\t------ TODAS AS CONTAS PJ CADASTRADAS ------\n";
                $controller->contasPJCadastradas();
                echo "\n\t Pressione qualquer tecla...";
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
                    echo"\t1-> Criar conta corrente\n";
                    echo"\t2-> Consultar contas criadas\n";
                    echo"\t3-> Encerrar\n";
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