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

                // Se a seção for "configuracoes", carregar dados da instituição
                if (sectionId === 'configuracoes') {
                    carregarDadosInstituicao();
                }
            }
        });
    });

    // Inicializar eventos de edição de aluno após o DOM estar carregado
    inicializarEventosEdicaoAluno();
    
    // Inicializar eventos de edição de professor após o DOM estar carregado
    inicializarEventosEdicaoProfessor();
    
    // Inicializar eventos dos formulários de edição
    inicializarFormularioEdicaoAluno();
    inicializarFormularioEdicaoProfessor();

    // Carregar dados da instituição ao carregar a página, se a seção "configuracoes" estiver ativa
    if (document.getElementById('configuracoes').classList.contains('active')) {
        carregarDadosInstituicao();
    }

    // Inicializar formulário de configurações
    inicializarFormularioConfiguracoes();
});

// ==================== FUNÇÕES PARA ALUNOS ====================

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

// ==================== FUNÇÕES PARA INSTITUIÇÃO ====================

// Função para carregar dados da instituição e preencher o formulário de configurações
function carregarDadosInstituicao() {
    fetch('../controller/getInst.php')
        .then(response => {
            if (!response.ok) {
                throw new Error('Erro ao buscar dados da instituição: ' + response.status);
            }
            return response.json();
        })
        .then(data => {
            if (data.success) {
                preencherFormularioConfiguracoes(data.instituicao);
            } else {
                alert('Erro: ' + data.message);
            }
        })
        .catch(error => {
            console.error('Erro ao carregar dados da instituição:', error);
            alert('Erro ao carregar dados da instituição.');
        });
}

// Função para preencher o formulário de configurações com os dados da instituição
function preencherFormularioConfiguracoes(instituicao) {
    document.getElementById('nome-instituicao').value = instituicao.nome || '';
    document.getElementById('email-contato').value = instituicao.email || '';
    document.getElementById('telefone-contato').value = instituicao.telefone || '';
    document.getElementById('cep').value = instituicao.cep || '';
    document.getElementById('estado').value = instituicao.estado || '';
    document.getElementById('bairro').value = instituicao.bairro || '';
    document.getElementById('rua').value = instituicao.rua || '';
    document.getElementById('num').value = instituicao.num || '';
    document.getElementById('senha-instituicao').value = '';
}

// Função para inicializar o formulário de configurações
function inicializarFormularioConfiguracoes() {
    const formConfiguracoes = document.getElementById('form-configuracoes');
    if (formConfiguracoes) {
        formConfiguracoes.addEventListener('submit', function(e) {
            e.preventDefault();

            // Validação básica
            const nome = document.getElementById('nome-instituicao').value.trim();
            const email = document.getElementById('email-contato').value.trim();

            if (!nome || !email) {
                alert('Por favor, preencha os campos obrigatórios: Nome da Instituição e E-mail.');
                return;
            }

            // Mostrar indicador de carregamento
            const btnSubmit = this.querySelector('button[type="submit"]');
            const textoOriginal = btnSubmit.textContent;
            btnSubmit.textContent = 'Atualizando...';
            btnSubmit.disabled = true;

            // Criar FormData com os dados do formulário
            const formData = new FormData();
            formData.append('nome-instituicao', nome);
            formData.append('email-contato', email);
            formData.append('telefone-contato', document.getElementById('telefone-contato').value.trim());
            formData.append('cep', document.getElementById('cep').value.trim());
            formData.append('estado', document.getElementById('estado').value.trim());
            formData.append('bairro', document.getElementById('bairro').value.trim());
            formData.append('rua', document.getElementById('rua').value.trim());
            formData.append('num', document.getElementById('num').value.trim());
            formData.append('senha-instituicao', document.getElementById('senha-instituicao').value);

            fetch('../controller/updateInst.php', {
                method: 'POST',
                body: formData
            })
            .then(response => {
                if (!response.ok) {
                    throw new Error('Erro na resposta do servidor: ' + response.status);
                }
                return response.json();
            })
            .then(data => {
                if (data.success) {
                    alert('Configurações atualizadas com sucesso!');
                    // Recarregar dados para garantir atualização
                    carregarDadosInstituicao();
                } else {
                    alert('Erro ao atualizar configurações: ' + data.message);
                }
            })
            .catch(error => {
                console.error('Erro ao atualizar configurações:', error);
                alert('Erro ao atualizar configurações.');
            })
            .finally(() => {
                btnSubmit.textContent = textoOriginal;
                btnSubmit.disabled = false;
            });
        });
    }
}

// Função para abrir modal de edição de aluno
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
                preencherFormularioEdicaoAluno(data.aluno);
                
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

// Função para preencher formulário de edição de aluno
function preencherFormularioEdicaoAluno(aluno) {
    console.log('Preenchendo formulário de aluno com:', aluno);
    
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
        
        console.log('Formulário de aluno preenchido com sucesso');
    } catch (error) {
        console.error('Erro ao preencher formulário de aluno:', error);
        alert('Erro ao preencher formulário. Verifique o console.');
    }
}

// Função para fechar modal de edição de aluno
function fecharModalEditarAluno() {
    const modal = document.getElementById('modal-editar-aluno');
    modal.classList.remove('show');
    document.body.style.overflow = 'auto'; // Restaura scroll da página
    
    // Limpar formulário
    document.getElementById('form-editar-aluno').reset();
}

// Função para inicializar o formulário de edição de aluno
function inicializarFormularioEdicaoAluno() {
    const formEditarAluno = document.getElementById('form-editar-aluno');
    if (formEditarAluno) {
        formEditarAluno.addEventListener('submit', function(e) {
            e.preventDefault();
            
            console.log('=== INÍCIO SUBMISSÃO FORMULÁRIO ALUNO ===');
            
            // Validação básica antes de enviar
            const ra = document.getElementById('edit-ra-aluno').value.trim();
            const nome = document.getElementById('edit-nome-aluno').value.trim();
            const email = document.getElementById('edit-email-aluno').value.trim();
            const telefone = document.getElementById('edit-telefone-aluno').value.trim();
            const dataNasc = document.getElementById('edit-data-nascimento').value;
            
            console.log('Dados do formulário de aluno:');
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
            
            // Criar FormData manualmente com os nomes corretos
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
            console.log('FormData de aluno enviado:');
            for (let [key, value] of formData.entries()) {
                console.log(key + ':', value);
            }
            
            fetch('../controller/updateAluno.php', {
                method: 'POST',
                body: formData
            })
            .then(response => {
                console.log('Response status:', response.status);
                
                const contentType = response.headers.get('content-type');
                console.log('Content-Type:', contentType);
                
                if (contentType && contentType.includes('application/json')) {
                    return response.json();
                } else {
                    return response.text().then(text => {
                        console.log('Resposta não-JSON recebida:', text);
                        
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
                    window.location.reload();
                } else {
                    alert('Erro ao atualizar aluno: ' + (data.message || 'Erro desconhecido'));
                    console.error('Erro na atualização:', data);
                }
            })
            .catch(error => {
                console.error('Erro completo:', error);
                alert('Erro ao atualizar aluno. Verifique o console para mais detalhes.');
            })
            .finally(() => {
                btnSubmit.textContent = textoOriginal;
                btnSubmit.disabled = false;
                console.log('=== FIM SUBMISSÃO FORMULÁRIO ALUNO ===');
            });
        });
    }
}

// ==================== FUNÇÕES PARA PROFESSORES ====================

// Função para inicializar eventos de edição de professor
function inicializarEventosEdicaoProfessor() {
    const botoesEditar = document.querySelectorAll('.btn-editar-professor');
    botoesEditar.forEach(botao => {
        botao.addEventListener('click', function() {
            const professorId = this.getAttribute('data-id');
            abrirModalEditarProfessor(professorId);
        });
    });
}

// Função para abrir modal de edição de professor
function abrirModalEditarProfessor(professorId) {
    console.log('Abrindo modal para professor ID:', professorId);
    
    // Buscar dados do professor
    fetch(`../controller/getProfessor.php?id=${professorId}`)
        .then(response => {
            console.log('Response getProfessor status:', response.status);
            if (!response.ok) {
                throw new Error('Erro na resposta do servidor: ' + response.status);
            }
            return response.json();
        })
        .then(data => {
            console.log('Dados do professor recebidos:', data);
            
            if (data.success) {
                // Preencher o formulário com os dados do professor
                preencherFormularioEdicaoProfessor(data.professor);
                
                // Mostrar o modal
                const modal = document.getElementById('modal-editar-professor');
                modal.classList.add('show');
                document.body.style.overflow = 'hidden';
            } else {
                alert('Erro ao carregar dados do professor: ' + data.message);
                console.error('Erro nos dados:', data);
            }
        })
        .catch(error => {
            console.error('Erro ao buscar professor:', error);
            alert('Erro ao carregar dados do professor');
        });
}

// Função para preencher formulário de edição de professor
function preencherFormularioEdicaoProfessor(professor) {
    console.log('Preenchendo formulário de professor com:', professor);
    
    try {
        document.getElementById('edit-id-professor').value = professor.id || '';
        document.getElementById('edit-nome-professor').value = professor.nome || '';
        document.getElementById('edit-email-professor').value = professor.email || '';
        document.getElementById('edit-telefone-professor').value = professor.telefone || professor.tell || '';
        document.getElementById('edit-data-nascimento-professor').value = professor.dataNasc || '';
        document.getElementById('edit-materia-professor').value = professor.materia || '';
        document.getElementById('edit-cpf-professor').value = professor.cpf || '';
        
        console.log('Formulário de professor preenchido com sucesso');
    } catch (error) {
        console.error('Erro ao preencher formulário de professor:', error);
        alert('Erro ao preencher formulário. Verifique o console.');
    }
}

// Função para fechar modal de edição de professor
function fecharModalEditarProfessor() {
    const modal = document.getElementById('modal-editar-professor');
    modal.classList.remove('show');
    document.body.style.overflow = 'auto'; // Restaura scroll da página
    
    // Limpar formulário
    document.getElementById('form-editar-professor').reset();
}

// Função para inicializar o formulário de edição de professor
function inicializarFormularioEdicaoProfessor() {
    const formEditarProfessor = document.getElementById('form-editar-professor');
    if (formEditarProfessor) {
        formEditarProfessor.addEventListener('submit', function(e) {
            e.preventDefault();
            
            console.log('=== INÍCIO SUBMISSÃO FORMULÁRIO PROFESSOR ===');
            
            // Validação básica antes de enviar
            const id = document.getElementById('edit-id-professor').value.trim();
            const nome = document.getElementById('edit-nome-professor').value.trim();
            const email = document.getElementById('edit-email-professor').value.trim();
            const telefone = document.getElementById('edit-telefone-professor').value.trim();
            const dataNasc = document.getElementById('edit-data-nascimento-professor').value;
            const materia = document.getElementById('edit-materia-professor').value.trim();
            const cpf = document.getElementById('edit-cpf-professor').value.trim();
            
            console.log('Dados do formulário de professor:');
            console.log('ID:', id);
            console.log('Nome:', nome);
            console.log('Email:', email);
            console.log('Telefone:', telefone);
            console.log('Data Nasc:', dataNasc);
            console.log('Materia:', materia);
            console.log('CPF:', cpf);
            
            if (!nome || !email || !id || !dataNasc) {
                alert('Por favor, preencha todos os campos obrigatórios.');
                return;
            }
            
            // Mostrar indicador de carregamento
            const btnSubmit = this.querySelector('button[type="submit"]');
            const textoOriginal = btnSubmit.textContent;
            btnSubmit.textContent = 'Atualizando...';
            btnSubmit.disabled = true;
            
            // Criar FormData manualmente com os nomes corretos
            const formData = new FormData();
            formData.append('id-professor', document.getElementById('edit-id-professor').value);
            formData.append('nome-professor', document.getElementById('edit-nome-professor').value);
            formData.append('email-professor', document.getElementById('edit-email-professor').value);
            formData.append('telefone-professor', document.getElementById('edit-telefone-professor').value);
            formData.append('data-nascimento', document.getElementById('edit-data-nascimento-professor').value);
            formData.append('materia-professor', document.getElementById('edit-materia-professor').value);
            formData.append('cpf-professor', document.getElementById('edit-cpf-professor').value);
            
            // Adicionar senha se fornecida
            const senhaField = document.getElementById('edit-senha-professor');
            if (senhaField && senhaField.value.trim()) {
                formData.append('senha-professor', senhaField.value);
            }
            
            // Debug: Mostrar todos os dados do FormData
            console.log('FormData de professor enviado:');
            for (let [key, value] of formData.entries()) {
                console.log(key + ':', value);
            }
            
            fetch('../controller/updateProf.php', {
                method: 'POST',
                body: formData
            })
            .then(response => {
                console.log('Response status:', response.status);
                
                const contentType = response.headers.get('content-type');
                console.log('Content-Type:', contentType);
                
                if (contentType && contentType.includes('application/json')) {
                    return response.json();
                } else {
                    return response.text().then(text => {
                        console.log('Resposta não-JSON recebida:', text);
                        
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
                    alert('Professor atualizado com sucesso!');
                    fecharModalEditarProfessor();
                    window.location.reload();
                } else {
                    alert('Erro ao atualizar professor: ' + (data.message || 'Erro desconhecido'));
                    console.error('Erro na atualização:', data);
                }
            })
            .catch(error => {
                console.error('Erro completo:', error);
                alert('Erro ao atualizar professor. Verifique o console para mais detalhes.');
            })
            .finally(() => {
                btnSubmit.textContent = textoOriginal;
                btnSubmit.disabled = false;
                console.log('=== FIM SUBMISSÃO FORMULÁRIO PROFESSOR ===');
            });
        });
    }
}

// ==================== FUNÇÕES GERAIS ====================

// Fechar modais ao clicar fora deles
document.addEventListener('click', function(e) {
    // Modal de aluno
    const modalAluno = document.getElementById('modal-editar-aluno');
    if (e.target === modalAluno) {
        fecharModalEditarAluno();
    }
    
    // Modal de professor
    const modalProfessor = document.getElementById('modal-editar-professor');
    if (e.target === modalProfessor) {
        fecharModalEditarProfessor();
    }
});

// Fechar modais com ESC
document.addEventListener('keydown', function(e) {
    if (e.key === 'Escape') {
        const modalAluno = document.getElementById('modal-editar-aluno');
        const modalProfessor = document.getElementById('modal-editar-professor');
        
        if (modalAluno && modalAluno.classList.contains('show')) {
            fecharModalEditarAluno();
        }
        
        if (modalProfessor && modalProfessor.classList.contains('show')) {
            fecharModalEditarProfessor();
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