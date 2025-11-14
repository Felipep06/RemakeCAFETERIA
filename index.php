<?php
// --------------------------
// PROCESSAMENTO DO FORMULÁRIO
// --------------------------

$carrinhoMensagem = "";

if ($_SERVER["REQUEST_METHOD"] === "POST") {

    $produto = $_POST["produto"] ?? "Produto não identificado";

    // opções comuns
    $acucar = $_POST["acucar"] ?? "Não informado";
    $leite = $_POST["tipo-leite"] ?? null;

    // porções (muffin, cookies, pão de queijo)
    $porcao = $_POST["porcao"] ?? null;

    // Montagem da mensagem
    $carrinhoMensagem = "<div class='msg-carrinho'>";

    $carrinhoMensagem .= "<strong>$produto</strong> foi adicionado ao carrinho!<br>";

    if ($acucar !== "Não informado") {
        $carrinhoMensagem .= "Açúcar: $acucar<br>";
    }
    if ($leite) {
        $carrinhoMensagem .= "Leite: $leite<br>";
    }
    if ($porcao) {
        $carrinhoMensagem .= "Porção escolhida: $porcao unidades<br>";
    }

    $carrinhoMensagem .= "</div>";
}
?>