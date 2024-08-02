<?php
require_once '../model/Cadastro.php';

class CadastroController {
    public function registrar() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $nome = $_POST['nome'];
            $email = $_POST['email'];
            $telefone = $_POST['telefone'];
            $imagem = $_FILES['imagem']['tmp_name'];
            $tipoImagem = $_FILES['imagem']['type'];

            $cadastro = new Cadastro($nome, $email, $telefone, $imagem, $tipoImagem);
            $validacao = $cadastro->validar();

            if ($validacao === true) {
                if ($cadastro->salvar()) {
                    header('Location: ../pagina_inicial.php?status=success');
                } else {
                    header('Location: ../view/registrar.php?status=error');
                }
            } else {
                header("Location: ../view/registrar.php?status=" . urlencode($validacao));
            }
        }
    }
}

if (basename($_SERVER['PHP_SELF']) === 'CadastroController.php') {
    $controller = new CadastroController();
    $controller->registrar();
}
?>
