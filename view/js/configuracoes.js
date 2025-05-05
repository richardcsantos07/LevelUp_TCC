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

// Adiciona listener para o formulário de senha
const passwordButton = document.querySelector('.button');
if (passwordButton) {
    passwordButton.addEventListener('click', () => {
        const currentPassword = document.getElementById('current-password').value;
        const newPassword = document.getElementById('new-password').value;
        const confirmPassword = document.getElementById('confirm-password').value;

        if (newPassword !== confirmPassword) {
            alert('As senhas não coincidem!');
            return;
        }

        if (newPassword.length < 6) {
            alert('A senha deve ter pelo menos 6 caracteres!');
            return;
        }

        console.log('Senha alterada com sucesso!');
        // Aqui você pode adicionar a lógica para alterar a senha

        // Limpa os campos após o sucesso
        document.getElementById('current-password').value = '';
        document.getElementById('new-password').value = '';
        document.getElementById('confirm-password').value = '';
    });
}