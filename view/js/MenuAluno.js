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
    initializeTasksMenu();

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
        // Show loading spinner
        if (loadingSpinner) {
            loadingSpinner.style.display = 'block';
        }
        if (profileInfo) {
            profileInfo.style.display = 'none';
        }

        // Get student ID from global variable passed by PHP
        const studentId = getStudentId();

        if (studentId) {
            // Make AJAX request to get student data
            fetch(`../../controller/getAluno.php?id=${studentId}`)
                .then(response => {
                    if (!response.ok) {
                        throw new Error(`HTTP error! status: ${response.status}`);
                    }
                    return response.json();
                })
                .then(data => {
                    if (data.success) {
                        populateProfileData(data.aluno);
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
        } else {
            showError('ID do aluno não encontrado');
            if (loadingSpinner) {
                loadingSpinner.style.display = 'none';
            }
            if (profileInfo) {
                profileInfo.style.display = 'grid';
            }
        }
    }

    function populateProfileData(aluno) {
        // Update modal header
        const firstLetter = aluno.nome.charAt(0).toUpperCase();
        const modalAvatar = document.getElementById('modal-avatar');
        const modalName = document.getElementById('modal-name');
        
        if (modalAvatar) modalAvatar.textContent = firstLetter;
        if (modalName) modalName.textContent = aluno.nome;

        // Update top bar user info (se não estiver já definido pelo PHP)
        const userAvatar = document.getElementById('user-avatar');
        const userName = document.getElementById('user-name');
        const greetingName = document.getElementById('greeting-name');
        
        if (userAvatar && !userAvatar.textContent) {
            userAvatar.textContent = firstLetter;
        }
        if (userName && !userName.textContent) {
            userName.textContent = aluno.nome.split(' ')[0];
        }
        if (greetingName && greetingName.textContent.includes('Olá, !')) {
            greetingName.textContent = `Olá, ${aluno.nome.split(' ')[0]}!`;
        }

        // Update profile info fields
        const fields = [
            { id: 'student-id', value: aluno.id },
            { id: 'student-email', value: aluno.email },
            { id: 'student-phone', value: aluno.telefone },
            { id: 'student-birth', value: formatDate(aluno.dataNasc) },
            { id: 'student-class', value: aluno.turma },
            { id: 'responsible-name', value: aluno.nomeResponsavel },
            { id: 'responsible-phone', value: aluno.telefoneResponsavel }
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

function initializeTasksMenu() {
    const tasksLink = document.querySelector('.sidebar a[href="#"]'); // Ou selecione pelo texto "Tarefas"
    const activitiesOverlay = document.getElementById('activities-overlay');
    const closeActivities = document.getElementById('close-activities');
    
    if (!tasksLink || !activitiesOverlay) return;

    // Evento para abrir as atividades
    tasksLink.addEventListener('click', function(e) {
        e.preventDefault();
        activitiesOverlay.style.display = 'flex';
        document.body.style.overflow = 'hidden';
    });

    // Evento para fechar as atividades
    if (closeActivities) {
        closeActivities.addEventListener('click', function() {
            activitiesOverlay.style.display = 'none';
            document.body.style.overflow = 'auto';
        });
    }

    // Fechar ao clicar fora do conteúdo
    activitiesOverlay.addEventListener('click', function(e) {
        if (e.target === activitiesOverlay) {
            activitiesOverlay.style.display = 'none';
            document.body.style.overflow = 'auto';
        }
    });

    // Fechar com ESC
    document.addEventListener('keydown', function(e) {
        if (e.key === 'Escape' && activitiesOverlay.style.display === 'flex') {
            activitiesOverlay.style.display = 'none';
            document.body.style.overflow = 'auto';
        }
    });
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

// Adicione esta função no final do arquivo, dentro do DOMContentLoaded
function loadGameProgress() {
    const studentId = window.STUDENT_DATA?.id;
    if (!studentId) return;

    fetch(`../../controller/getGameProgress.php?studentId=${studentId}&game=genius`)
    .then(response => response.json())
    .then(data => {
        if (data.success && data.progress) {
            updateGeniusProgress(data.progress.level, data.progress.maxLevels);
        }
    })
    .catch(error => {
        console.error('Erro ao carregar progresso do jogo:', error);
    });
}

function updateGeniusProgress(currentLevel, maxLevels) {
    const progressElement = document.getElementById('genius-progress');
    if (progressElement && maxLevels > 0) {
        const percentage = Math.round((currentLevel / maxLevels) * 100);
        progressElement.querySelector('.progress').style.width = `${percentage}%`;
        progressElement.querySelector('.progress-info').textContent = `${percentage}% Completo (Nível ${currentLevel}/${maxLevels})`;
    }
}

// Chame esta função quando a página carregar
loadGameProgress();


});

