<?php


/**
 * Description of Login
 *
 * @author Diego
 */
class Login {
    
    public function autenticar(){
        $v = new TGui("formularioDeLogin");
        $v->renderizar();
    }
    
    public function confirmarAutenticacao(){
        $login = isset($_POST['login']) ? $_POST['login'] : FALSE;
        $senha = isset($_POST['senha']) ? $_POST['senha'] : FALSE;
        
        if(!$login || !$senha){
            echo "Login e senha devem ser informados!";
            return FALSE;
        }
        
        $du = new DaoUsuario();
        $res = $du->autenticar($login, $senha);
        if($res){
           
            session_start();
            $_SESSION['usuario'] = "autenticar";
            header("location: " . URL );
        } else {
           
            session_start();
            session_destroy();
            header("location: " . URL);
        }
        
    }
    
    public function logout(){
        session_start();
        session_destroy();
        header("location: " . URL);
        
    }
}
