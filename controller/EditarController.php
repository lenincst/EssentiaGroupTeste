<?php
require_once '../model/Cadastro.php';

class EditarController {
    public function editar() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $id = $_POST['id'];
            $nome = $_POST['nome'];
            $email = $_POST['email'];
            $telefone = $_POST['telefone'];
            $imagem = isset($_FILES['imagem']['tmp_name']) ? $_FILES['imagem']['tmp_name'] : null;
            $tipoImagem = isset($_FILES['imagem']['type']) ? $_FILES['imagem']['type'] : null;

            $cadastro = new Cadastro($nome, $email, $telefone, $imagem, $tipoImagem);
            $cadastro->setId($id);

            $validacao = $cadastro->validar();

            if ($validacao === true) {
                if ($cadastro->atualizar()) {
                    header('Location: ../view/listar_cadastros.php?status=success');
                } else {
                    header('Location: ../view/editar.php?id=' . $id . '&status=error');
                }
            } else {
                header('Location: ../view/editar.php?id=' . $id . '&status=' . urlencode($validacao));
            }
        }
    }
}

if (basename($_SERVER['PHP_SELF']) === 'EditarController.php') {
    $controller = new EditarController();
    $controller->editar();
}
?>
