// Versão corrigida do MenuProfessor.js

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
    if (!selectBox) return;
    
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
    
    if (menuToggle) {
        menuToggle.addEventListener('click', function() {
            container.classList.toggle('sidebar-collapsed');
        });
    }
    
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
        if (icon) {
            icon.classList.remove('fa-chevron-down');
            icon.classList.add('fa-chevron-up');
        }
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
const profileModal = document.getElementById('profile-modal');
const closeModal = document.getElementById('close-modal');
const loadingSpinner = document.getElementById('loading-spinner');
const profileInfo = document.getElementById('profile-info');

function openProfileModal() {
    if (profileModal) {
        profileModal.classList.add('show');
        document.body.style.overflow = 'hidden';
        loadProfessorProfile();
    }
}

function closeProfileModal() {
    if (profileModal) {
        profileModal.classList.remove('show');
        document.body.style.overflow = 'auto';
    }
}

function loadProfessorProfile() {
    if (loadingSpinner) {
        loadingSpinner.style.display = 'block';
    }
    if (profileInfo) {
        profileInfo.style.display = 'none';
    }

    // Fazemos a requisição sem ID, pois o PHP vai usar o ID da sessão
    fetch('../../controller/getProfessor.php', {
        method: 'GET',
        credentials: 'same-origin' // Importante para manter a sessão
    })
    .then(response => {
        if (!response.ok) {
            throw new Error(`HTTP error! status: ${response.status}`);
        }
        return response.json();
    })
    .then(data => {
        if (data.success) {
            populateProfileData(data.professor);
        } else {
            showError('Erro ao carregar dados do perfil: ' + data.message);
        }
    })
    .catch(error => {
        console.error('Erro:', error);
        showError('Erro de conexão ao carregar dados do perfil');
    })
    .finally(() => {
        if (loadingSpinner) {
            loadingSpinner.style.display = 'none';
        }
        if (profileInfo) {
            profileInfo.style.display = 'grid';
        }
    });
}

function populateProfileData(professor) {
    if (!professor || !professor.nome) {
        showError('Dados do professor não encontrados');
        return;
    }

    const firstLetter = professor.nome.charAt(0).toUpperCase();
    
    // Atualizar modal
    const modalAvatar = document.getElementById('modal-avatar');
    const modalName = document.getElementById('modal-name');
    if (modalAvatar) modalAvatar.textContent = firstLetter;
    if (modalName) modalName.textContent = professor.nome;

    // Atualizar interface principal se necessário
    const userAvatar = document.getElementById('user-avatar');
    const userName = document.getElementById('user-name');
    const greetingName = document.getElementById('greeting-name');
    
    if (userAvatar && !userAvatar.textContent) {
        userAvatar.textContent = firstLetter;
    }
    if (userName && !userName.textContent) {
        userName.textContent = professor.nome.split(' ')[0];
    }
    if (greetingName && greetingName.textContent === 'Olá, !') {
        greetingName.textContent = `Olá, ${professor.nome.split(' ')[0]}!`;
    }

    // Preencher dados do perfil
    const fields = [
        { id: 'professor-email', value: professor.email },
        { id: 'professor-phone', value: professor.telefone },
        { id: 'professor-birth', value: formatDate(professor.dataNasc) },
        { id: 'professor-materia', value: professor.materia },
        { id: 'professor-cpf', value: professor.cpf }
    ];

    fields.forEach(field => {
        const element = document.getElementById(field.id);
        if (element) {
            element.textContent = field.value || '-';
        }
    });
}

function showError(message) {
    if (profileInfo) {
        profileInfo.innerHTML = `
            <div style="text-align: center; padding: 20px; color: #d9534f;">
                <i class="fas fa-exclamation-triangle" style="font-size: 48px; margin-bottom: 15px;"></i>
                <p>${message}</p>
                <button id="retry-btn" style="margin-top: 15px; padding: 8px 16px; background: var(--primary-color); color: white; border: none; border-radius: 5px; cursor: pointer;">
                    Tentar novamente
                </button>
            </div>
        `;

        const retryBtn = document.getElementById('retry-btn');
        if (retryBtn) {
            retryBtn.addEventListener('click', function() {
                loadProfessorProfile();
            });
        }
    }
}

function formatDate(dateString) {
    if (!dateString) return '-';
    try {
        const date = new Date(dateString);
        return date.toLocaleDateString('pt-BR');
    } catch (error) {
        return '-';
    }
}

// Event listeners para o modal de perfil
if (profileElement) {
    profileElement.addEventListener('click', openProfileModal);
}

if (closeModal) {
    closeModal.addEventListener('click', closeProfileModal);
}

if (profileModal) {
    profileModal.addEventListener('click', function(e) {
        if (e.target === profileModal) {
            closeProfileModal();
        }
    });
}

document.addEventListener('keydown', function(e) {
    if (e.key === 'Escape' && profileModal && profileModal.classList.contains('show')) {
        closeProfileModal();
    }
});

// Controle do menu hambúrguer
document.addEventListener('DOMContentLoaded', function() {
    const menuToggleBtn = document.getElementById('menuToggleBtn');
    const container = document.querySelector('.container');
    
    if (!menuToggleBtn || !container) return;
    
    // Estado inicial
    let isMenuCollapsed = false;
    
    // Função para alternar o estado do menu
    function toggleMenu() {
        isMenuCollapsed = !isMenuCollapsed;
        
        // Alternar classes para controlar a exibição
        if (isMenuCollapsed) {
            container.classList.add('sidebar-collapsed');
            
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