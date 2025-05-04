// Captura o clique no link e volta para a página anterior
document.querySelector('.back-link').addEventListener('click', function(event) {
    event.preventDefault(); // Evita o comportamento padrão do link
    window.history.back();  // Volta à página anterior
});

// Seleciona todos os itens do menu
const menuItems = document.querySelectorAll('.menu-item');
const contents = document.querySelectorAll('.content');

// Adiciona evento de clique para cada item do menu
menuItems.forEach(item => {
    item.addEventListener('click', () => {
        // Remove a classe active de todos os itens e conteúdos
        menuItems.forEach(i => i.classList.remove('active'));
        contents.forEach(c => c.classList.remove('active'));

        // Adiciona a classe active ao item clicado
        item.classList.add('active');

        // Mostra o conteúdo correspondente
        const contentId = item.getAttribute('data-content');
        document.getElementById(contentId).classList.add('active');
    });
});

// Função para aplicar o tema selecionado
function applyTheme(theme) {
    if (theme === 'dark') {
        document.body.classList.add('dark-mode');
        localStorage.setItem('theme', 'dark');
    } else {
        document.body.classList.remove('dark-mode');
        localStorage.setItem('theme', 'light');
    }
}

// Adiciona evento para mudança de tema
document.getElementById('theme').addEventListener('change', function() {
    applyTheme(this.value);
});

// Carrega o tema salvo ao carregar a página
document.addEventListener('DOMContentLoaded', function() {
    const savedTheme = localStorage.getItem('theme') || 'light';
    document.getElementById('theme').value = savedTheme;
    applyTheme(savedTheme);
    
    // Carrega as informações do usuário (simulando dados iniciais)
    loadUserProfile();
});

// Adiciona evento para mudança de idioma
document.getElementById('language').addEventListener('change', function() {
    localStorage.setItem('language', this.value);
    // Aqui você pode adicionar lógica para mudar o idioma
    console.log(`Idioma alterado para: ${this.value}`);
});

// Carrega o idioma salvo ao carregar a página
document.addEventListener('DOMContentLoaded', function() {
    const savedLanguage = localStorage.getItem('language') || 'pt-BR';
    document.getElementById('language').value = savedLanguage;
});

// Adiciona listeners para os toggles
document.querySelectorAll('.toggle-switch input').forEach(toggle => {
    toggle.addEventListener('change', (e) => {
        console.log(`Toggle ${e.target.checked ? 'ativado' : 'desativado'}`);
        // Aqui você pode adicionar a lógica para salvar as configurações
    });
});

// Função para carregar o perfil do usuário (simulação)
function loadUserProfile() {
    // Esta função seria substituída pela lógica real para carregar dados do aluno
    console.log('Carregando dados do aluno...');
    
    // Simulação de dados para exibição - você substituirá isso pela sua lógica real
    setTimeout(() => {
        // Dados de exemplo - aqui você faria uma chamada para seu backend
        const dadosAluno = {
            nome: "Maria Silva",
            email: "maria.silva@aluno.escolaexemplo.com.br",
            dataNascimento: "15/04/2012",
            ra: "20230147",
            serie: "5º Ano",
            turma: "Turma B"
        };
        
        // Atualiza os campos na interface
        document.getElementById('user-name').textContent = dadosAluno.nome;
        document.getElementById('user-email').textContent = dadosAluno.email;
        document.getElementById('user-birth').textContent = dadosAluno.dataNascimento;
        document.getElementById('user-ra').textContent = dadosAluno.ra;
        document.getElementById('user-serie').textContent = dadosAluno.serie;
        document.getElementById('user-turma').textContent = dadosAluno.turma;
        
        // Aqui você também pode atualizar a imagem de perfil
        // document.getElementById('profile-image').src = dadosAluno.fotoUrl;
        
        console.log('Dados do aluno carregados com sucesso');
    }, 500); // Simulação de tempo de carregamento
}