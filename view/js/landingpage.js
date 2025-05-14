document.addEventListener('DOMContentLoaded', function() {
    // Navegação suave para links de âncora
    document.querySelectorAll('a[href^="#"]').forEach(anchor => {
        anchor.addEventListener('click', function(e) {
            e.preventDefault();
            const targetId = this.getAttribute('href');
            if (targetId !== '#') {
                const targetElement = document.querySelector(targetId);
                if (targetElement) {
                    window.scrollTo({
                        top: targetElement.offsetTop - 80,
                        behavior: 'smooth'
                    });
                }
            }
        });
    });

    // Header fixo com mudança de estilo ao rolar
    const header = document.querySelector('header');
    window.addEventListener('scroll', function() {
        if (window.scrollY > 100) {
            header.style.backgroundColor = 'rgba(36, 41, 46, 0.95)';
            header.style.boxShadow = '0 2px 10px rgba(0, 0, 0, 0.1)';
        } else {
            header.style.backgroundColor = 'var(--dark)';
            header.style.boxShadow = '0 1px 3px var(--shadow)';
        }
    });

    // Animação para elementos ao entrar na viewport
    const animateOnScroll = function() {
        const elements = document.querySelectorAll('.feature-card, .game-card, .testimonial-card, .stat-item');
        
        elements.forEach(element => {
            const position = element.getBoundingClientRect();
            
            // Verifica se o elemento está visível na tela
            if (position.top < window.innerHeight && position.bottom >= 0) {
                element.style.opacity = '1';
                element.style.transform = 'translateY(0)';
            }
        });
    };

    // Configuração inicial para animação
    const setupAnimations = function() {
        const elements = document.querySelectorAll('.feature-card, .game-card, .testimonial-card, .stat-item');
        
        elements.forEach(element => {
            element.style.opacity = '0';
            element.style.transform = 'translateY(20px)';
            element.style.transition = 'opacity 0.6s ease, transform 0.6s ease';
        });
        
        // Primeira verificação
        animateOnScroll();
        
        // Adiciona evento de rolagem
        window.addEventListener('scroll', animateOnScroll);
    };
    
    setupAnimations();
    
    // Carrossel de depoimentos
    const testimonials = document.querySelector('.testimonials');
    let isDown = false;
    let startX;
    let scrollLeft;

    testimonials.addEventListener('mousedown', (e) => {
        isDown = true;
        testimonials.style.cursor = 'grabbing';
        startX = e.pageX - testimonials.offsetLeft;
        scrollLeft = testimonials.scrollLeft;
    });

    testimonials.addEventListener('mouseleave', () => {
        isDown = false;
        testimonials.style.cursor = 'grab';
    });

    testimonials.addEventListener('mouseup', () => {
        isDown = false;
        testimonials.style.cursor = 'grab';
    });

    testimonials.addEventListener('mousemove', (e) => {
        if (!isDown) return;
        e.preventDefault();
        const x = e.pageX - testimonials.offsetLeft;
        const walk = (x - startX) * 2;
        testimonials.scrollLeft = scrollLeft - walk;
    });
    
    // Efeito de hover para os botões de jogos
    const gameButtons = document.querySelectorAll('.game-button');
    gameButtons.forEach(button => {
        button.addEventListener('mouseover', function() {
            this.style.transform = 'scale(1.05)';
        });
        
        button.addEventListener('mouseout', function() {
            this.style.transform = 'scale(1)';
        });
    });
    
    // Modal de login/registro (simulado)
    const authButtons = document.querySelectorAll('.auth-buttons .btn, .cta-buttons .btn');
    authButtons.forEach(button => {
        button.addEventListener('click', function() {
            alert('Sistema de login/registro em desenvolvimento. Em breve você poderá criar sua conta!');
        });
    });
    
    // Botões de "Jogar" e "Comprar" (simulado)
    const actionButtons = document.querySelectorAll('.game-button');
    actionButtons.forEach(button => {
        button.addEventListener('click', function() {
            const gameTitle = this.closest('.game-card').querySelector('.game-title').textContent;
            const action = this.textContent.toLowerCase();
            
            if (action === 'jogar') {
                alert(`Preparando para iniciar "${gameTitle}". Em breve o jogo será carregado!`);
            } else if (action === 'comprar') {
                alert(`Adicionando "${gameTitle}" ao carrinho. Continue para finalizar a compra!`);
            }
        });
    });
    
    // Contador de estatísticas animado
    const stats = document.querySelectorAll('.stat-number');
    let animated = false;
    
    function animateStats() {
        if (animated) return;
        
        const statsSection = document.querySelector('.community-stats');
        const position = statsSection.getBoundingClientRect();
        
        if (position.top < window.innerHeight && position.bottom >= 0) {
            stats.forEach(stat => {
                const target = stat.getAttribute('data-count') || stat.textContent;
                const stripped = target.replace(/\D/g, '');
                const targetNumber = parseInt(stripped, 10);
                let count = 0;
                const duration = 2000; // 2 segundos
                const interval = 50; // atualização a cada 50ms
                const increment = Math.ceil(targetNumber / (duration / interval));
                
                const counter = setInterval(() => {
                    count += increment;
                    if (count >= targetNumber) {
                        stat.textContent = target; // Usa o formato original com "+" ou "K+"
                        clearInterval(counter);
                    } else {
                        if (target.includes('M')) {
                            stat.textContent = Math.floor(count / 1000000) + 'M+';
                        } else if (target.includes('K')) {
                            stat.textContent = Math.floor(count / 1000) + 'K+';
                        } else {
                            stat.textContent = count + '+';
                        }
                    }
                }, interval);
            });
            
            animated = true;
            window.removeEventListener('scroll', animateStats);
        }
    }
    
    window.addEventListener('scroll', animateStats);
    // Verificação inicial
    animateStats();
});
// Adicionar botão no header
const header = document.querySelector('.header-container');
const themeToggle = document.createElement('button');
themeToggle.className = 'theme-toggle';
themeToggle.innerHTML = '<i class="fas fa-moon"></i>';
themeToggle.setAttribute('aria-label', 'Alternar tema');
themeToggle.setAttribute('title', 'Alternar tema');

// Inserir antes dos botões de autenticação
const authButtons = document.querySelector('.auth-buttons');
header.insertBefore(themeToggle, authButtons);

// Função para alternar o tema
function toggleTheme() {
  const body = document.body;
  if (body.classList.contains('dark-theme')) {
    body.classList.remove('dark-theme');
    themeToggle.innerHTML = '<i class="fas fa-moon"></i>';
    localStorage.setItem('theme', 'light');
  } else {
    body.classList.add('dark-theme');
    themeToggle.innerHTML = '<i class="fas fa-sun"></i>';
    localStorage.setItem('theme', 'dark');
  }
}

// Verificar e aplicar o tema salvo
document.addEventListener('DOMContentLoaded', () => {
  const savedTheme = localStorage.getItem('theme');
  if (savedTheme === 'dark') {
    document.body.classList.add('dark-theme');
    themeToggle.innerHTML = '<i class="fas fa-sun"></i>';
  }
});

// Adicionar evento de clique para o toggle
themeToggle.addEventListener('click', toggleTheme);
// Criar o elemento de destaque para navegação
document.addEventListener('DOMContentLoaded', function() {
  const navMenu = document.querySelector('.nav-menu');
  const navItems = document.querySelectorAll('.nav-menu a');
  
  // Adicionar o elemento de destaque
  const highlight = document.createElement('span');
  highlight.className = 'nav-highlight';
  navMenu.appendChild(highlight);
  
  // Adicionar item de dropdown para categorias de jogos
  const gamesLink = document.querySelector('.nav-menu a[href="#games"]').parentElement;
  gamesLink.classList.add('dropdown');
  gamesLink.innerHTML = `
    <a href="#games">Jogos <i class="fas fa-chevron-down"></i></a>
    <div class="dropdown-content">
      <a href="#action">Ação</a>
      <a href="#adventure">Aventura</a>
      <a href="#rpg">RPG</a>
      <a href="#strategy">Estratégia</a>
      <a href="#puzzle">Puzzle</a>
    </div>
  `;
  
  // Função para atualizar o destaque
  function updateHighlight(target) {
    const linkRect = target.getBoundingClientRect();
    const navRect = navMenu.getBoundingClientRect();
    
    highlight.style.width = `${linkRect.width}px`;
    highlight.style.left = `${linkRect.left - navRect.left}px`;
    highlight.style.opacity = '1';
  }
  
  // Manipular eventos de hover
  navItems.forEach(item => {
    item.addEventListener('mouseenter', function() {
      updateHighlight(this);
    });
  });
  
  navMenu.addEventListener('mouseleave', function() {
    highlight.style.opacity = '0';
  });
  
  // Detectar o item ativo com base na rolagem
  const sections = document.querySelectorAll('section[id]');
  
  function highlightActiveNavItem() {
    const scrollPos = window.scrollY;
    
    sections.forEach(section => {
      const sectionTop = section.offsetTop - 100;
      const sectionHeight = section.offsetHeight;
      const sectionId = section.getAttribute('id');
      
      if (scrollPos >= sectionTop && scrollPos < sectionTop + sectionHeight) {
        const activeNavItem = document.querySelector(`.nav-menu a[href="#${sectionId}"]`);
        if (activeNavItem) {
          navItems.forEach(item => item.classList.remove('active'));
          activeNavItem.classList.add('active');
          updateHighlight(activeNavItem);
        }
      }
    });
  }
  
  window.addEventListener('scroll', highlightActiveNavItem);
  
  // Dropdown em dispositivos móveis
  const dropdowns = document.querySelectorAll('.nav-menu .dropdown');
  
  if (window.innerWidth <= 768) {
    dropdowns.forEach(dropdown => {
      const link = dropdown.querySelector('a');
      link.addEventListener('click', function(e) {
        e.preventDefault();
        dropdown.classList.toggle('active');
      });
    });
  }
  
  // Mobile menu toggle
  const mobileMenuToggle = document.querySelector('.mobile-menu-toggle') || 
    document.createElement('button'); // Cria se não existir
  
  if (!document.querySelector('.mobile-menu-toggle')) {
    mobileMenuToggle.className = 'mobile-menu-toggle';
    mobileMenuToggle.innerHTML = '<i class="fas fa-bars"></i>';
    document.querySelector('.header-container').insertBefore(
      mobileMenuToggle, 
      document.querySelector('.nav-menu')
    );
  }
  
  mobileMenuToggle.addEventListener('click', function() {
    navMenu.classList.toggle('active');
    this.innerHTML = navMenu.classList.contains('active') 
      ? '<i class="fas fa-times"></i>' 
      : '<i class="fas fa-bars"></i>';
  });
});
// Adicionar efeito parallax para a seção hero
document.addEventListener('DOMContentLoaded', function() {
  const hero = document.querySelector('.hero');
  
  // Adicionar elementos para o efeito parallax
  const particles = document.createElement('div');
  particles.className = 'hero-particles';
  
  // Criar 50 partículas
  for (let i = 0; i < 50; i++) {
    const particle = document.createElement('div');
    particle.className = 'particle';
    
    // Posições e tamanhos aleatórios
    const size = Math.random() * 8 + 2; // Entre 2 e 10px
    particle.style.width = size + 'px';
    particle.style.height = size + 'px';
    particle.style.left = Math.random() * 100 + '%';
    particle.style.top = Math.random() * 100 + '%';
    
    // Velocidade de animação aleatória
    particle.style.animationDuration = (Math.random() * 20 + 10) + 's';
    
    // Atraso de início aleatório
    particle.style.animationDelay = (Math.random() * 5) + 's';
    
    // Opacidade aleatória
    particle.style.opacity = Math.random() * 0.5 + 0.1;
    
    particles.appendChild(particle);
  }
  
  // Adicionar ao hero antes de qualquer outro elemento
  hero.insertBefore(particles, hero.firstChild);
  
  // Adicionar código shapes flutuantes
  const shapes = document.createElement('div');
  shapes.className = 'floating-shapes';
  
  // Array de formas possíveis
  const shapeClasses = ['shape-1', 'shape-2', 'shape-3'];
  
  // Criar as formas
  for (let i = 0; i < 6; i++) {
    const shape = document.createElement('div');
    shape.className = 'shape ' + shapeClasses[i % shapeClasses.length];
    shapes.appendChild(shape);
  }
  
  // Adicionar ao hero
  hero.insertBefore(shapes, hero.firstChild);
  
  // Função para parallax conforme rolagem
  window.addEventListener('scroll', function() {
    const scrollPosition = window.scrollY;
    
    if (scrollPosition < window.innerHeight) {
      const translateY = scrollPosition * 0.4;
      hero.style.backgroundPositionY = -translateY + 'px';
      
      // Efeito parallax nas partículas
      particles.style.transform = `translateY(${scrollPosition * 0.2}px)`;
      
      // Efeito no texto do hero
      const heroText = document.querySelector('.hero-text');
      if (heroText) {
        heroText.style.transform = `translateY(${scrollPosition * 0.1}px)`;
      }
      
      // Efeito na imagem do hero
      const heroImage = document.querySelector('.hero-image');
      if (heroImage) {
        heroImage.style.transform = `translateY(${scrollPosition * 0.15}px) rotate(${scrollPosition * 0.01}deg)`;
      }
    }
  });
  
  // Adicionar efeito de digitação no hero title
  const heroTitle = document.querySelector('.hero-title');
  if (heroTitle) {
    const originalText = heroTitle.textContent;
    heroTitle.textContent = '';
    heroTitle.style.borderRight = '0.1em solid var(--primary-light)';
    
    let i = 0;
    const typeWriter = () => {
      if (i < originalText.length) {
        heroTitle.textContent += originalText.charAt(i);
        i++;
        setTimeout(typeWriter, 100);
      } else {
        // Remover cursor piscante após a digitação
        setTimeout(() => {
          heroTitle.style.borderRight = 'none';
        }, 1000);
      }
    };
    
    // Iniciar o efeito após um pequeno atraso
    setTimeout(typeWriter, 500);
  }
});