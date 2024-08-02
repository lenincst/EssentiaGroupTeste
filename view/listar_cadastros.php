<?php
require_once '../model/Conexao.php';

$conexao = Conexao::getConexao();

$querySelecao = "SELECT id, nome, email, telefone, imagem FROM cadastros";
$resultado = $conexao->query($querySelecao);
?>

<!DOCTYPE html>
<html>
<head lang="pt">
    <meta charset="UTF-8">
    <title>Listagem de Cadastros</title>
    <link rel="stylesheet" href="../style.css">
</head>
<body>
<div class="container">
    <h2>Lista de Cadastros</h2>

    <table border="1" class="data-table">
        <tr>
            <td align="center">Nome e Imagem</td>
            <td align="center">E-mail</td>
            <td align="center">Telefone</td>
            <td align="center">Editar</td>
            <td align="center">Excluir</td>
        </tr>
        <?php
        if ($resultado->num_rows > 0) {
            while ($cadastro = $resultado->fetch_assoc()) { ?>
                <tr>
                    <td align="center">
                        <div class="name-image">
                            <?php if (!empty($cadastro['imagem'])) { ?>
                                <img src="data:image/png;base64,<?php echo base64_encode($cadastro['imagem']); ?>" alt="Imagem" class="image-preview-mini">
                            <?php } else { ?>
                                <img src="../placeholder.png" alt="Imagem" class="image-preview-mini">
                            <?php } ?>
                            <span><?php echo htmlspecialchars($cadastro['nome']); ?></span>
                        </div>
                    </td>
                    <td align="center"><?php echo htmlspecialchars($cadastro['email']); ?></td>
                    <td align="center"><?php echo htmlspecialchars($cadastro['telefone']); ?></td>
                    <td align="center">
                        <a href="../view/editar.php?id=<?php echo $cadastro['id']; ?>">Editar</a>
                    </td>
                    <td align="center">
                        <a href="../view/exclusao.php?id=<?php echo $cadastro['id']; ?>" onclick="return confirm('Tem certeza que deseja excluir este cadastro?');">Excluir</a>
                    </td>
                </tr>
            <?php }
        } else {
            echo '<tr><td colspan="5" align="center">Nenhum registro encontrado.</td></tr>';
        }
        ?>
    </table>

    <div class="back-button">
        <a href="../pagina_inicial.php"><button type="button">Voltar à Página Inicial</button></a>
    </div>
</div>
</body>
</html>
