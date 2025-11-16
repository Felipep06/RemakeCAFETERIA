// Elementos DOM
const searchIcon = document.getElementById('searchIcon'); //icon para abrir pesquisa
const searchBar = document.getElementById('searchBar'); //container da pesquisa
const searchInput = document.getElementById('searchInput'); // campo de input
const searchBtn = document.getElementById('searchBtn'); // botão de buscar
const closeSearch = document.getElementById('closeSearch'); // botão de fechar
const products = document.querySelectorAll('.products'); // lista de produtos

// Mostrar a barra de pesquisa ao clicar
searchIcon.addEventListener('click',function(){
    searchBar.classList.add('active');
    searchInput.focus(); //foca automaticamente no input
})

// Fechar barra de pesquisa
closeSearch.addEventListener('click',function(){
    searchBar.classList.remove('active');
    searchInput.value = ''; // Para limpar o campo de pesquisa
    resetSearch(); // Mostra todos os produtos novamente
})

// Pesquisar ao clicar no botão buscar
searchBtn.addEventListener('click', performSearch);

// Pesquisar ao pressionar enter
searchInput.addEventListener('keypress',function(e){
    if (e.key === 'Enter'){
        performSearch();
    }
})

// função para executar a pesquisa
function performSearch(){
    const searchTerm = searchInput.value.toLowerCase().trim();

    if(searchTerm === ''){
        resetSearch();
        return;
    }

    products.forEach(product => {
        const productName = product.getAttribute('data-name').toLowerCase();
        const productText = product.textContent.toLowerCase();
        
        // Verificar se o termo de pesquisa esta no nome ou no texto do produto
        if(productName.includes(searchTerm) || productText.includes(searchTerm)){
            product.classList.remove('hidden');
        }
        else{
            product.classList.add('hidden');
        }
    })
}

// função para resetar a pesquisa (mostrar todos os produtos)
function resetSearch(){
    products.forEach(product => {
        product.classList.remove('hidden');
    })
}

// fechar barra de pesquisa ao clicar fora dela
document.addEventListener('click',function(event){
    const isClickInsideSearch = searchBar.contains(event.target ) || searchIcon.contains(event.target);

    if(!isClickInsideSearch && searchBar.classList.contains('active')){
        searchBar.classList.remove('active');
        searchInput.value = '';
        resetSearch();
    }
})

// Efeito de digitação no input
searchInput.addEventListener('focus',function(){
    this.style.background = '#fff9e6';
})
searchInput.addEventListener('blur',function(){
    this.style.background = 'white';
})




