/**
 * LevelUp Student Interface JavaScript
 * Provides interactive functionality for the student dashboard
 */

document.addEventListener('DOMContentLoaded', function () {
    // Variables
    const sidebarLinks = document.querySelectorAll('.sidebar a');
    const gameCards = document.querySelectorAll('.game-card');
    const searchInput = document.querySelector('.search-input');
    const searchBtn = document.querySelector('.search-btn');
    const moreActions = document.querySelector('.more-actions');
    const notifications = document.querySelector('.notifications');
    const userProfile = document.querySelector('.user-profile');
    const profileModal = document.getElementById('profile-modal');
    const closeModal = document.getElementById('close-modal');
    const loadingSpinner = document.getElementById('loading-spinner');
    const profileInfo = document.getElementById('profile-info');

    // Inicializar o controle do menu colapsável
    initializeMenuToggle();

    // Set active link in sidebar
    function setActiveLink() {
        const currentPage = window.location.pathname.split('/').pop();

        sidebarLinks.forEach(link => {
            const href = link.getAttribute('href');
            if (href === currentPage || (currentPage === '' && href === 'Home.html')) {
                link.classList.add('active');
            } else {
                link.classList.remove('active');
            }
        });
    }

    setActiveLink();

    // Add click event for sidebar links
    sidebarLinks.forEach(link => {
        link.addEventListener('click', function (e) {
            if (this.getAttribute('href') === '#') {
                e.preventDefault();
                sidebarLinks.forEach(l => l.classList.remove('active'));
                this.classList.add('active');
                const linkText = this.textContent.trim();
                console.log(`Navegando para: ${linkText}`);
            }
        });
    });

    // Game card interactions
    gameCards.forEach(card => {
        card.addEventListener('click', function () {
            const gameTitle = this.querySelector('.game-title').textContent;
            const gameDifficulty = this.querySelector('.game-difficulty').textContent;

            console.log(`Jogo selecionado: ${gameTitle} (${gameDifficulty})`);
            alert(`Iniciando jogo: ${gameTitle}`);
        });

        card.addEventListener('mouseenter', function () {
            this.style.boxShadow = '0 5px 15px rgba(0, 0, 0, 0.2)';
        });

        card.addEventListener('mouseleave', function () {
            this.style.boxShadow = '0 2px 10px rgba(0, 0, 0, 0.1)';
        });
    });

    // Search functionality
    function performSearch() {
        const searchTerm = searchInput.value.trim();
        if (searchTerm !== '') {
            console.log(`Pesquisando por: ${searchTerm}`);
            alert(`Pesquisando por: ${searchTerm}`);
        }
    }

    if (searchBtn) {
        searchBtn.addEventListener('click', performSearch);
    }

    if (searchInput) {
        searchInput.addEventListener('keypress', function (e) {
            if (e.key === 'Enter') {
                performSearch();
            }
        });
    }

    // Notifications interaction
    if (notifications) {
        notifications.addEventListener('click', function () {
            alert('Você tem 3 notificações não lidas');
        });
    }

    // Profile Modal Functions
    function openProfileModal() {
        if (profileModal) {
            profileModal.classList.add('show');
            document.body.style.overflow = 'hidden';
            loadStudentProfile();
        }
    }

    function closeProfileModal() {
        if (profileModal) {
            profileModal.classList.remove('show');
            document.body.style.overflow = 'auto';
        }
    }

function loadStudentProfile() {
    if (loadingSpinner) loadingSpinner.style.display = 'block';
    if (profileInfo) profileInfo.style.display = 'none';

    fetch(`../controller/getCrianca.php?id=${window.STUDENT_DATA.id}`)
        .then(response => {
            if (!response.ok) throw new Error('Erro na requisição');
            return response.json();
        })
        .then(data => {
            if (data.success) {
                populateProfileData(data.crianca);
            } else {
                showError(data.message || 'Erro ao carregar perfil');
            }
        })
        .catch(error => {
            console.error('Erro:', error);
            showError('Erro de conexão');
        })
        .finally(() => {
            if (loadingSpinner) loadingSpinner.style.display = 'none';
            if (profileInfo) profileInfo.style.display = 'grid';
        });
}

function populateProfileData(crianca) {
    // Atualizar avatar e nome
    const firstLetter = crianca.nome.charAt(0).toUpperCase();
    document.getElementById('modal-avatar').textContent = firstLetter;
    document.getElementById('modal-name').textContent = crianca.nome;

    // Mapear campos do perfil
    const fields = {
        'student-id': crianca.id,
        'student-email': crianca.email,
        'student-phone': crianca.telefone,
        'student-birth': formatDate(crianca.dataNasc),
        'responsible-name': crianca.nomeResponsavel,
        'responsible-phone': crianca.telefoneResponsavel
    };

    // Atualizar cada campo
    Object.entries(fields).forEach(([id, value]) => {
        const element = document.getElementById(id);
        if (element) element.textContent = value || '-';
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
                    loadStudentProfile();
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

    function getStudentId() {
        // Get student ID from global variable passed by PHP
        if (window.STUDENT_DATA && window.STUDENT_DATA.id) {
            return window.STUDENT_DATA.id;
        }
        
        // Fallback: Try to get from URL parameters
        const urlParams = new URLSearchParams(window.location.search);
        const studentId = urlParams.get('id');
        
        return studentId || null;
    }

    // Event listeners for modal
    if (userProfile) {
        userProfile.addEventListener('click', openProfileModal);
    }
    if (closeModal) {
        closeModal.addEventListener('click', closeProfileModal);
    }

    // Close modal when clicking outside
    if (profileModal) {
        profileModal.addEventListener('click', function(e) {
            if (e.target === profileModal) {
                closeProfileModal();
            }
        });
    }

    // Close modal with ESC key
    document.addEventListener('keydown', function(e) {
        if (e.key === 'Escape' && profileModal && profileModal.classList.contains('show')) {
            closeProfileModal();
        }
    });

    // Progress bar animation
    const progressBars = document.querySelectorAll('.progress');
    progressBars.forEach(bar => {
        const width = bar.style.width;
        bar.style.width = '0';
        setTimeout(() => {
            bar.style.transition = 'width 1s ease';
            bar.style.width = width;
        }, 300);
    });

    // Log do ID do aluno para debug
    console.log('ID do aluno logado:', getStudentId());
    
    // Initialize profile data on page load if needed
    setTimeout(() => {
        const studentId = getStudentId();
        if (studentId && window.STUDENT_DATA) {
            console.log('Dados do aluno disponíveis:', window.STUDENT_DATA);
        }
    }, 500);

   // Substitua a função initializeMenuToggle() no seu MenuAluno.js por esta versão melhorada:

function initializeMenuToggle() {
    const container = document.querySelector('.container');
    const menuToggleBtn = document.getElementById('menuToggleBtn');
    
    if (!container || !menuToggleBtn) return;
    
    let isMenuCollapsed = false;
    
    function toggleMenu() {
        isMenuCollapsed = !isMenuCollapsed;
        
        if (isMenuCollapsed) {
            container.classList.add('sidebar-collapsed');
            if (window.innerWidth <= 768) {
                container.classList.add('sidebar-open');
            }
        } else {
            container.classList.remove('sidebar-collapsed');
            if (window.innerWidth <= 768) {
                container.classList.remove('sidebar-open');
            }
        }
    }
    
    menuToggleBtn.addEventListener('click', toggleMenu);
    
    // Ajuste inicial para telas pequenas
    if (window.innerWidth <= 768) {
        toggleMenu(); // Fecha o menu em mobile
    }
}

// Alternativa: Função para criar botão no top-bar (opcional)
function createTopBarToggle() {
    const topBar = document.querySelector('.top-bar');
    const greeting = document.querySelector('.greeting');
    
    if (!topBar || !greeting) return;
    
    // Verificar se já existe
    if (topBar.querySelector('.menu-toggle-btn')) return;
    
    const toggleBtn = document.createElement('button');
    toggleBtn.className = 'menu-toggle-btn';
    toggleBtn.innerHTML = `
        <div class="hamburger">
            <span></span>
            <span></span>
            <span></span>
        </div>
    `;
    
    // Inserir antes do greeting
    topBar.insertBefore(toggleBtn, greeting);
    
    // Adicionar funcionalidade
    const container = document.querySelector('.container');
    let isCollapsed = false;
    
    toggleBtn.addEventListener('click', function() {
        isCollapsed = !isCollapsed;
        
        if (isCollapsed) {
            container.classList.add('sidebar-collapsed');
        } else {
            container.classList.remove('sidebar-collapsed');
        }
    });
    
    return toggleBtn;
}

// CSS para animação adicional (pode ser adicionado via JavaScript)
function addToggleStyles() {
    const style = document.createElement('style');
    style.textContent = `
        .menu-toggle-btn.animating {
            transform: scale(0.9);
        }
        
        .hamburger span {
            transition: all 0.3s cubic-bezier(0.68, -0.55, 0.265, 1.55);
        }
        
        .sidebar-collapsed .menu-toggle-btn .hamburger span:nth-child(1) {
            transform: rotate(45deg) translate(3px, 3px);
        }
        
        .sidebar-collapsed .menu-toggle-btn .hamburger span:nth-child(2) {
            opacity: 0;
            transform: scaleX(0);
        }
        
        .sidebar-collapsed .menu-toggle-btn .hamburger span:nth-child(3) {
            transform: rotate(-45deg) translate(3px, -3px);
        }
    `;
    
    document.head.appendChild(style);
}


});

