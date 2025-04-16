// Captura o clique no link e volta para a página anterior
document.getElementById('backLink').addEventListener('click', function(event) {
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

// Adiciona listeners para os toggles
document.querySelectorAll('.toggle-switch input').forEach(toggle => {
    toggle.addEventListener('change', (e) => {
        console.log(`Toggle ${e.target.checked ? 'ativado' : 'desativado'}`);
        // Aqui você pode adicionar a lógica para salvar as configurações
    });
});

// Adiciona listener para o formulário de senha
const passwordButton = document.querySelector('.button');
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