<div class="container">
<?php

$id = "";
$nome = "";
$login = "";
$senha = "";
$status = "";


echo "Formulario Usuario";
$usuario = $this->getDados("Usuarios");
if($usuario){
    $usuario instanceof Usuario;
    $id = $usuario->getId();
    $nome = $usuario->getNome();
    $login = $usuario->getLogin();
    $senha = $usuario->getSenha();
    $status = $usuario->getStatus();
}

?>


<form method="post" action="<?php echo URL; ?>controle-usuario/salvar">
    <label>ID</label><br>
    <input class="form-control" type="text" readonly="true" value="<?php echo $id; ?>" name="id">
    <br><br>
   
    <label>Nome</label><br>
    <input  class="form-control"  type="text"  value="<?php echo $nome; ?>" name="nome">
    <br><br>
    
    <label>Login</label><br>
    <input class="form-control"  type="text" value="<?php echo $login; ?>" name="login">
    <br><br>
    
    <label>SENHA</label><br>
    <input class="form-control"  type="password" value="<?php echo $senha; ?>" name="senha">
    <br><br>
    
    <label>Status</label><br>
    <select class="form-control" name="status">
        <option value="A" <?php if($status == 'A'){echo 'selected="true"'; }?> >Ativo</option>
        <option value="I" <?php if($status == 'I'){echo 'selected="true"'; }?>>Inativo</option>
    </select>
    <br><br>
    
    <input type="submit" value="Salvar" class="btn btn-default">
    
    <a href="<?php echo URL; ?>controle-usuario/lista-de-usuario">Voltar</a>
    
</form>
</div>