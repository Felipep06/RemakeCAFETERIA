<?php
session_start();
require_once "conexao.php";

// Remover item
if (isset($_GET["remove"])) {
    $id = intval($_GET["remove"]);
    if (isset($_SESSION["carrinho"][$id])) {
        unset($_SESSION["carrinho"][$id]);
        $_SESSION["carrinho"] = array_values($_SESSION["carrinho"]);
    }
}

// Finalizar compra
if (isset($_POST["finalizar"])) {
    if (empty($_SESSION["carrinho"])) {
        echo "<script>alert('Carrinho vazio!');</script>";
    } else {
        $total = 0;
        foreach ($_SESSION["carrinho"] as $item) {
            $total += floatval($item["preco"]);
        }

        $stmt = $pdo->prepare("INSERT INTO pedidos (total) VALUES (:total)");
        $stmt->bindValue(":total", $total);
        $stmt->execute();
        $pedido_id = $pdo->lastInsertId();

        foreach ($_SESSION["carrinho"] as $item) {
            $stmt2 = $pdo->prepare("INSERT INTO itens_pedido (pedido_id, produto, preco, opcao)
                                   VALUES (:pedido_id, :produto, :preco, :opcao)");
            $stmt2->execute([
                ":pedido_id" => $pedido_id,
                ":produto" => $item["nome"],
                ":preco" => $item["preco"],
                ":opcao" => $item["opcao"]
            ]);
        }

        unset($_SESSION["carrinho"]);
        echo "<script>alert('Pedido finalizado com sucesso!'); window.location='index.php';</script>";
    }
}
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
<meta charset="UTF-8">
<title>Carrinho de Compras</title>
<link rel="stylesheet" href="style.css">
</head>
<body>

<h2 style="text-align:center; margin-top:120px;">🛒 Seu Carrinho</h2>

<div style="max-width:800px; margin:20px auto;background:#fff8f0;padding:20px;border-radius:10px;">

<table width="100%">
<tr>
    <th>Produto</th>
    <th>Opção</th>
    <th>Preço</th>
    <th>Ação</th>
</tr>

<?php if (!empty($_SESSION["carrinho"])): ?>
<?php 
$total = 0;
foreach ($_SESSION["carrinho"] as $i => $item): 
    $total += floatval($item["preco"]);
?>
<tr style="text-align:center;">
    <td><?= $item["nome"]; ?></td>
    <td><?= $item["opcao"]; ?></td>
    <td>R$ <?= number_format($item["preco"], 2, ",", "."); ?></td>
    <td><a href="carrinho.php?remove=<?= $i ?>" style="color:red;">❌ Remover</a></td>
</tr>
<?php endforeach; ?>

</table>
<hr>
<h3 style="text-align:right;">Total: 
    <strong>R$ <?= number_format($total, 2, ",", ".") ?></strong>
</h3>

<form method="POST">
    <button type="submit" name="finalizar" class="botao-carrinho"
        style="width:100%; margin-top:10px;">Finalizar Compra</button>
</form>

<?php else: ?>
<p style="text-align:center;color:saddlebrown;">Carrinho vazio 🥲</p>
<?php endif; ?>
</div>

</body>
</html>
