// Gerenciamento das abas e conteúdos
document.addEventListener('DOMContentLoaded', function () {
    console.log('Script carregado');  // Para debug
    // Mostrar/esconder submenus
    const toggleItems = document.querySelectorAll('.menu-item.has-submenu');
    toggleItems.forEach(item => {
        item.addEventListener('click', function () {
            const submenuId = this.getAttribute('data-toggle');
            const submenu = document.getElementById(submenuId);
            submenu.classList.toggle('open');
        });
    });


    // Navegação entre as seções
    const menuItems = document.querySelectorAll('.menu-item');
    menuItems.forEach(item => {
        item.addEventListener('click', function (e) {
            // Ignorar para items com submenu
            if (this.classList.contains('has-submenu')) return;

            e.preventDefault();

            // Remover classe active de todos os items
            menuItems.forEach(menuItem => {
                if (!menuItem.classList.contains('has-submenu')) {
                    menuItem.classList.remove('active');
                }
            });

            // Adicionar classe active ao item clicado
            this.classList.add('active');

            // Mostrar a seção correspondente
            const sectionId = this.getAttribute('data-section');
            if (sectionId) {
                const sections = document.querySelectorAll('.content-section');
                sections.forEach(section => {
                    section.classList.remove('active');
                });

                const activeSection = document.getElementById(sectionId);
                if (activeSection) {
                    activeSection.classList.add('active');
                }
            }
        });
    });



    // Função para navegar entre seções
    function navigateToSection(sectionId) {
        // Esconde todas as seções de conteúdo
        const sections = document.querySelectorAll('.content-section');
        sections.forEach(section => {
            section.classList.remove('active');
        });

        // Mostra a seção desejada
        const activeSection = document.getElementById(sectionId);
        if (activeSection) {
            activeSection.classList.add('active');
        }

        // Atualiza o menu
        const menuItems = document.querySelectorAll('.menu-item');
        menuItems.forEach(item => {
            item.classList.remove('active');
            if (item.getAttribute('data-section') === sectionId) {
                item.classList.add('active');

                // Abre o submenu pai se necessário
                const parent = item.parentElement;
                if (parent.classList.contains('submenu')) {
                    parent.classList.add('open');
                }
            }
        });
    }



    const tabItems = document.querySelectorAll('.tab-item');
    tabItems.forEach(item => {
        item.addEventListener('click', function () {
            const tabId = this.getAttribute('data-tab');

            // Remove active de todas as abas e conteúdos
            document.querySelectorAll('.tab-item').forEach(tab => {
                tab.classList.remove('active');
            });
            document.querySelectorAll('.tab-content').forEach(content => {
                content.classList.remove('active');
            });

            // Adiciona active à aba e conteúdo clicados
            this.classList.add('active');
            document.getElementById(tabId).classList.add('active');
        });
    });






});

