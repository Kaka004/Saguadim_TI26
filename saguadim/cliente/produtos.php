<?php
include('cabecalho_do_cliente.php');

$sql = "SELECT pro_nome, pro_quantidade, pro_preco, pro_id FROM produtos WHERE pro_status = 's'";
$retorno = mysqli_query($link, $sql);

if ($_SERVER["REQUEST_METHOD"] == 'POST') {
    $ativo = $_POST['ativo'];
    if ($ativo == 's') {
        $sql = "SELECT pro_nome, pro_quantidade, pro_preco, pro_id FROM produtos WHERE pro_status = 's'";
        $retorno = mysqli_query($link, $sql);
    } elseif ($ativo == "todos") {
        $sql = "SELECT pro_nome, pro_quantidade, pro_preco, pro_id FROM produtos";
        $retorno = mysqli_query($link, $sql);
    } else {
        $sql = "SELECT pro_nome, pro_quantidade, pro_preco, pro_id FROM produtos WHERE pro_status = 'n'";
        $retorno = mysqli_query($link, $sql);
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="home.css">
    <title>LISTA PRODUTOS</title>
</head>
<body>
    <div class='container'>
        <table border="2">
            <tr>
                <th>NOME</th>
                <th>QUANTIDADE</th>
                <th>PREÇO</th>
                <th>COMPRA</th>
            </tr>
            <!-- TRAZENDO DADOS DA TABELA -->
            <?php
            while ($tbl = mysqli_fetch_array($retorno)) {
            ?>
                <tr>
                    <td><?= $tbl['pro_nome'] ?></td>
                    <td><?= $tbl['pro_quantidade'] ?></td>
                    <td><?= number_format($tbl['pro_preco'], 2, ',', '.') ?></td>
                    <td><a href="selecionar_quantidade.php?id=<?= $tbl['pro_id'] ?>" onclick="mostrarAlerta()"><input type="button" value="ADICIONAR"></a></td>
                </tr>
            <?php
            }
            ?>
        </table>
    </div>
    <script>
        function mostrarAlerta(){
            alert("Selecione quantos você quer");
        }
    </script>
</body>
</html>
