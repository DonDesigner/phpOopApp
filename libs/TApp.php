<?php

/**
 * Description of TApp
 * Criar uma URL amigavel!!
 * @author Diego
 */
class TApp {

    private $to;
    private $method;
    private $params;

    public function __construct() {
        $url = isset($_GET['url']) ? $_GET['url'] : false;

        //Caso haja barras no final da URL devemos tira-las
        $url = rtrim($url, "/");

        if ($url) {
            $arr = explode("/", $url);

            //************************************************************
            if (isset($arr[0])) {
                $to = strtolower($arr[0]);
                $to = explode('-', $to);
                $strTo = '';
                //em Classes a 1º letra de cada palavra deve ser maiuscula
                //exemplo: cadastro-de-pessoas => CadastroDePessoas
                foreach ($to as $k => $v) {
                    $strTo .= strtoupper(substr($v, 0, 1)) . substr($v, 1);
                }
                $this->to = $strTo;
            }

            //************************************************************
            if (isset($arr[1])) {
                $mt = strtolower($arr[1]);
                $mt = explode('-', $mt);
                $strMt = '';
                
                foreach ($mt as $k => $v) {
                    //em métodos a 1º letra é minusculas    
                    //exemplo: listar-por-codigo => listarPorCodigo
                    if ($k === 0) {
                         $strMt .= $v;
                    } else {
                         $strMt .= strtoupper(substr($v, 0, 1)) . substr($v, 1);
                    }
                }
                $this->method =  $strMt;
            }

            //Limpar o $arr  //assim o que sobrar nos arr 
            //serão os parametros
            unset($arr[0]);
            unset($arr[1]);
            $this->params = $arr;
            
        } else {
            $this->to = "ControleUsuario";
            $this->method = "listaDeUsuario";
            $this->params = null;
        }
    }

    public function executar() {
        //---verifica se TO  éxiste com classe
        //vamos tentar instancialo
        if (class_exists($this->to)) {

            try {
                $c = new $this->to();
                if($c instanceof IPrivateTO){
                    session_start();
                    if(!$_SESSION['usuario']){
                        header("location: " . URL . "login/autenticar");
                    }
                }
                
                //--- verifica se o método existe
                if (method_exists($c, $this->method)) {

                    //---verifica se existem parametros
                    if ($this->params !== null) {
                        $c->{$this->method}($this->params);
                    } else {
                        $c->{$this->method}();
                    }
                } else {
                    //tratar erro
                }
            } catch (Exception $ex) {
                echo $ex->getTraceAsString();
            }
        } else {
            //Tratar erros
        }
    }

}
