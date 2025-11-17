<?php
session_start();

if (!isset($_SESSION['carrinho'])) {
    $_SESSION['carrinho'] = [];
}

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['produto'])) {
    $produto = [
        "nome" => $_POST['produto'],
        "preco" => $_POST['preco'],
        "opcao" => $_POST['opcao'] ?? ""
    ];

    $_SESSION['carrinho'][] = $produto;
    header("Location: index.php?add=success");
}
?>
<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Escolha seu Café</title>
    <link rel="stylesheet" href="style.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Poppins:wght@200;300;400;500;600;700;800&display=swap"
        rel="stylesheet">
</head>

<body>
<header class="header">
    <section>
        <a href="#" class="logo">
            <img width="64" height="64" src="https://img.icons8.com/dusk/64/java-coffee-cup-logo.png"/>
        </a>
        <nav class="navegacao">
            <a href="#inicio">Início</a>
            <a href="#sobre">Sobre</a>
            <a href="#Menu">Menu</a>
            <a href="#avaliacao">Avaliação</a>
            <a href="#localizacao">Localização</a>
        </nav>
        <div class="icones">
            <a href="carrinho.php">
                🛒 (<?php echo count($_SESSION['carrinho']); ?>)
            </a>
        </div>
    </section>
</header>

<header>
    <div class="header-inner-content" id="sobre">
        <div class="header-button-side">
            <div class="header-button-side-left">
                <h2>Paixão , Experiência e Conexão através do Café!</h2>
                <p>Um espaço acolhedor onde o aroma de grãos torrados frescos
                    se mistura ao clima descontraído. Ambiente perfeito para pausas,
                    encontros ou trabalho, com atendimento que inspira conexões.</p>
            </div>
            <div class="header-button-side-right">
                <img src="—Pngtree—flying cup of coffee with_5057949.png">
            </div>
        </div>
    </div>
</header>

<main>
<div class="cor-de-fundo">
    <div class="page-inner-content">
        <div class="cols cols-3">
            <img src="...">
            <img src="...">
            <img src="...">
            <img src="...">
        </div>
    </div>
</div>

<div class="page-inner-content" id="Menu">
    <h3 class="section-title">Menu</h3>
    <div class="subtitle-underline"></div>
    
    <div class="cols cols-4">

        <?php
        $produtos = [
            ["Café Americano", "12.00"],
            ["Café Macchiato", "25.00"],
            ["Café Latte", "22.00"],
            ["Café Mocha", "19.00"],
            ["Café Cortado", "11.00"],
            ["Café Frappé", "19.00"],
            ["Dalgona Coffee", "28.50"],
            ["Café com Panna", "13.00"],
            ["Muffin", "2.00"],
            ["Cookies", "0.50"],
            ["Pão de Queijo", "19.00"],
        ];

        foreach ($produtos as $item) {
        ?>

        <div class="produto">
            <img src="https://picsum.photos/200?random=<?php echo rand(1,200)?>">
            <p class="produto-nome"><?php echo $item[0]; ?></p>
            <p class="nota">★★★★★</p>
            <p class="preco-produto"><?php echo $item[1]; ?> <span>R$</span></p>

            <form method="POST" class="opcoes-produto">
                <input type="hidden" name="produto" value="<?php echo $item[0]; ?>">
                <input type="hidden" name="preco" value="<?php echo $item[1]; ?>">

                <label><input type="checkbox" name="opcao" value="Com Açúcar"> Com açúcar</label>
                <label><input type="checkbox" name="opcao" value="Sem Açúcar"> Sem açúcar</label>

                <button type="submit" class="botao-carrinho">
                    Adicionar ao carrinho
                </button>
            </form>
        </div>

        <?php } ?>

    </div>
</div>

<footer>
    <p>Todos os Direitos Reservados - 2025</p>
</footer>

</main>

</body>
</html>
