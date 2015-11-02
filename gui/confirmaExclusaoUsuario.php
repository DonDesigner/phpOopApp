<h3>Deseja realmente excluir o usuário 
    <?php
    $usu = $this->getDados("Usuario");
    if ($usu instanceof Usuario) {
        echo $usu->getNome();
    }
    ?>
</h3>
<form method="post" action="<?php echo URL; ?>controle-usuario/confirmar-exclusao">
    <input type="hidden" name="id" value="<?php
    if ($usu instanceof Usuario) {
        echo $usu->getId();
    }
    ?>">
    <input type="submit" value="Sim">
</form>
<a href="<?php echo URL; ?>controle-usuario/lista-de-usuario">Não</a>

