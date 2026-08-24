<?php

include '../infra/connect.php';
if (!isset($conn) || $conn === null) {
    die('Erro ao conectar com o banco de dados.');
}

$id = isset($_GET['id']) ? (int) $_GET['id'] : 0;

$sql = "SELECT * FROM animal WHERE id = ?";
$stmt = mysqli_prepare($conn, $sql);
mysqli_stmt_bind_param($stmt, 'i', $id);
mysqli_stmt_execute($stmt);
$resultadoAnimal = mysqli_stmt_get_result($stmt);
$animal = mysqli_fetch_assoc($resultadoAnimal);

if (!$animal) {
    die('animal não encontrado.');
}

$sql = "SELECT * FROM usuarios";
$resultado = mysqli_query($conn, $sql);

if ($resultado === false) {
    die('Erro ao consultar usuários: ' . mysqli_error($conn));
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nome = trim($_POST['nome']);
    $descricao = trim($_POST['descricao']);
    $preco = $_POST['preco'];
    $categoria = trim($_POST['categoria']);
    $usuario_id = (int) $_POST['usuario'];

    $sql = "UPDATE pratos SET nome = ?, descricao = ?, preco = ?, categoria = ?, id_usuario = ? WHERE id = ?";
    $stmt = mysqli_prepare($conn, $sql);
    mysqli_stmt_bind_param($stmt, 'ssdsi', $nome, $descricao, $preco, $categoria, $usuario_id, $id);

    if (mysqli_stmt_execute($stmt)) {
        echo "animal atualizado com sucesso!";
        echo "<br><a href='../index.php'>Voltar</a>";
        exit();
    } else {
        echo "Erro ao atualizar animal: " . mysqli_error($conn);
    }
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar animal</title>
    <link rel="stylesheet" href="../styles/style.css">
</head>

<body>
    <form method="POST">

        <label for="nome">Nome:</label>
        <input type="text" name="nome" id="nome" value="<?php echo htmlspecialchars($cachorro['nome']); ?>" required>
        <label for="raca">Raça:</label>
        <input type="text" name="raca" id="raca" value="<?php echo htmlspecialchars($cachorro['raca']); ?>" required>
        <label for="descricao">Descrição:</label>
        <input type="text" name="descricao" id="descricao" value="<?php echo htmlspecialchars($cachorro['descricao']); ?>" required>
        <label for="idade">Idade:</label>
        <input type="number" name="idade" id="idade" value="<?php echo htmlspecialchars($cachorro['idade']); ?>" required>
        <label for="porte">Porte:</label>
        <input type="text" name="porte" id="porte" value="<?php echo htmlspecialchars($cachorro['porte']); ?>" required>
        <label for="dono">Dono:</label>
        <select name="dono" id="dono" required>
            <option value="">Selecione um dono</option>
            <?php
            while ($row = mysqli_fetch_assoc($resultado)) {
                $selected = ($row['id'] == $prato['id_usuario']) ? 'selected' : '';
                echo "<option value='{$row['id']}' {$selected}>{$row['nome']}</option>";
            }
            ?>
        </select>
        <button type="submit">Atualizar animal</button>
    </form>
    <button type="button" onclick="window.location.href='../index.php'">Voltar</button>

</body>

</html>