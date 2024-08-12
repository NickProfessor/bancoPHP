<?php
    include"./controllers/contaCorrente-controller.php";
    class Banco {
        public static  function main (): void{
            $controller = new ContaCorrenteController();
            echo "\n\nSeja bem-vindo(a) ao Banco PHP!\n\n";
                Banco::operacoes($controller);
              
        }

        public static function operacoes (ContaCorrenteController $controller):void {
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

        public static function acessarContaCorrente(ContaCorrenteController $controller): void{
            echo "\t------ ACESSAR CONTA CORRENTE ------\n ";
            echo "\n\t1. Informe o numero da sua conta: ";
            $numeroConta = Banco::lerEntrada();
            echo "\n\t2. Informe o numero da sua agência: ";
            $agencia = Banco::lerEntrada();
            $conta = $controller->acessarUmaConta($numeroConta, $agencia);
            if($conta){
                echo "\n\t================================================\n";
                echo "\t|||||| Seja bem-vindo, ".$conta->getNomeDoUser()." |||||\n";
                echo "\t================================================\n";
                Banco::operacoesContaCorrente($conta, $controller);
            }else{
                echo "\n\t###########################\n";
                echo "\t#### CONTA NÃO EXISTE #####\n";
                echo "\t###########################\n";
                Banco::operacoes($controller);
            }    
        }

        public static function operacoesContaCorrente(ContaCorrente $conta, ContaCorrenteController $controller): void{
            echo "\t------ O QUE DESEJA? ------\n";
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
                    echo "\t============================\n\n";
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
        public static function criarContaCorrente (ContaCorrenteController $controller): void {
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
                while(!Banco::cpfValido($cpf)) {
                    echo "\n\tDigite um CPF válido: ";
                    $cpf = Banco::lerEntrada();
                }
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

        public static function consultarContasCriadas(ContaCorrenteController $controller): void{
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

        public static function template(string $tipo): void{
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

        public static function lerEntrada (): string {
            return trim(fgets(STDIN));
        }
        public static function cpfValido(string $cpf): bool{
            // Remove caracteres especiais (ponto e hífen)
            $cpf = preg_replace('/[^0-9]/', '', $cpf);

            // Verifica se o CPF tem 11 dígitos
            if (strlen($cpf) != 11) {
                return false;
            }

            // Verifica se todos os dígitos são iguais (ex: 111.111.111-11)
            if (preg_match('/(\d)\1{10}/', $cpf)) {
                return false;
            }

            // Calcula o primeiro dígito verificador
            for ($t = 9; $t < 11; $t++) {
                $d = 0;
                for ($c = 0; $c < $t; $c++) {
                    $d += $cpf[$c] * (($t + 1) - $c);
                }
                $d = ((10 * $d) % 11) % 10;
                if ($cpf[$c] != $d) {
                    return false;
                }
            }

            return true;
        }

        public static function cnpjValido(string $cnpj): bool {
            // Remove caracteres especiais (ponto, hífen e barra)
            $cnpj = preg_replace('/[^0-9]/', '', $cnpj);
        
            // Verifica se o CNPJ tem 14 dígitos
            if (strlen($cnpj) != 14) {
                return false;
            }
        
            // Verifica se todos os dígitos são iguais (ex: 11.111.111/1111-11)
            if (preg_match('/(\d)\1{13}/', $cnpj)) {
                return false;
            }
        
            // Cálculo do primeiro dígito verificador
            $multiplicadores1 = [5, 4, 3, 2, 9, 8, 7, 6, 5, 4, 3, 2];
            $soma = 0;
        
            for ($i = 0; $i < 12; $i++) {
                $soma += $cnpj[$i] * $multiplicadores1[$i];
            }
        
            $resto = $soma % 11;
            $digito1 = $resto < 2 ? 0 : 11 - $resto;
        
            // Cálculo do segundo dígito verificador
            $multiplicadores2 = [6, 5, 4, 3, 2, 9, 8, 7, 6, 5, 4, 3, 2];
            $soma = 0;
        
            for ($i = 0; $i < 13; $i++) {
                $soma += $cnpj[$i] * $multiplicadores2[$i];
            }
        
            $resto = $soma % 11;
            $digito2 = $resto < 2 ? 0 : 11 - $resto;
        
            // Verifica se os dígitos calculados são iguais aos fornecidos
            if ($cnpj[12] == $digito1 && $cnpj[13] == $digito2) {
                return true;
            }
        
            return false;
        }
    }
    Banco::main();