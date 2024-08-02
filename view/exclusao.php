<?php
require_once '../model/Cadastro.php'; // Ajuste o caminho conforme a estrutura do seu projeto

// Verifica se o ID está presente na URL
if (isset($_GET['id']) && is_numeric($_GET['id'])) {
    $id = intval($_GET['id']);

    // Cria uma instância do objeto Cadastro e define o ID
    $cadastro = new Cadastro('', '', '', '', '');
    $cadastro->setId($id);

    // Executa a exclusão
    if ($cadastro->excluir()) {
        echo 'Cadastro excluído com sucesso!';
    } else {
        echo 'Erro ao excluir o cadastro.';
    }

    // Redireciona para a página de listagem após a exclusão
    header('Location: listar_cadastros.php');
    exit;
} else {
    echo 'ID inválido.';
}
?>
