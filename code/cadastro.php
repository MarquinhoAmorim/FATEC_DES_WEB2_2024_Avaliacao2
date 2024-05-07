<?php
require('classes.php');
require('dados_banco.php');
 
$validador = new Login();
$validador->verificar_logado();

$conexao = new Database($servername, $username, $password, $dbname);

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (empty($_POST['nome']) || empty($_POST['curso'])) {
        echo "Por favor, preencha todos os campos.";
    } else {
        $nome = $_POST['nome'];
        $curso = $_POST['curso'];

        $conexao->insert($nome, $curso);
    }
}
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Novo Candidato</title>
</head>
<body>
    <h1>Novo Candidato</h1>

    <form method="post">
        <label for="nome">Nome Completo: </label>
        <input type="text" name="nome" placeholder="Nome Completo">

        <p></p>

        <label for="curso">Curso: </label> 

        <select name="curso" id="curso"> 
        <option value="" selected>Selecione o Curso...</option>
        <option value="1">Desenvolvimento de Software Multiplataforma</option>
        <option value="2">Gestão Empresarial</option>
        </select>

        <p></p>

        <input type="submit" value="Cadastrar">

    </form>
</body>
</html>