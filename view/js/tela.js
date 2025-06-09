const carousel = document.querySelector('.carousel');
const dots = document.querySelectorAll('.dot');
let currentIndex = 0;
const totalImages = dots.length;

function showSlide(index) {
    const offset = -index * 1000; // Largura do contêiner
    carousel.style.transform = `translateX(${offset}px)`;
    dots.forEach((dot, i) => {
        dot.classList.toggle('active', i === index);
    });
}

function nextSlide() {
    currentIndex = (currentIndex + 1) % totalImages;
    showSlide(currentIndex);
}

// Configura o intervalo para mudar as imagens automaticamente
setInterval(nextSlide, 3000);

// Permite a navegação clicando nos pontos
dots.forEach(dot => {
    dot.addEventListener('click', () => {
        currentIndex = parseInt(dot.getAttribute('data-index'));
        showSlide(currentIndex);
    });
});


// Lista de Jogos
const games = [
    { title: "Genius", description: "Jogo de memória.", image: "../img/genius.jpg" },
    { title: "Jogo de Português", description: "Melhore a gramática.", image: "https://via.placeholder.com/150" },
    { title: "Jogo de Geografia", description: "Descubra países.", image: "https://via.placeholder.com/150" },
    { title: "Jogo de Ciências", description: "Explore a ciência.", image: "https://via.placeholder.com/150" },
    { title: "Jogo de Ciências", description: "Explore a ciência.", image: "https://via.placeholder.com/150" },
    { title: "Jogo de Ciências", description: "Explore a ciência.", image: "https://via.placeholder.com/150" },
    { title: "Jogo de Ciências", description: "Explore a ciência.", image: "https://via.placeholder.com/150" },
    { title: "Jogo de Ciências", description: "Explore a ciência.", image: "https://via.placeholder.com/150" },
];

// Função para carregar os jogos
// Função para carregar os jogos
function loadGames(filter = "") {
    const gameList = document.getElementById("game-list");
    gameList.innerHTML = "";
    games.filter(game => game.title.toLowerCase().includes(filter.toLowerCase())).forEach(game => {
        const card = document.createElement("div");
        card.className = "game-card";
        
        // Verifica se é o jogo Genius para adicionar o link
        if (game.title === "Genius") {
            card.innerHTML = `
                <a href="../../games/Genius_2.0/index.html" class="game-link">
                    <img src="${game.image}" alt="${game.title}">
                    <h3>${game.title}</h3>
                </a>
            `;
        } else {
            card.innerHTML = `
                <img src="${game.image}" alt="${game.title}">
                <h3>${game.title}</h3>
            `;
        }
        
        gameList.appendChild(card);
    });
}

// Função para dropdown do menu
document.querySelector(".dropdown-btn").addEventListener("click", () => {
    const dropdown = document.querySelector(".dropdown-content");
    dropdown.style.display = dropdown.style.display === "block" ? "none" : "block";
});

// Adicionar funcionalidade à barra de pesquisa
document.getElementById("search").addEventListener("input", e => loadGames(e.target.value));

// Carregar os jogos ao iniciar
window.onload = () => loadGames();

