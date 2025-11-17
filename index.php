<?php
session_start();

if (!isset($_SESSION["carrinho"])) {
    $_SESSION["carrinho"] = [];
}


if ($_SERVER["REQUEST_METHOD"] === "POST" && isset($_POST["acao"]) && $_POST["acao"] === "adicionar") {

    $produto = $_POST["produto"];
    $preco = floatval($_POST["preco"]);
    $opcao1 = $_POST["opcao1"] ?? "";
    $opcao2 = $_POST["opcao2"] ?? "";
    $select = $_POST["select"] ?? "";
    $quantidade = intval($_POST["quantidade"] ?? 1);

    $_SESSION["carrinho"][] = [
        "produto" => $produto,
        "preco" => $preco,
        "opcao1" => $opcao1,
        "opcao2" => $opcao2,
        "select" => $select,
        "quantidade" => $quantidade
    ];
}

if (isset($_GET["remover"])) {
    $id = intval($_GET["remover"]);
    unset($_SESSION["carrinho"][$id]);
    $_SESSION["carrinho"] = array_values($_SESSION["carrinho"]);
}

if (isset($_GET["limpar"])) {
    $_SESSION["carrinho"] = [];
}

$resumo = null;

if ($_SERVER["REQUEST_METHOD"] === "POST" && isset($_POST["acao"]) && $_POST["acao"] === "finalizar") {

    $nome = $_POST["nome"];
    $telefone = $_POST["telefone"];
    $endereco = $_POST["endereco"];

    $total = 0;

    foreach ($_SESSION["carrinho"] as $item) {
        $total += $item["preco"] * $item["quantidade"];
    }

    $resumo = [
        "cliente" => [
            "nome" => $nome,
            "telefone" => $telefone,
            "endereco" => $endereco
        ],
        "itens" => $_SESSION["carrinho"],
        "total" => $total
    ];

    $_SESSION["carrinho"] = [];
}
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Carrinho</title>
    <link rel="stylesheet" href="style (1).css">
</head>
<body>

<header class="header">
    <section>
        <a href="index (1).html" class="navegacao" style="color:white;">← Voltar ao Menu</a>
        <a href="?limpar=1" style="color:white;background:red;padding:8px;border-radius:8px;">Limpar carrinho</a>
    </section>
</header>

<main style="margin-top:140px">

<h2 style="text-align:center;color:saddlebrown;">Carrinho</h2>

<?php if (empty($_SESSION["carrinho"])): ?>
    <p style="text-align:center;color:saddlebrown;">Carrinho está vazio.</p>

<?php else: ?>
    <?php foreach ($_SESSION["carrinho"] as $i => $item): ?>
        <div style="background:white;padding:15px;margin:10px auto;border-radius:10px;max-width:600px;color:saddlebrown;">
            <b><?= $item["produto"] ?></b><br>
            R$ <?= number_format($item["preco"],2,",",".") ?><br>
            Quantidade: <?= $item["quantidade"] ?><br>
            Opção 1: <?= $item["opcao1"] ?><br>
            Opção 2: <?= $item["opcao2"] ?><br>
            Seleção: <?= $item["select"] ?><br>
            <a href="?remover=<?= $i ?>" style="color:red;font-weight:bold;">Remover</a>
        </div>
    <?php endforeach; ?>

    <form method="POST" style="background:white;padding:20px;max-width:600px;margin:20px auto;border-radius:10px;">
        <input type="hidden" name="acao" value="finalizar">

        <h3 style="color:saddlebrown;">Finalizar Pedido</h3>

        Nome:<br>
        <input type="text" name="nome" required><br><br>

        Telefone:<br>
        <input type="text" name="telefone" required><br><br>

        Endereço:<br>
        <input type="text" name="endereco" required><br><br>

        <button class="botao-carrinho">Finalizar Pedido</button>
    </form>

<?php endif; ?>

<?php if ($resumo): ?>
    <div style="background:white;padding:20px;margin:20px auto;border-radius:10px;max-width:600px;color:saddlebrown;">
        <h3>Resumo</h3>

        <p><b>Cliente:</b> <?= $resumo["cliente"]["nome"] ?></p>
        <p><b>Telefone:</b> <?= $resumo["cliente"]["telefone"] ?></p>
        <p><b>Endereço:</b> <?= $resumo["cliente"]["endereco"] ?></p>

        <h4>Itens:</h4>
        <ul>
            <?php foreach ($resumo["itens"] as $item): ?>
                <li><?= $item["produto"] ?> — R$ <?= number_format($item["preco"],2,",",".") ?> x <?= $item["quantidade"] ?></li>
            <?php endforeach; ?>
        </ul>

        <p><b>Total:</b> R$ <?= number_format($resumo["total"],2,",",".") ?></p>
    </div>
<?php endif; ?>

</main>

</body>
</html>