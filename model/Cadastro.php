<?php
require_once 'Conexao.php';

class Cadastro {
    private $id;
    private $nome;
    private $email;
    private $telefone;
    private $imagem;
    private $tipoImagem;

    public function __construct($nome, $email, $telefone, $imagem, $tipoImagem) {
        $this->nome = $nome;
        $this->email = $email;
        $this->telefone = $telefone;
        $this->imagem = $imagem;
        $this->tipoImagem = $tipoImagem;
    }

    public function validar() {
        if (empty($this->nome) || empty($this->email) || empty($this->telefone) || empty($this->imagem)) {
            return 'Todos os campos são obrigatórios.';
        }

        if (!filter_var($this->email, FILTER_VALIDATE_EMAIL)) {
            return 'E-mail inválido.';
        }

        $telefoneNumeros = preg_replace('/\D/', '', $this->telefone);
        if (strlen($telefoneNumeros) != 11) {
            return 'Telefone inválido. O número deve ter exatamente 11 dígitos.';
        }

        $tiposPermitidos = ['image/jpeg', 'image/png'];
        if (!in_array($this->tipoImagem, $tiposPermitidos)) {
            return 'A imagem deve ser nos formatos JPG ou PNG.';
        }

        return true;
    }

    public function salvar() {
        $conexao = Conexao::getConexao();
        $query = "INSERT INTO cadastros (nome, email, telefone, imagem) VALUES (?, ?, ?, ?)";
        $stmt = $conexao->prepare($query);

        if ($stmt === false) {
            return false;
        }

        $imagem = file_get_contents($this->imagem);
        $stmt->bind_param('ssss', $this->nome, $this->email, $this->telefone, $imagem);

        $resultado = $stmt->execute();
        $stmt->close();
        $conexao->close();

        return $resultado;
    }

    public function setId($id) {
        $this->id = $id;
    }

    public function atualizar() {
        $conexao = Conexao::getConexao();
        $query = "UPDATE cadastros SET nome = ?, email = ?, telefone = ?, imagem = ? WHERE id = ?";
        $stmt = $conexao->prepare($query);

        if ($stmt === false) {
            return false;
        }

        $imagemBase64 = !empty($this->imagem) ? base64_encode(file_get_contents($this->imagem)) : null;
        $stmt->bind_param('ssssi', $this->nome, $this->email, $this->telefone, $imagemBase64, $this->id);

        $resultado = $stmt->execute();
        $stmt->close();
        $conexao->close();

        return $resultado;
    }

    public function excluir() {
        $conexao = Conexao::getConexao();
        $query = "DELETE FROM cadastros WHERE id = ?";
        $stmt = $conexao->prepare($query);

        if ($stmt === false) {
            return false;
        }

        $stmt->bind_param('i', $this->id);

        $resultado = $stmt->execute();
        $stmt->close();
        $conexao->close();

        return $resultado;
    }
}
?>
