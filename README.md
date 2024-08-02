Claro, aqui está o conteúdo em formato Markdown (.md):

```markdown
# ProjetoCadastroNew

## Descrição

Este projeto é uma aplicação web desenvolvida em PHP, seguindo os conceitos de Orientação a Objetos, DRY e S.O.L.I.D. O código utiliza a arquitetura MVC (Model-View-Controller) e foi estruturado para ser executado localmente com o XAMPP.

## Requisitos

- PHP 7.0 ou superior
- XAMPP (inclui Apache e MySQL)

## Configuração e Execução

### 1. Verifique a versão do PHP

Certifique-se de que você tenha PHP 7.0 ou superior instalado no seu sistema. Você pode verificar a versão do PHP com o seguinte comando:

```bash
php -v
```

### 2. Instale o XAMPP

Baixe e instale o XAMPP a partir do [site oficial](https://www.apachefriends.org/index.html). O XAMPP inclui o servidor Apache e MySQL, que são necessários para executar o projeto.

### 3. Configure o XAMPP

- Inicie o XAMPP e certifique-se de que o Apache e o MySQL estão em execução.
- Configure o MySQL para usar a porta 3307, se necessário. Caso contrário, ajuste a porta no arquivo de configuração do banco de dados.

### 4. Configure as credenciais do banco de dados

Localize o arquivo `model/Conexao.php` no seu projeto e atualize as credenciais do banco de dados conforme necessário:

```php
<?php
class Conexao {
    private static $conexao;

    public static function getConexao() {
        if (self::$conexao == null) {
            $host = "localhost";
            $username = "root";
            $password = "@D2vveaax"; // Atualize se necessário
            $dbname = "banco_projeto";
            $port = 3307; // Certifique-se de que esta porta está correta

            self::$conexao = new mysqli($host, $username, $password, $dbname, $port);
            if (self::$conexao->connect_error) {
                die("Falha na conexão: " . self::$conexao->connect_error);
            }
        }
        return self::$conexao;
    }
}
?>
```

### 5. Importe o banco de dados

1. Abra o phpMyAdmin acessível através do XAMPP (geralmente em `http://localhost/phpmyadmin`).
2. Crie um novo banco de dados chamado `banco_projeto`.
3. Selecione o banco de dados criado e vá para a aba "Importar".
4. Selecione o arquivo `database/banco_projeto.sql` localizado na pasta `database` do projeto.
5. Clique em "Executar" para importar o banco de dados.

### 6. Execute o projeto

Depois de configurar o banco de dados e atualizar as credenciais, você pode acessar o projeto localmente através do navegador. Vá para:

```
http://localhost/projetocadastronew
```

## Estrutura do Projeto

O projeto está estruturado da seguinte maneira:

```
ProjetoCadastroNew/
├── controller/
│   ├── CadastroController.php
│   ├── EditarController.php
│   └── ExcluirController.php
├── model/
│   ├── Cadastro.php
│   ├── Conexao.php
├── view/
│   ├── editar.php
│   ├── exclusao.php
│   ├── listar_cadastros.php
│   └── registrar.php
├── index.php
├── style.css
└── database/
    └── banco_projeto.sql
```

- **controller/**: Contém os arquivos PHP responsáveis pela lógica de controle e manipulação dos dados.
- **model/**: Contém as classes de modelo, incluindo a classe de conexão com o banco de dados.
- **view/**: Contém os arquivos de visualização (HTML e PHP) que apresentam os dados ao usuário.
- **index.php**: O ponto de entrada principal da aplicação.
- **style.css**: Arquivo de estilos CSS para a aplicação.
- **database/banco_projeto.sql**: Script SQL para criar e popular o banco de dados.

## Observações

- Certifique-se de que a porta do MySQL no XAMPP está configurada para 3307, conforme definido no arquivo `Conexao.php`. Caso contrário, atualize a porta no arquivo de configuração do banco de dados.
- O arquivo `database/banco_projeto.sql` deve ser importado no phpMyAdmin para que o banco de dados esteja pronto para uso.
```

Você pode copiar e colar esse conteúdo em um arquivo chamado `README.md` para documentar o seu projeto.