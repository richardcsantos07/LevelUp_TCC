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

    // Inicializar eventos de edição de aluno após o DOM estar carregado
    inicializarEventosEdicaoAluno();
    
    // Inicializar eventos do formulário de edição
    inicializarFormularioEdicao();
});

// Função para inicializar eventos de edição de aluno
function inicializarEventosEdicaoAluno() {
    const botoesEditar = document.querySelectorAll('.btn-editar-aluno');
    botoesEditar.forEach(botao => {
        botao.addEventListener('click', function() {
            const alunoId = this.getAttribute('data-id');
            abrirModalEditarAluno(alunoId);
        });
    });
}

// Função para abrir modal de edição - VERSÃO MELHORADA
function abrirModalEditarAluno(alunoId) {
    console.log('Abrindo modal para aluno ID:', alunoId);
    
    // Buscar dados do aluno
    fetch(`../controller/getAluno.php?id=${alunoId}`)
        .then(response => {
            console.log('Response getAluno status:', response.status);
            if (!response.ok) {
                throw new Error('Erro na resposta do servidor: ' + response.status);
            }
            return response.json();
        })
        .then(data => {
            console.log('Dados do aluno recebidos:', data);
            
            if (data.success) {
                // Preencher o formulário com os dados do aluno
                preencherFormularioEdicao(data.aluno);
                
                // Mostrar o modal
                const modal = document.getElementById('modal-editar-aluno');
                modal.classList.add('show');
                document.body.style.overflow = 'hidden';
            } else {
                alert('Erro ao carregar dados do aluno: ' + data.message);
                console.error('Erro nos dados:', data);
            }
        })
        .catch(error => {
            console.error('Erro ao buscar aluno:', error);
            alert('Erro ao carregar dados do aluno');
        });
}

// Função para preencher formulário de edição - VERSÃO MELHORADA
function preencherFormularioEdicao(aluno) {
    console.log('Preenchendo formulário com:', aluno);
    
    try {
        document.getElementById('edit-ra-aluno').value = aluno.id || aluno.ra || '';
        document.getElementById('edit-nome-aluno').value = aluno.nome || '';
        document.getElementById('edit-email-aluno').value = aluno.email || '';
        document.getElementById('edit-telefone-aluno').value = aluno.telefone || aluno.tell || '';
        document.getElementById('edit-data-nascimento').value = aluno.dataNasc || '';
        document.getElementById('edit-responsavel-aluno').value = aluno.nomeResponsavel || aluno.nome_responsavel || '';
        document.getElementById('edit-telefone-responsavel').value = aluno.telefoneResponsavel || aluno.tell_responsavel || '';
        
        // Selecionar a turma correta
        const selectTurma = document.getElementById('edit-turma-aluno');
        if (selectTurma && aluno.turma) {
            selectTurma.value = aluno.turma;
        }
        
        console.log('Formulário preenchido com sucesso');
    } catch (error) {
        console.error('Erro ao preencher formulário:', error);
        alert('Erro ao preencher formulário. Verifique o console.');
    }
}

// Função para fechar modal de edição
function fecharModalEditarAluno() {
    const modal = document.getElementById('modal-editar-aluno');
    modal.classList.remove('show');
    document.body.style.overflow = 'auto'; // Restaura scroll da página
    
    // Limpar formulário
    document.getElementById('form-editar-aluno').reset();
}

// Função para inicializar o formulário de edição - VERSÃO MELHORADA
function inicializarFormularioEdicao() {
    const formEditarAluno = document.getElementById('form-editar-aluno');
    if (formEditarAluno) {
        formEditarAluno.addEventListener('submit', function(e) {
            e.preventDefault();
            
            console.log('=== INÍCIO SUBMISSÃO FORMULÁRIO ===');
            
            // Validação básica antes de enviar
            const ra = document.getElementById('edit-ra-aluno').value.trim();
            const nome = document.getElementById('edit-nome-aluno').value.trim();
            const email = document.getElementById('edit-email-aluno').value.trim();
            const telefone = document.getElementById('edit-telefone-aluno').value.trim();
            const dataNasc = document.getElementById('edit-data-nascimento').value;
            
            console.log('Dados do formulário:');
            console.log('RA:', ra);
            console.log('Nome:', nome);
            console.log('Email:', email);
            console.log('Telefone:', telefone);
            console.log('Data Nasc:', dataNasc);
            
            if (!nome || !email || !ra || !dataNasc) {
                alert('Por favor, preencha todos os campos obrigatórios.');
                return;
            }
            
            // Mostrar indicador de carregamento
            const btnSubmit = this.querySelector('button[type="submit"]');
            const textoOriginal = btnSubmit.textContent;
            btnSubmit.textContent = 'Atualizando...';
            btnSubmit.disabled = true;
            
            // CORREÇÃO: Criar FormData manualmente com os nomes corretos
            const formData = new FormData();
            formData.append('ra-aluno', document.getElementById('edit-ra-aluno').value);
            formData.append('nome-aluno', document.getElementById('edit-nome-aluno').value);
            formData.append('email-aluno', document.getElementById('edit-email-aluno').value);
            formData.append('telefone-aluno', document.getElementById('edit-telefone-aluno').value);
            formData.append('data-nascimento', document.getElementById('edit-data-nascimento').value);
            formData.append('responsavel-aluno', document.getElementById('edit-responsavel-aluno').value);
            formData.append('telefone-responsavel', document.getElementById('edit-telefone-responsavel').value);
            
            // Adicionar turma se existir
            const selectTurma = document.getElementById('edit-turma-aluno');
            if (selectTurma) {
                formData.append('turma-aluno', selectTurma.value);
            }
            
            // Adicionar senha se fornecida
            const senhaField = document.getElementById('edit-senha-aluno');
            if (senhaField && senhaField.value.trim()) {
                formData.append('senha-aluno', senhaField.value);
            }
            
            // Debug: Mostrar todos os dados do FormData
            console.log('FormData enviado:');
            for (let [key, value] of formData.entries()) {
                console.log(key + ':', value);
            }
            
            fetch('../controller/updateAluno.php', {
                method: 'POST',
                body: formData
            })
            .then(response => {
                console.log('Response status:', response.status);
                console.log('Response headers:', response.headers);
                
                // Verificar se a resposta é JSON
                const contentType = response.headers.get('content-type');
                console.log('Content-Type:', contentType);
                
                if (contentType && contentType.includes('application/json')) {
                    return response.json();
                } else {
                    // Se não for JSON, ler como texto para debug
                    return response.text().then(text => {
                        console.log('Resposta não-JSON recebida:', text);
                        
                        // Se a resposta for bem-sucedida mas não JSON, assumir sucesso
                        if (response.ok) {
                            return { success: true };
                        } else {
                            throw new Error('Resposta não-JSON e não bem-sucedida: ' + text);
                        }
                    });
                }
            })
            .then(data => {
                console.log('Dados recebidos:', data);
                
                if (data.success !== false) {
                    alert('Aluno atualizado com sucesso!');
                    fecharModalEditarAluno();
                    // Recarregar a página para mostrar as mudanças
                    window.location.reload();
                } else {
                    alert('Erro ao atualizar aluno: ' + (data.message || 'Erro desconhecido'));
                    console.error('Erro na atualização:', data);
                }
            })
            .catch(error => {
                console.error('Erro completo:', error);
                console.error('Stack trace:', error.stack);
                alert('Erro ao atualizar aluno. Verifique o console para mais detalhes.');
            })
            .finally(() => {
                // Restaurar botão
                btnSubmit.textContent = textoOriginal;
                btnSubmit.disabled = false;
                console.log('=== FIM SUBMISSÃO FORMULÁRIO ===');
            });
        });
    }
}

// Fechar modal ao clicar fora dele
document.addEventListener('click', function(e) {
    const modal = document.getElementById('modal-editar-aluno');
    if (e.target === modal) {
        fecharModalEditarAluno();
    }
});

// Fechar modal com ESC
document.addEventListener('keydown', function(e) {
    if (e.key === 'Escape') {
        const modal = document.getElementById('modal-editar-aluno');
        if (modal && modal.classList.contains('show')) {
            fecharModalEditarAluno();
        }
    }
});

// Função para navegar entre seções (manter funcionalidade existente)
function navigateToSection(sectionId) {
    const sections = document.querySelectorAll('.content-section');
    sections.forEach(section => {
        section.classList.remove('active');
    });

    const activeSection = document.getElementById(sectionId);
    if (activeSection) {
        activeSection.classList.add('active');
    }

    const menuItems = document.querySelectorAll('.menu-item');
    menuItems.forEach(item => {
        item.classList.remove('active');
        if (item.getAttribute('data-section') === sectionId) {
            item.classList.add('active');

            const parent = item.parentElement;
            if (parent.classList.contains('submenu')) {
                parent.classList.add('open');
            }
        }
    });
}

// Gerenciamento de abas (manter funcionalidade existente)
document.addEventListener('DOMContentLoaded', function() {
    const tabItems = document.querySelectorAll('.tab-item');
    tabItems.forEach(item => {
        item.addEventListener('click', function () {
            const tabId = this.getAttribute('data-tab');

            document.querySelectorAll('.tab-item').forEach(tab => {
                tab.classList.remove('active');
            });
            document.querySelectorAll('.tab-content').forEach(content => {
                content.classList.remove('active');
            });

            this.classList.add('active');
            const targetContent = document.getElementById(tabId);
            if (targetContent) {
                targetContent.classList.add('active');
            }
        });
    });
});