<!DOCTYPE html>
<html>
<head lang="pt">
    <meta charset="UTF-8">
    <title>Página Inicial - Processo Seletivo</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
<div class="container">
    <h2>Página Inicial - Processo Seletivo</h2>

    <?php
    // Verifica se há uma mensagem de status na URL
    if (isset($_GET['status'])) {
        $status = $_GET['status'];
        if ($status === 'success') {
            echo '<p class="success-message">Cadastro realizado com sucesso!</p>';
        } elseif ($status === 'error') {
            echo '<p class="error-message">Algo deu errado. Tente novamente.</p>';
        }
    }
    ?>

    <div class="button-container">
        <a href="view/listar_cadastros.php"><button type="button">Abrir Registros</button></a>
        <a href="view/registrar.php"><button type="button">Registrar</button></a>
    </div>
</div>
</body>
</html>
