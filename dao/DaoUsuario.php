<?php


/**
 * Description of DaoUsuario
 *
 * @author Diego
 */
class DaoUsuario implements IDao {
    
    //********************************************************
    public function excluir(Usuario $u) {
        $sql = "DELETE FROM usuario WHERE id=:ID";
        $conexao = Conexao::getConexao();
        $sth = $conexao->prepare($sql);
        $p1 = $u->getId();
        $sth->bindParam("ID", $p1);
        
        try {
            $sth->execute();
            return True;
        } catch (Exception $ex) {
            return $ex->getMessage();
        }
    }

    //********************************************************
    /**
     * 
     * @param int $p1
     * @return Usuario
     */
    public function listar($p1) {
        
        $sql = "SELECT id, nome, login, senha, status FROM usuario WHERE id=:ID";
        $conexao = Conexao::getConexao();
        $sth = $conexao->prepare($sql);
        $sth->bindParam("ID", $p1);
        
        try {
            $sth->execute();
        } catch (Exception $ex) {
            echo $ex->getMessage();
        }
        
        $usu =  $sth->fetchObject("Usuario");
         
        return $usu;
    }

    //********************************************************
    public function listarTodos() {
        $sql = "SELECT id, nome, login, senha, status FROM usuario";
        $conexao = Conexao::getConexao();
        $sth = $conexao->prepare($sql);
        try {
            $sth->execute();
        } catch (Exception $ex) {
            echo $ex->getMessage();
        }
        
        $arrUser = array();
        
        while($usu =  $sth->fetchObject("Usuario")){
            $arrUser[] = $usu;
        }
        return $arrUser;
    }

    //********************************************************
    public function salvar(Usuario $u) {
        $id = 0;
        $nome = $u->getNome();
        $login = $u->getLogin();
        $senha = $u->getSenha();
        $status = $u->getStatus();

        if ($u->getId()) {
            $id = $u->getId();
            $sql = "UPDATE usuario SET nome=:nome, login=:login, senha=:senha, status=:status WHERE id=:id";
        } else {
            $id = $this->generateID();
            $u->setId($id);
            $sql = "INSERT INTO usuario(id, nome, login, senha, status) VALUES"
                    . "(:id, :nome, :login, :senha, :status)";
        }

        $cnx = Conexao::getConexao();
        $sth = $cnx->prepare($sql);
        $sth->bindParam("id", $id);
        $sth->bindParam("nome", $nome);
        $sth->bindParam("login", $login);
        $sth->bindParam("senha", $senha);
        $sth->bindParam("status", $status);
        try {
            $sth->execute();
            return $u;
        } catch (Exception $ex) {
            return $ex->getMessage();
        }
    }
    
    //********************************************************
    private function generateID(){
        $sql = "SELECT (coalesce(max(id), 0)+1) as ID FROM usuario";
        $cnx = Conexao::getConexao();
        $sth = $cnx->prepare($sql);
        try {
            $sth->execute();
        } catch (Exception $ex) {
            return $ex->getMessage();
        }
        $res =  $sth->fetch();
        return $res['ID'];        
    }

    public function autenticar($login, $senha){
        $sql = "SELECT count(1) as U FROM usuario WHERE login=:LOGIN AND senha=:SENHA";
        $cnx = Conexao::getConexao();
        $sth = $cnx->prepare($sql);
        $sth->bindParam("LOGIN", $login);
        $sth->bindParam("SENHA", $senha);
        
        try{
            $sth->execute();
        } catch (Exception $ex) {
            return $ex->getMessage();
        }
        
        $res = $sth->fetch();
        $id = $res['U'];
        return $id > 0;  // se retornar >0 Verdadeiro
        
    }
}
