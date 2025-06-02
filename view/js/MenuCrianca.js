// Controle do menu lateral com colapso/expansão e navegação entre seções

document.addEventListener('DOMContentLoaded', function () {
    const menuItems = document.querySelectorAll('.menu-item[data-section]');
    const submenuToggles = document.querySelectorAll('.menu-item.has-submenu');
    const submenus = document.querySelectorAll('.submenu');
    const menuSections = document.querySelectorAll('.menu-section');

    // Inicialmente esconder todos os itens do menu (exceto submenu items)
    function hideAllMenuItems() {
        menuItems.forEach(item => {
            // Só esconder se não for submenu item
            if (!item.closest('.submenu')) {
                item.style.display = 'none';
            }
        });

        submenuToggles.forEach(toggle => {
            toggle.style.display = 'none';
        });

        submenus.forEach(submenu => {
            submenu.style.display = 'none';
        });
    }

    // Função para esconder todas as seções de conteúdo
    function hideAllSections() {
        const sections = document.querySelectorAll('.content-section');
        sections.forEach(section => {
            section.classList.remove('active');
        });
    }

    // Função para remover active dos itens do menu
    function deactivateAllMenuItems() {
        menuItems.forEach(item => {
            item.classList.remove('active');
        });
    }

    // Controle de clique nas seções do menu (Principal, Cadastros, etc.)
    menuSections.forEach(section => {
        section.addEventListener('click', function () {
            // Encontrar os itens que pertencem a esta seção
            let currentElement = this.nextElementSibling;
            const itemsToToggle = [];

            // Coletar todos os itens até a próxima seção
            while (currentElement && !currentElement.classList.contains('menu-section')) {
                if (currentElement.classList.contains('menu-item') && currentElement.hasAttribute('data-section')) {
                    itemsToToggle.push(currentElement);
                } else if (currentElement.classList.contains('menu-item') && currentElement.classList.contains('has-submenu')) {
                    itemsToToggle.push(currentElement);
                } else if (currentElement.classList.contains('submenu')) {
                    // Não adicionar submenu aos itens para toggle, será controlado separadamente
                }
                currentElement = currentElement.nextElementSibling;
            }

            // Verificar se os itens estão visíveis
            const isVisible = itemsToToggle.length > 0 &&
                itemsToToggle.some(item => item.style.display !== 'none');

            if (isVisible) {
                // Esconder itens desta seção
                itemsToToggle.forEach(item => {
                    item.style.display = 'none';
                    // Se for um item com submenu, esconder o submenu também
                    if (item.classList.contains('has-submenu')) {
                        const submenuId = item.getAttribute('data-toggle');
                        const submenu = document.getElementById(submenuId);
                        if (submenu) {
                            submenu.style.display = 'none';
                        }
                    }
                });

                // Esconder todas as seções de conteúdo quando o menu for fechado
                hideAllSections();
                deactivateAllMenuItems();

            } else {
                // Esconder outros grupos de menu primeiro
                menuItems.forEach(item => {
                    if (!itemsToToggle.includes(item) && !item.closest('.submenu')) {
                        item.style.display = 'none';
                    }
                });

                // Esconder outros submenus
                submenuToggles.forEach(toggle => {
                    if (!itemsToToggle.includes(toggle)) {
                        toggle.style.display = 'none';
                        const submenuId = toggle.getAttribute('data-toggle');
                        const submenu = document.getElementById(submenuId);
                        if (submenu) {
                            submenu.style.display = 'none';
                        }
                    }
                });

                // Mostrar itens desta seção
                itemsToToggle.forEach(item => {
                    item.style.display = 'flex';
                });

                // Esconder conteúdo quando trocar de seção do menu
                hideAllSections();
                deactivateAllMenuItems();
            }
        });

        // Adicionar estilo visual para indicar que é clicável
        section.style.cursor = 'pointer';
        section.style.userSelect = 'none';
        section.style.transition = 'color 0.2s ease';

        // Efeito hover nas seções
        section.addEventListener('mouseenter', function () {
            this.style.color = '#3498db';
        });

        section.addEventListener('mouseleave', function () {
            this.style.color = '#95a5a6';
        });
    });

    // Clique nos itens do menu que possuem data-section
    menuItems.forEach(item => {
        item.addEventListener('click', (e) => {
            e.stopPropagation(); // Evitar propagação para a seção pai
            const sectionId = item.getAttribute('data-section');
            if (sectionId) {
                // Verificar se a seção já está ativa
                const targetSection = document.getElementById(sectionId);
                if (targetSection) {
                    const isCurrentlyActive = targetSection.classList.contains('active');

                    // Sempre esconder todas as seções primeiro
                    hideAllSections();
                    deactivateAllMenuItems();

                    // Se não estava ativa, mostrar. Se estava ativa, deixar escondida (toggle)
                    if (!isCurrentlyActive) {
                        targetSection.classList.add('active');
                        item.classList.add('active');
                    }
                }
            }
        });
    });

    // Controle dos submenus
    submenuToggles.forEach(toggle => {
        toggle.addEventListener('click', (e) => {
            e.stopPropagation(); // Evitar propagação para a seção pai
            const submenuId = toggle.getAttribute('data-toggle');
            const submenu = document.getElementById(submenuId);

            if (submenu) {
                const isVisible = submenu.style.display === 'flex';

                if (isVisible) {
                    submenu.style.display = 'none';
                    toggle.style.transform = 'rotate(0deg)';
                } else {
                    // Fechar outros submenus
                    submenus.forEach(sm => {
                        if (sm !== submenu) {
                            sm.style.display = 'none';
                        }
                    });

                    // Resetar rotação de outros toggles
                    submenuToggles.forEach(t => {
                        if (t !== toggle) {
                            t.style.transform = 'rotate(0deg)';
                        }
                    });

                    submenu.style.display = 'flex';

                }
            }
        });

        // Adicionar transição suave para a rotação do ícone
        toggle.style.transition = 'transform 0.2s ease';
    });

    // Controle do formulário de cancelar criança
    const btnCancelarCrianca = document.getElementById('btn-cancelar-crianca');
    if (btnCancelarCrianca) {
        btnCancelarCrianca.addEventListener('click', function () {
            const form = document.getElementById('form-crianca');
            if (form) {
                form.reset();
            }
            // Voltar para o dashboard
            hideAllSections();
            deactivateAllMenuItems();
            const dashboard = document.getElementById('dashboard');
            if (dashboard) {
                dashboard.classList.add('active');
            }
        });
    }

    // Controle da busca de crianças
    const searchCriancas = document.getElementById('search-criancas');
    if (searchCriancas) {
        searchCriancas.addEventListener('input', function () {
            const searchTerm = this.value.toLowerCase();
            const table = document.getElementById('criancas-table');
            if (table) {
                const rows = table.querySelectorAll('tbody tr');
                rows.forEach(row => {
                    const text = row.textContent.toLowerCase();
                    row.style.display = text.includes(searchTerm) ? '' : 'none';
                });
            }
        });
    }

    // Inicializar com todos os itens escondidos
    hideAllMenuItems();

    // Esconder todas as seções de conteúdo inicialmente
    hideAllSections();

    // Mostrar dashboard por padrão
    const dashboard = document.getElementById('dashboard');
    if (dashboard) {
        dashboard.classList.add('active');
    }
});

// Script para controlar o modal de exclusão de conta
document.addEventListener('DOMContentLoaded', function () {
    const btnDeleteAccount = document.getElementById('btn-delete-account');
    const modalDeleteAccount = document.getElementById('modal-delete-account');
    const btnCancelDelete = document.getElementById('btn-cancel-delete');
    const btnConfirmDelete = document.getElementById('btn-confirm-delete');

    if (btnDeleteAccount && modalDeleteAccount) {
        btnDeleteAccount.addEventListener('click', function () {
            modalDeleteAccount.style.display = 'block';
        });
    }

    if (btnCancelDelete && modalDeleteAccount) {
        btnCancelDelete.addEventListener('click', function () {
            modalDeleteAccount.style.display = 'none';
        });
    }

    if (btnConfirmDelete) {
        btnConfirmDelete.addEventListener('click', function () {
            // Obter o ID do responsável de forma mais segura
            const idResp = document.getElementById('id_resp');
            const id = idResp ? idResp.value : '';
            if (id) {
                window.location.href = '../controller/deleteResp.php?id=' + id;
            } else {
                alert('Erro: ID do responsável não encontrado.');
            }
        });
    }

    // Fechar modal ao clicar fora dele
    if (modalDeleteAccount) {
        modalDeleteAccount.addEventListener('click', function (e) {
            if (e.target === modalDeleteAccount) {
                modalDeleteAccount.style.display = 'none';
            }
        });
    }

    // Fechar modal com ESC
    document.addEventListener('keydown', function (e) {
        if (e.key === 'Escape' && modalDeleteAccount && modalDeleteAccount.style.display === 'block') {
            modalDeleteAccount.style.display = 'none';
        }
    });
});

// Modal de Edição de Perfil do Responsável
document.addEventListener('DOMContentLoaded', function () {
    const btnEditProfile = document.getElementById('btn-edit-profile');
    const modalEditProfile = document.getElementById('modal-edit-profile');
    const btnCancelEdit = document.getElementById('btn-cancel-edit');

    // Abrir modal de edição
    if (btnEditProfile && modalEditProfile) {
        btnEditProfile.addEventListener('click', function () {
            modalEditProfile.style.display = 'block';
        });
    }

    // Fechar modal ao clicar no botão cancelar
    if (btnCancelEdit && modalEditProfile) {
        btnCancelEdit.addEventListener('click', function () {
            modalEditProfile.style.display = 'none';
        });
    }

    // Fechar modal ao clicar fora dele
    if (modalEditProfile) {
        modalEditProfile.addEventListener('click', function (e) {
            if (e.target === modalEditProfile) {
                modalEditProfile.style.display = 'none';
            }
        });
    }

    // Fechar modal com ESC
    document.addEventListener('keydown', function (e) {
        if (e.key === 'Escape' && modalEditProfile && modalEditProfile.style.display === 'block') {
            modalEditProfile.style.display = 'none';
        }
    });
});

// Modal de Edição de Criança - CORRIGIDO
document.addEventListener('DOMContentLoaded', function () {
    const modalEditCrianca = document.getElementById('modal-edit-crianca');
    const btnCancelEditCrianca = document.getElementById('btn-cancel-edit-crianca');

    // Fechar modal ao clicar no botão cancelar
    if (btnCancelEditCrianca && modalEditCrianca) {
        btnCancelEditCrianca.addEventListener('click', function () {
            modalEditCrianca.style.display = 'none';
        });
    }

    // Fechar modal ao clicar fora dele
    if (modalEditCrianca) {
        modalEditCrianca.addEventListener('click', function (e) {
            if (e.target === modalEditCrianca) {
                modalEditCrianca.style.display = 'none';
            }
        });
    }

    // Fechar modal com ESC
    document.addEventListener('keydown', function (e) {
        if (e.key === 'Escape' && modalEditCrianca && modalEditCrianca.style.display === 'block') {
            modalEditCrianca.style.display = 'none';
        }
    });
});

// Função para editar criança - CORRIGIDA
function editarCrianca(id) {
    // Fazer requisição AJAX para buscar os dados da criança
    fetch('../controller/getCrianca.php?id=' + id)
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                // Preencher o formulário com os dados da criança
                document.getElementById('edit-nome').value = data.crianca.nome;
                document.getElementById('edit-email').value = data.crianca.email;
                document.getElementById('edit-telefone').value = data.crianca.telefone;
                document.getElementById('edit-data-nasc').value = data.crianca.dataNasc;
                document.getElementById('edit-id').value = data.crianca.id;
                
                // Mostrar o modal
                document.getElementById('modal-edit-crianca').style.display = 'block';
            } else {
                alert('Erro ao carregar dados da criança: ' + data.message);
            }
        })
        .catch(error => {
            console.error('Erro:', error);
            alert('Erro ao carregar dados da criança');
        });
}