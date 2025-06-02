document.addEventListener('DOMContentLoaded', function() {
    // ========== CONTROLE DO MENU ==========
    const menuToggleBtn = document.getElementById('menuToggleBtn');
    const container = document.querySelector('.container');
    let isMenuCollapsed = window.innerWidth <= 768;

    const toggleMenu = () => {
        isMenuCollapsed = !isMenuCollapsed;
        container.classList.toggle('sidebar-collapsed', isMenuCollapsed);
        if (window.innerWidth <= 768) {
            container.classList.toggle('sidebar-open', isMenuCollapsed);
        }
    };

    const setupMenu = () => {
        const shouldCollapse = window.innerWidth <= 768;
        container.classList.toggle('sidebar-collapsed', shouldCollapse);
        container.classList.toggle('sidebar-open', shouldCollapse);
        isMenuCollapsed = shouldCollapse;
    };

    if (menuToggleBtn) menuToggleBtn.addEventListener('click', toggleMenu);
    setupMenu();
    window.addEventListener('resize', setupMenu);

    // ========== LINKS ATIVOS ==========
    const navLinks = document.querySelectorAll('.nav-menu a');
    const setActiveLink = () => {
        const currentPage = window.location.pathname.split('/').pop() || 'Home.html';
        navLinks.forEach(link => {
            link.classList.toggle('active', link.getAttribute('href') === currentPage);
        });
    };
    navLinks.forEach(link => {
        link.addEventListener('click', function(e) {
            if (this.hash === '#') e.preventDefault();
            navLinks.forEach(l => l.classList.remove('active'));
            this.classList.add('active');
        });
    });
    setActiveLink();

    // ========== CARDS DE JOGO ==========
    document.querySelectorAll('.game-card').forEach(card => {
        card.addEventListener('click', () => {
            const title = card.querySelector('.game-title').textContent;
            alert(`Iniciando jogo: ${title}`);
        });
        card.addEventListener('mouseenter', () => {
            card.style.transform = 'translateY(-5px)';
            card.style.boxShadow = '0 5px 15px rgba(0,0,0,0.2)';
        });
        card.addEventListener('mouseleave', () => {
            card.style.transform = '';
            card.style.boxShadow = '0 2px 10px rgba(0,0,0,0.1)';
        });
    });

    // ========== BARRA DE PESQUISA ==========
    const performSearch = () => {
        const term = document.querySelector('.search-input').value.trim();
        term && alert(`Pesquisando por: ${term}`);
    };
    document.querySelector('.search-btn').addEventListener('click', performSearch);
    document.querySelector('.search-input').addEventListener('keypress', (e) => {
        e.key === 'Enter' && performSearch();
    });

    // ========== NOTIFICAÇÕES ==========
    document.querySelector('.notifications')?.addEventListener('click', () => {
        alert('Você tem 3 notificações não lidas');
    });

    // ========== BARRA DE PROGRESSO ==========
    document.querySelectorAll('.progress').forEach(bar => {
        const width = bar.style.width;
        bar.style.width = '0';
        setTimeout(() => {
            bar.style.transition = 'width 1s ease';
            bar.style.width = width;
        }, 300);
    });

    // ========== DROPDOWN DE AÇÕES ==========
    document.querySelector('.more-actions')?.addEventListener('click', (e) => {
        e.stopPropagation();
        document.querySelector('.dropdown-content').classList.toggle('show');
    });
    document.addEventListener('click', () => {
        document.querySelector('.dropdown-content')?.classList.remove('show');
    });
});