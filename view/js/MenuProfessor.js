// Versão atualizada do MenuProfessor.js

document.addEventListener('DOMContentLoaded', function() {
    // Inicializar componentes
    initializeDropdowns();
    initializeCustomSelect();
    initializeSidebar();
    
    // Mostrar seções ao abrir a página
    showSections();
});

// Função para inicializar os dropdowns
function initializeDropdowns() {
    const dropdownHeaders = document.querySelectorAll('.section-header');
    
    dropdownHeaders.forEach(header => {
        header.addEventListener('click', function() {
            // Toggle da classe active no cabeçalho
            this.classList.toggle('active');
            
            // Toggle do ícone
            const icon = this.querySelector('.section-toggle i');
            icon.classList.toggle('fa-chevron-down');
            icon.classList.toggle('fa-chevron-up');
            
            // Toggle do conteúdo
            const content = this.nextElementSibling;
            if (content.classList.contains('active')) {
                content.classList.remove('active');
                content.style.maxHeight = null;
            } else {
                content.classList.add('active');
                content.style.maxHeight = content.scrollHeight + "px";
            }
        });
    });
}

// Função para inicializar o select customizado
function initializeCustomSelect() {
    const selectBox = document.querySelector('.custom-select');
    const selected = selectBox.querySelector('.select-selected');
    const optionsContainer = selectBox.querySelector('.select-items');
    const options = optionsContainer.querySelectorAll('div');
    
    selected.addEventListener('click', function(e) {
        e.stopPropagation();
        optionsContainer.classList.toggle('select-hide');
        selected.classList.toggle('active');
    });
    
    options.forEach(option => {
        option.addEventListener('click', function() {
            selected.innerHTML = this.innerHTML;
            optionsContainer.classList.add('select-hide');
            selected.classList.remove('active');
            
            // Adicionar lógica para mudança de turma aqui
            console.log("Turma selecionada: " + this.innerHTML);
        });
    });
    
    // Fechar o select ao clicar fora
    document.addEventListener('click', function() {
        optionsContainer.classList.add('select-hide');
        selected.classList.remove('active');
    });
}

// Função para inicializar o sidebar
function initializeSidebar() {
    const menuToggle = document.querySelector('.menu-toggle');
    const container = document.querySelector('.container');
    
    menuToggle.addEventListener('click', function() {
        container.classList.toggle('sidebar-collapsed');
    });
    
    // Adicionar funcionalidade aos itens do menu
    const menuItems = document.querySelectorAll('.nav-menu a');
    menuItems.forEach(item => {
        item.addEventListener('click', function(e) {
            e.preventDefault();
            
            // Remove classe ativa de todos os itens
            menuItems.forEach(mi => mi.classList.remove('active'));
            
            // Adiciona classe ativa ao item clicado
            this.classList.add('active');
            
            // Adicionar navegação aqui se necessário
            const linkText = this.querySelector('span').textContent;
            console.log("Menu clicado: " + linkText);
        });
    });
}

// Função para mostrar as seções ao carregar a página
function showSections() {
    // Mostrar a primeira seção por padrão
    const firstSection = document.getElementById('atividades-dropdown');
    const firstContent = document.getElementById('atividades-content');
    
    if (firstSection && firstContent) {
        firstSection.classList.add('active');
        firstContent.classList.add('active');
        firstContent.style.maxHeight = firstContent.scrollHeight + "px";
        
        // Alterar o ícone
        const icon = firstSection.querySelector('.section-toggle i');
        icon.classList.remove('fa-chevron-down');
        icon.classList.add('fa-chevron-up');
    }
    
    // Adicionar animações de entrada para os cards
    animateCards();
}

// Função para animar os cards ao carregar
function animateCards() {
    const cards = document.querySelectorAll('.activity-card, .game-card, .progress-card');
    
    cards.forEach((card, index) => {
        setTimeout(() => {
            card.style.opacity = '0';
            card.style.transform = 'translateY(20px)';
            card.style.transition = 'opacity 0.5s ease, transform 0.5s ease';
            
            setTimeout(() => {
                card.style.opacity = '1';
                card.style.transform = 'translateY(0)';
            }, 50);
        }, index * 100);
    });
}

// Adicionar interatividade aos botões
document.addEventListener('click', function(e) {
    // Botões de iniciar atividades
    if (e.target.classList.contains('btn-action')) {
        const activityName = e.target.closest('.activity-card').querySelector('h3').textContent;
        alert(`Iniciando atividade: ${activityName}`);
    }
    
    // Botões de jogar
    if (e.target.classList.contains('btn-play')) {
        const gameName = e.target.closest('.game-card').querySelector('h3').textContent;
        alert(`Iniciando jogo: ${gameName}`);
    }
});

// Adicionar funcionalidade de pesquisa
const searchInput = document.querySelector('.search-box input');
if (searchInput) {
    searchInput.addEventListener('input', function() {
        const searchTerm = this.value.toLowerCase();
        const allCards = document.querySelectorAll('.activity-card, .game-card');
        
        allCards.forEach(card => {
            const cardTitle = card.querySelector('h3').textContent.toLowerCase();
            const cardDesc = card.querySelector('p')?.textContent.toLowerCase() || '';
            
            if (cardTitle.includes(searchTerm) || cardDesc.includes(searchTerm)) {
                card.style.display = 'block';
            } else {
                card.style.display = 'none';
            }
        });
    });
}

// Adicionar funcionalidade às notificações
const notificationIcon = document.querySelector('.notifications');
if (notificationIcon) {
    notificationIcon.addEventListener('click', function() {
        alert('Você tem 3 notificações não lidas');
    });
}

// Adicionar funcionalidade ao perfil
const profileElement = document.querySelector('.profile');
if (profileElement) {
    profileElement.addEventListener('click', function() {
        alert('Perfil do Aluno');
    });
}

// Controle do menu hambúrguer - VERSÃO MODIFICADA
document.addEventListener('DOMContentLoaded', function() {
    const menuToggleBtn = document.getElementById('menuToggleBtn');
    const container = document.querySelector('.container');
    
    // Estado inicial (você pode definir como preferir)
    let isMenuCollapsed = false;
    
    // Função para alternar o estado do menu
    function toggleMenu() {
        isMenuCollapsed = !isMenuCollapsed;
        
        // Alternar classes para controlar a exibição
        if (isMenuCollapsed) {
            container.classList.add('sidebar-collapsed');
            
            // Não adicionamos mais a classe 'active' ao botão
            // para que ele não se transforme em X
            
            // Para dispositivos móveis
            if (window.innerWidth <= 768) {
                container.classList.add('sidebar-open');
            }
        } else {
            container.classList.remove('sidebar-collapsed');
            
            // Para dispositivos móveis
            if (window.innerWidth <= 768) {
                container.classList.remove('sidebar-open');
            }
        }
    }
    
    // Adicionar evento de clique ao botão
    menuToggleBtn.addEventListener('click', toggleMenu);
    
    // Verificar o tamanho da tela ao carregar e redimensionar
    function checkScreenSize() {
        if (window.innerWidth <= 768) {
            // Em dispositivos móveis, começamos com o menu fechado
            if (!isMenuCollapsed) {
                toggleMenu();
            }
        }
    }
    
    // Verificar tamanho inicial da tela
    checkScreenSize();
    
    // Adicionar listener para redimensionamento
    window.addEventListener('resize', checkScreenSize);
});