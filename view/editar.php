<?php
require_once '../model/Cadastro.php';
require_once '../model/Conexao.php';

$id = $_GET['id'];

$conexao = Conexao::getConexao();
$query = "SELECT nome, email, telefone, imagem FROM cadastros WHERE id = ?";
$stmt = $conexao->prepare($query);
$stmt->bind_param("i", $id);
$stmt->execute();
$stmt->store_result();
$stmt->bind_result($nome, $email, $telefone, $imagem);
$stmt->fetch();
$stmt->close();
$conexao->close();
?>

<!DOCTYPE html>
<html>
<head lang="pt">
    <meta charset="UTF-8">
    <title>Editar Cadastro</title>
    <link rel="stylesheet" href="../style.css">
</head>
<body>
<div class="container">
    <h2>Editar Cadastro</h2>

    <?php
    if (isset($_GET['status'])) {
        $status = $_GET['status'];
        if ($status === 'success') {
            echo '<p class="success-message">Registro atualizado com sucesso!</p>';
        } elseif ($status === 'error') {
            echo '<p class="error-message">Algo deu errado ao atualizar o registro. Tente novamente.</p>';
        } elseif (isset($_GET['status'])) {
            echo '<p class="error-message">' . htmlspecialchars($_GET['status']) . '</p>';
        }
    }
    ?>

    <form enctype="multipart/form-data" action="../controller/EditarController.php" method="post">
        <input type="hidden" name="id" value="<?php echo htmlspecialchars($id); ?>" />

        <div>
            <label for="nome">Nome</label>
            <input name="nome" type="text" id="nome" value="<?php echo htmlspecialchars($nome); ?>" required />
        </div>
        <br>

        <div>
            <label for="email">E-mail</label>
            <input name="email" type="email" id="email" value="<?php echo htmlspecialchars($email); ?>" required />
        </div>
        <br>

        <div>
            <label for="telefone">Telefone</label>
            <input name="telefone" type="text" id="telefone" value="<?php echo htmlspecialchars($telefone); ?>" required />
        </div>
        <br>

        <div>
            <label for="imagem">Imagem</label>
            <input name="imagem" type="file" id="imagem" accept="image/jpeg,image/png" />
            <?php if (!empty($imagem)) { ?>
                <img src="data:image/png;base64,<?php echo base64_encode($imagem); ?>" alt="Imagem Atual" class="image-preview" />
            <?php } ?>
        </div>
        <br>

        <div>
            <input type="submit" value="Salvar"/>
        </div>
    </form>

    <div class="back-button">
        <a href="../view/listar_cadastros.php"><button type="button">Voltar à Listagem</button></a>
    </div>
</div>
</body>
</html>
