<?php

include 'infra/connect.php';
$sql = "SELECT * FROM animais";
$resultado = mysqli_query($conn, $sql);

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $dono_id = $_POST['dono'] ?? null;

    if ($dono_id) {
        $sql = "SELECT * FROM animais WHERE id_dono = ?";
        $stmt = mysqli_prepare($conn, $sql);
        mysqli_stmt_bind_param($stmt, 'i', $dono_id);
        mysqli_stmt_execute($stmt);
        $resultado = mysqli_stmt_get_result($stmt);
    } else {
        $sql = "SELECT * FROM animais";
        $resultado = mysqli_query($conn, $sql);
    }
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gerenciador de animais</title>
    <link rel="stylesheet" href="styles/style.css">
</head>

<body>
    <main>
        <h1>Gerenciador de animais</h1>
        <a href="public/cad_animal.php"> Novo animal</a>
        <a href="public/cad_user.php"> Novo Usuário</a>
        <br>
        <br>
        <form method="POST">
            <label for="dono">Filtro por Dono</label>
            <select id="dono" name="dono">
                <option value="">Todos</option>
                <?php
                $sqlDonos = "SELECT * FROM donos";
                $resultadoDonos = mysqli_query($conn, $sqlDonos);
                while ($dono = mysqli_fetch_assoc($resultadoDonos)) {
                    echo "<option value='{$dono['id']}'>{$dono['nome']}</option>";
                }

                ?>
            </select>
            <button type="submit">Filtrar</button>
            <br>
            <br>
        </form>
        <table>
            <thead>
                <tr>
                    <th>Nome</th>
                    <th>Raça</th>
                    <th>Descrição</th>
                    <th>Idade</th>
                    <th>Porte</th>
                    <th>ID do Dono</th>
                    <th>Ações</th>
                </tr>
            </thead>
            <tbody>
                <?php

                while ($animal = mysqli_fetch_assoc($resultado)) {
                    echo "<tr>";
                    echo "<td>{$animal['nome']}</td>";
                    echo "<td>{$animal['raca']}</td>";
                    echo "<td>{$animal['descricao']}</td>";
                    echo "<td>{$animal['idade']}</td>";
                    echo "<td>{$animal['porte']}</td>";
                    echo "<td>{$animal['id_dono']}</td>";
                    echo "<td>
                            <a href='public/editar_animal.php?id={$animal['id']}'>Editar</a> |
                            <a href='public/excluir_animal.php?id={$animal['id']}'>Excluir</a>
                          </td>";
                    echo "</tr>";
                }
                ?>
            </tbody>
        </table>
    </main>


</body>

</html>