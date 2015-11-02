


        <div class="container">




            <a class="btn btn-danger" href="<?php echo URL; ?>login/logout/"><i class="glyphicon glyphicon-log-out"></i> Logout</a>
            <a class="btn btn-primary"  href="<?php echo URL; ?>controle-usuario/novo/"><i class="glyphicon glyphicon-plus"></i> Novo Usuário</a>


            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>NOME</th>
                        <th>CONTROLES</th>
                    </tr>
                <tbody>

                    <?php
                    if ($this->getDados('Usuarios')) {
                        $ar = $this->getDados('Usuarios');
                        foreach ($ar as $usuario) {
                            $usuario instanceof Usuario;
                            echo "<tr>";
                            echo "<td>{$usuario->getId()}</td>";
                            echo "<td>{$usuario->getNome()}</td>";
                            echo "<td> <a class='glyphicon glyphicon-pencil' href=" . URL . "controle-usuario/editar/" . $usuario->getId() . ">Edi</a>";
                            echo " -  <a class='glyphicon glyphicon-remove' href=" . URL . "controle-usuario/excluir/" . $usuario->getId() . ">Exc</a> </td>";
                            echo "</tr>";
                        }
                    }
                    ?>
               