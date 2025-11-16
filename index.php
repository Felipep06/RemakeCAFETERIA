<?php
session_start();


if (!isset($_SESSION["carrinho"])) {
    $_SESSION["carrinho"] = [];
}


if (isset($_POST["acao"]) && $_POST["acao"] === "adicionar") {
    
    $produto = $_POST["produto"] ?? "";
    $preco   = isset($_POST["preco"]) ? floatval($_POST["preco"]) : 0;
    $quantidade = isset($_POST["quantidade"]) ? intval($_POST["quantidade"]) : 1;

    $acucar  = $_POST["acucar"]     ?? "";
    $leite   = $_POST["tipo-leite"] ?? "";
    $porcao  = $_POST["porcao"]     ?? "";

    $_SESSION["carrinho"][] = [
        "produto"    => $produto,
        "preco"      => $preco,
        "quantidade" => $quantidade,
        "acucar"     => $acucar,
        "leite"      => $leite,
        "porcao"     => $porcao
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

$pedido_finalizado = null;

if (isset($_POST["acao"]) && $_POST["acao"] === "finalizar") {

    $nome     = $_POST["nome"]     ?? "";
    $telefone = $_POST["telefone"] ?? "";
    $endereco = $_POST["endereco"] ?? "";

    $total = 0;

    foreach ($_SESSION["carrinho"] as $item) {
        $subtotal = $item["preco"] * $item["quantidade"];
        $total += $subtotal;
    }

    $pedido_finalizado = [
        "cliente" => [
            "nome" => $nome,
            "telefone" => $telefone,
            "endereco" => $endereco
        ],
        "pedido" => $_SESSION["carrinho"],
        "total" => $total
    ];

    $_SESSION["carrinho"] = [];
}

return [
    "carrinho" => $_SESSION["carrinho"],
    "pedido_finalizado" => $pedido_finalizado
];
?>
