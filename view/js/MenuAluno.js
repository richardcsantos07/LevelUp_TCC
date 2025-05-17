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

document.addEventListener('DOMContentLoaded', function () {
    // Variables
    const sidebarLinks = document.querySelectorAll('.sidebar a');
    const gameCards = document.querySelectorAll('.game-card');
    const searchInput = document.querySelector('.search-input');
    const searchBtn = document.querySelector('.search-btn');
    const moreActions = document.querySelector('.more-actions');
    const notifications = document.querySelector('.notifications');
    const userProfile = document.querySelector('.user-profile');

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
    document.addEventListener('DOMContentLoaded', function () {
        // Criar o botão de toggle do menu
        const toggleBtn = document.createElement('div');
        toggleBtn.className = 'menu-toggle-btn';
        toggleBtn.innerHTML = '<i class="fas fa-bars"></i>';

        // Inserir o botão depois da sidebar
        const sidebar = document.querySelector('.sidebar');
        sidebar.parentNode.insertBefore(toggleBtn, sidebar.nextSibling);

        // Adicionar classe CSS inicial no corpo do documento
        document.body.classList.add('menu-expanded');

        // Adicionar evento de clique para alternar o menu
        toggleBtn.addEventListener('click', function () {
            document.body.classList.toggle('menu-expanded');
            document.body.classList.toggle('menu-collapsed');

            // Alternar o ícone do botão
            if (document.body.classList.contains('menu-expanded')) {
                toggleBtn.innerHTML = '<i class="fas fa-bars"></i>';
            } else {
                toggleBtn.innerHTML = '<i class="fas fa-expand"></i>';
            }
        });
    });

    // Initialize active link
    setActiveLink();

    // Add click event for sidebar links
    sidebarLinks.forEach(link => {
        link.addEventListener('click', function (e) {
            // Only prevent default for anchor tags that point to #
            if (this.getAttribute('href') === '#') {
                e.preventDefault();

                // Remove active class from all links
                sidebarLinks.forEach(l => l.classList.remove('active'));

                // Add active class to clicked link
                this.classList.add('active');

                // You could add custom navigation logic here
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
            // You can add navigation to the specific game here
            // window.location.href = `game.html?title=${encodeURIComponent(gameTitle)}`;

            // For now, just show an alert
            alert(`Iniciando jogo: ${gameTitle}`);
        });

        // Add hover effects
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
            // Here you would typically call a search API or filter content

            // For demonstration, just alert
            alert(`Pesquisando por: ${searchTerm}`);
        }
    }

    searchBtn.addEventListener('click', performSearch);

    searchInput.addEventListener('keypress', function (e) {
        if (e.key === 'Enter') {
            performSearch();
        }
    });

    // Notifications interaction
    notifications.addEventListener('click', function () {
        alert('Você tem 3 notificações não lidas');
        // Here you could open a notifications panel
    });

    // User profile interaction
    userProfile.addEventListener('click', function () {
        window.location.href = '#'; // Navigate to profile page
    });

    // Mobile sidebar toggle (for responsive design)
    if (window.innerWidth <= 576) {
        // Create mobile toggle button if it doesn't exist
        if (!document.querySelector('.mobile-toggle')) {
            const mobileToggle = document.createElement('div');
            mobileToggle.className = 'mobile-toggle';
            mobileToggle.innerHTML = '<i class="fas fa-bars"></i>';
            document.body.appendChild(mobileToggle);

            mobileToggle.addEventListener('click', function () {
                const sidebar = document.querySelector('.sidebar');
                sidebar.classList.toggle('active');

                // Change icon based on sidebar state
                if (sidebar.classList.contains('active')) {
                    this.innerHTML = '<i class="fas fa-times"></i>';
                } else {
                    this.innerHTML = '<i class="fas fa-bars"></i>';
                }
            });
        }
    }

    // Window resize handling
    window.addEventListener('resize', function () {
        if (window.innerWidth <= 576) {
            if (!document.querySelector('.mobile-toggle')) {
                const mobileToggle = document.createElement('div');
                mobileToggle.className = 'mobile-toggle';
                mobileToggle.innerHTML = '<i class="fas fa-bars"></i>';
                document.body.appendChild(mobileToggle);

                mobileToggle.addEventListener('click', function () {
                    document.querySelector('.sidebar').classList.toggle('active');
                });
            }
        } else {
            const mobileToggle = document.querySelector('.mobile-toggle');
            if (mobileToggle) {
                mobileToggle.remove();
            }
            document.querySelector('.sidebar').classList.remove('active');
        }
    });

    // Progress bar animation (optional)
    const progressBars = document.querySelectorAll('.progress');
    progressBars.forEach(bar => {
        const width = bar.style.width;
        bar.style.width = '0';
        setTimeout(() => {
            bar.style.transition = 'width 1s ease';
            bar.style.width = width;
        }, 300);
    });
});

document.addEventListener('DOMContentLoaded', function() {
    // Criar o botão de toggle do menu
    const toggleBtn = document.createElement('div');
    toggleBtn.className = 'menu-toggle-btn';
    toggleBtn.innerHTML = '<i class="fas fa-bars"></i>';
    
    // Inserir o botão depois da sidebar
    const sidebar = document.querySelector('.sidebar');
    sidebar.parentNode.insertBefore(toggleBtn, sidebar.nextSibling);
    
    // Adicionar classe CSS inicial no corpo do documento
    document.body.classList.add('menu-expanded');
    
    // Adicionar evento de clique para alternar o menu
    toggleBtn.addEventListener('click', function() {
        document.body.classList.toggle('menu-expanded');
        document.body.classList.toggle('menu-collapsed');
        
        // Alternar o ícone do botão
        if (document.body.classList.contains('menu-expanded')) {
            toggleBtn.innerHTML = '<i class="fas fa-bars"></i>';
        } else {
            toggleBtn.innerHTML = '<i class="fas fa-expand"></i>';
        }
    });
});