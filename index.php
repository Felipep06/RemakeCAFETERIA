<?php
// ---------------------------------------------
// PROCESSAMENTO DO FORMULÁRIO
// ---------------------------------------------
$carrinhoMensagem = "";

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $produto = $_POST["produto"] ?? "Produto não identificado";
    $acucar = $_POST["acucar"] ?? null;
    $leite = $_POST["tipo-leite"] ?? null;
    $porcao = $_POST["porcao"] ?? null;

    $carrinhoMensagem = "<div style='
        background:#333;
        color:white;
        padding:15px;
        margin:20px;
        border-radius:10px;
        text-align:center;
        border:2px solid #fff;
        font-size:18px;
    '>";

    $carrinhoMensagem .= "<strong>$produto</strong> foi adicionado ao carrinho!<br>";

    if ($acucar) $carrinhoMensagem .= "Açúcar: $acucar<br>";
    if ($leite) $carrinhoMensagem .= "Leite: $leite<br>";
    if ($porcao) $carrinhoMensagem .= "Porção escolhida: $porcao unidades<br>";

    $carrinhoMensagem .= "</div>";
}
?>