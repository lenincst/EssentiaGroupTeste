<?php
require_once '../model/Cadastro.php';

class ExcluirController {
    public function excluir() {
        if (isset($_GET['id'])) {
            $id = $_GET['id'];
            $cadastro = new Cadastro('', '', '', null, null);
            $cadastro->setId($id);

            if ($cadastro->excluir()) {
                header('Location: ../view/listar_cadastros.php?status=success');
            } else {
                header('Location: ../view/listar_cadastros.php?status=error');
            }
        } else {
            header('Location: ../view/listar_cadastros.php?status=error');
        }
    }
}

if (basename($_SERVER['PHP_SELF']) === 'ExcluirController.php') {
    $controller = new ExcluirController();
    $controller->excluir();
}
?>
