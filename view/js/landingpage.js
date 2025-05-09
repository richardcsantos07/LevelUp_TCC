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