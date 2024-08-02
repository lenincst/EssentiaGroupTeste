<!DOCTYPE html>
<html>
<head lang="pt">
    <meta charset="UTF-8">
    <title>Registrar Cadastro</title>
    <link rel="stylesheet" href="../style.css">
    <script>
    document.addEventListener('DOMContentLoaded', function() {
        var telefoneInput = document.getElementById('telefone');
        
        telefoneInput.addEventListener('input', function() {
            var valor = telefoneInput.value;
            valor = valor.replace(/\D/g, ''); // Remove todos os caracteres não numéricos
            if (valor.length > 11) valor = valor.slice(0, 11); // Limita a 11 números
            valor = valor.replace(/(\d{2})(\d{1,4})(\d{1,4})/, '($1) $2-$3'); // Formata
            telefoneInput.value = valor;
        });
    });
    </script>
</head>
<body>
<div class="container">
    <h2>Registrar Cadastro</h2>

    <?php
    if (isset($_GET['status'])) {
        $status = $_GET['status'];
        if ($status === 'invalid_phone') {
            echo '<p class="error-message">Número de telefone inválido. Por favor, use o formato DD9XXXXXXXX.</p>';
        } elseif ($status === 'no_image_or_invalid_type') {
            echo '<p class="error-message">É obrigatório enviar uma imagem nos formatos JPG ou PNG.</p>';
        } elseif ($status === 'error') {
            echo '<p class="error-message">Algo deu errado ao registrar o cadastro. Tente novamente.</p>';
        }
    }
    ?>

    <form enctype="multipart/form-data" action="../controller/CadastroController.php" method="post">
        <div>
            <label for="nome">Nome</label>
            <input name="nome" type="text" id="nome" required />
        </div>
        <br>

        <div>
            <label for="email">E-mail</label>
            <input name="email" type="email" id="email" required />
        </div>
        <br>

        <div>
            <label for="telefone">Telefone</label>
            <input name="telefone" type="text" id="telefone" placeholder="(DD) 9XXXX-XXXX" required />
        </div>
        <br>

        <div>
            <label for="imagem">Imagem</label>
            <input name="imagem" type="file" id="imagem" accept="image/jpeg,image/png" required />
        </div>

        <p class="file-size-note">Fotos com no máximo 400 KB</p>
        <br>
        <button type="submit">Registrar</button>
    </form>

    <div class="back-button">
        <a href="../pagina_inicial.php"><button type="button">Voltar à Página Inicial</button></a>
    </div>
</div>
</body>
</html>
