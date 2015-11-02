<?php

/**
 * Description of ControleUsuario
 *
 * @author Diego
 */
class ControleUsuario implements IPrivateTO {

    //***********************************************************
    public function listaDeUsuario() {
        $du = new DaoUsuario();
        $usuarios = $du->listarTodos();
        $v = new TGui("listaDeUsuarios");
        $v->addDados("Usuarios", $usuarios);
        $v->renderizar();
    }

    //***********************************************************
    public function editar($id) {
        $p1 = $id[2];
        $du = new DaoUsuario();
        $u = $du->listar($p1);
        $v = new TGui("formularioUsuario");
        $v->addDados("Usuarios", $u);
        $v->renderizar();
    }

    //***********************************************************
    public function novo() {
        $u = new Usuario();
        $v = new TGui("formularioUsuario");
        $v->addDados("Usuario", $u);
        $v->renderizar();
    }

    //***********************************************************
    public function salvar() {
        $u = new Usuario();
        $id = isset($_POST['id']) ? $_POST['id'] : FALSE;
        if(trim($id) != ""){
            $u->setId($id);
        }
        
        $nome = isset($_POST['nome']) ? $_POST['nome'] : FALSE;
        if(!$nome || trim($nome) == ""){
            throw new Exception("O campo NOME é obrigatório!");
        }
        
        $login= isset($_POST['login']) ? $_POST['login'] : FALSE;
        if(!$login || trim($login) == ""){
            throw new Exception("O campo LOGIN é obrigatório!");
        }
        
        $senha = isset($_POST['senha']) ? $_POST['senha'] : FALSE;
        if(!$senha || trim($senha) == ""){
            throw new Exception("O campo SENHA é obrigatório!");
        }
        
        $status = isset($_POST['status']) ? $_POST['status'] : FALSE;
        if(!$status || trim($status) == ""){
            throw new Exception("O campo STATUS é obrigatório!");
        }
        
        $u->setNome($nome);
        $u->setLogin($login);
        $u->setSenha($senha);
        $u->setStatus($status);
             
        $du = new DaoUsuario();
        $usu = $du->salvar($u);
        
        if($usu instanceof Usuario){
            header("location: " . URL . "controle-usuario/lista-de-usuario");
        } else  {
            echo "Não foi possivel salvar o USUÁRIO!!";
        }
    }

    //***********************************************************
    public function excluir($id) {
       $p1 = $id[2];
       $du = new DaoUsuario();
       $u = $du->listar($p1);
       $v = new TGui("confirmaExclusaoUsuario");
       $v->addDados("Usuario", $u);
       $v->renderizar();
    }

    //***********************************************************
    public function confirmarExclusao() {
        $id = isset($_POST['id']) ? $_POST['id'] : FALSE;
        if($id){
            $du = new DaoUsuario();
            $u = $du->listar($id);
            if($du->excluir($u)){
                header("location: " . URL . "controle-usuario/lista-de-usuario");
            }else{
                echo "Não foi possivel excluir o registro!";
            }
        } else {
            header("location: " . URL . "controle-usuario/lista-de-usuario");
        }
    }

}
