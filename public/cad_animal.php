<?php
include '../infra/connect.php';
if (!isset($conn) || $conn === null) {
    die('Erro ao conectar com o banco de dados.');
}
$sql = "SELECT * FROM donos";
$resultado = mysqli_query($conn, $sql);
if ($resultado === false) {
    die('Erro ao consultar donos: ' . mysqli_error($conn));
}
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nome = $_POST['nome'];
    $raca = $_POST['raca'];
    $descricao = $_POST['descricao'];
    $idade = $_POST['idade'];
    $porte = $_POST['porte'];
    $dono_id = $_POST['dono'];
    $sql = "INSERT INTO cachorros (nome, raca, descricao, idade, porte, id_dono) VALUES (?, ?, ?, ?, ?, ?)";
    $stmt = mysqli_prepare($conn, $sql);
    if ($stmt === false) {
        die('Erro ao preparar a inserção do cachorro: ' . mysqli_error($conn));
    }
    mysqli_stmt_bind_param($stmt, 'sssisi', $nome, $raca, $descricao, $idade, $porte, $dono_id);
    if (mysqli_stmt_execute($stmt)) {
        echo "Cachorro cadastrado com sucesso!";
        echo "<br><a href='../index.php'>Voltar</a>";
        exit();
    } else {
        echo "Erro ao cadastrar cachorro: " . mysqli_error($conn);
    }
    mysqli_stmt_close($stmt);
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cadastro de Cachorros</title>
    <link rel="stylesheet" href="../styles/style.css">
</head>
<body>
    <form method="POST">
        <label for="nome">Nome do Cachorro:</label>
        <input type="text" name="nome" id="nome" required>
        <br>
        <label for="raca">Raça:</label>
        <input type="text" name="raca" id="raca" required>
        <br>
        <label for="descricao">Descrição:</label>
        <textarea name="descricao" id="descricao" required></textarea>
        <br>
        <label for="idade">Idade:</label>
        <input type="number" name="idade" id="idade" required>
        <br>
        <label for="porte">Porte:</label>
        <input type="text" name="porte" id="porte" required>
        <br>
        <label for="dono">Dono:</label>
        <select name="dono" id="dono">
            <option value="">Selecione um Dono</option>
            <?php
            while ($dono = mysqli_fetch_assoc($resultado)) {
                echo "<option value='{$dono['id']}'>{$dono['nome']}</option>";
            }
            ?>
        </select>
        <br>
        <button type="submit">Cadastrar Cachorro</button>
    </form>
    <button type="button" onclick="window.location.href='../index.php'">Voltar</button>
</body>
</html>