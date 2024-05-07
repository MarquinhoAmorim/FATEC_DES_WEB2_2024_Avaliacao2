<?php
require('classes.php');
require('dados_banco.php');

$validador = new Login();
$validador->verificar_logado();

$conexao = new Database($servername, $username, $password, $dbname);
$candidatos = $conexao->select();
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Cadastro do Vestibular</title>
</head>
<body>
    <center>
        <h2>Cadastro do Vestibular</h2>
    </center>

    <h2>Candidatos</h2>

    <table>
            <tr>
                <th>ID</th>
                <th style="text-align: left;">Nome</th>
                <th>Curso</th>
            </tr>
            <?php foreach ($candidatos as $candidato): ?>
                <tr>
                    <td><?php echo $candidato['id']; ?></td>
                    <td><?php echo $candidato['nome']; ?></td>
                    <td style="text-align: center;"><?php echo $candidato['curso']; ?></td>
                </tr>
            <?php endforeach; ?>
    </table>
    
    <br>
    
    <button>
        <a href="login.php">Logout</a>
    </button>
    <button>
        <a href="cadastro.php">Novo Candidato</a>
    </button>
    
</body>
</html>