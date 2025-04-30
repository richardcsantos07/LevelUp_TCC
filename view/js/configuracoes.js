// Alternar entre abas
const menuItems = document.querySelectorAll('.menu-item');
const contents = document.querySelectorAll('.content');

menuItems.forEach(item => {
  item.addEventListener('click', () => {
    menuItems.forEach(i => i.classList.remove('active'));
    item.classList.add('active');

    contents.forEach(c => c.classList.remove('active'));
    const selected = item.getAttribute('data-content');
    document.getElementById(selected).classList.add('active');
  });
});


// Tema escuro/claro
document.getElementById('theme').addEventListener('change', function () {
  const theme = this.value;
  if (theme === 'dark') {
    document.body.classList.add('dark-mode');
  } else {
    document.body.classList.remove('dark-mode');
  }
});



