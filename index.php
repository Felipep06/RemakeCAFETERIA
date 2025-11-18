<?php
// Aqui você pode colocar código PHP futuramente, como includes, sessões, etc.
// Por enquanto, ele só funciona exatamente como o index.html no visual.
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
        href="https://fonts.googleapis.com/css2?family=Poppins:wght@100;200;300;400;500;600;700;800;900&display=swap"
        rel="stylesheet">
</head>

<body>
    <header class="header">
        <section>
            <a href="#" class="logo">
                <img width="64" height="64" src="https://img.icons8.com/dusk/64/java-coffee-cup-logo.png" alt="java-coffee-cup-logo"/>
            </a>

            <nav class="navegacao">
                <a href="#inicio">Início</a>
                <a href="#sobre">Sobre</a>
                <a href="#Menu">Menu</a>
                <a href="#avaliacao">Avaliação</a>
                <a href="#localizacao">Localização</a>
            </nav>

            <div class="icones">
                <div class="pesquisa" id="searchIcon">
                    <a href="#"><img src="https://img.icons8.com/ios-filled/30/ffffff/search--v1.png" height="25" width="25"/></a>
                </div>

                <div class="search-bar" id="searchBar">
                    <input type="text" id="searchInput" placeholder="Pesquisar Produtos">
                    <button class="search-btn" id="searchBtn">Buscar</button>
                    <button class="close-btn" id="closeSearch">X</button>
                </div>

                <div class="carrinho">
                    <a href=""><img src="https://img.icons8.com/ios-glyphs/30/ffffff/shopping-cart--v1.png" height="25" width="25"/></a>
                </div>
            </div>
        </section>
    </header>

    <header>
        <div class="header-inner-content" id="sobre">
            <div class="header-button-side">
                <div class="header-button-side-left">
                    <h2>Paixão , Experiência e Conexão através do Café!</h2>
                    <p>
                        Um espaço acolhedor onde o aroma de grãos torrados e frescos se mistura ao clima descontraído.
                        <br>Ambiente perfeito para pausas, encontros ou horas de trabalho.
                        <br>Com atendimento caloroso que inspira conexões.
                    </p>
                </div>

                <div class="header-button-side-right">
                    <img src="Imagemcafe-topo.png">
                </div>
            </div>
        </div>
    </header>

    <main>
        <div class="cor-de-fundo">
            <div class="page-inner-content">
                <div class="cols cols-3">
                    <!-- Sua imagem gigante em Base64 permanece aqui -->
                    <img src="data:image/jpeg;base64,<?php echo '...base64 aqui...' ?>">
                </div>
            </div>
        </div>
    </main>

</body>
</html>
