// Navbar scroll effect
window.addEventListener('scroll', function() {
    const navbar = document.getElementById('navbar');
    if (window.scrollY > 50) {
        navbar.classList.add('scrolled');
    } else {
        navbar.classList.remove('scrolled');
    }
});

// Mobile menu toggle
const menuToggle = document.getElementById('menuToggle');
const navLinks = document.getElementById('navLinks');

menuToggle.addEventListener('click', function() {
    menuToggle.classList.toggle('active');
    navLinks.classList.toggle('active');
});

// Close mobile menu on link click
document.querySelectorAll('.nav-links a').forEach(link => {
    link.addEventListener('click', function() {
        menuToggle.classList.remove('active');
        navLinks.classList.remove('active');
    });
});

// Modal functionality
const modals = {
    login: document.getElementById('loginModal'),
    register: document.getElementById('registerModal'),
    demo: document.getElementById('demoModal')
};

const modalTriggers = {
    login: document.getElementById('loginBtn'),
    register: document.getElementById('registerBtn'),
    demo: document.getElementById('demoBtn'),
    ctaDemo: document.getElementById('ctaDemoBtn')
};

// Open modals
modalTriggers.login.addEventListener('click', () => openModal('login'));
modalTriggers.register.addEventListener('click', () => openModal('register'));
modalTriggers.demo.addEventListener('click', () => openModal('demo'));
modalTriggers.ctaDemo.addEventListener('click', () => openModal('demo'));

function openModal(modalType) {
    modals[modalType].classList.add('active');
    document.body.style.overflow = 'hidden';
}

// Close modals
document.querySelectorAll('.modal-close, .modal-close-btn').forEach(btn => {
    btn.addEventListener('click', function() {
        const modal = this.closest('.modal');
        modal.classList.remove('active');
        document.body.style.overflow = 'auto';
    });
});

// Close modal when clicking outside
window.addEventListener('click', function(e) {
    Object.values(modals).forEach(modal => {
        if (e.target === modal) {
            modal.classList.remove('active');
            document.body.style.overflow = 'auto';
        }
    });
});

// Testimonial slider
const testimonialSlides = document.querySelectorAll('.testimonial-slide');
const testimonialControls = document.querySelectorAll('.testimonial-control');

testimonialControls.forEach((control, index) => {
    control.addEventListener('click', () => {
        // Hide all slides
        testimonialSlides.forEach(slide => {
            slide.classList.remove('active');
        });
        
        // Deactivate all controls
        testimonialControls.forEach(ctrl => {
            ctrl.classList.remove('active');
        });
        
        // Show selected slide and activate control
        testimonialSlides[index].classList.add('active');
        control.classList.add('active');
    });
});

// Auto-rotate testimonials
let testimonialIndex = 0;
setInterval(() => {
    testimonialIndex = (testimonialIndex + 1) % testimonialSlides.length;
    
    // Hide all slides
    testimonialSlides.forEach(slide => {
        slide.classList.remove('active');
    });
    
    // Deactivate all controls
    testimonialControls.forEach(ctrl => {
        ctrl.classList.remove('active');
    });
    
    // Show next slide and activate control
    testimonialSlides[testimonialIndex].classList.add('active');
    testimonialControls[testimonialIndex].classList.add('active');
}, 5000);

// Smooth scroll for anchor links
document.querySelectorAll('a[href^="#"]').forEach(anchor => {
    anchor.addEventListener('click', function(e) {
        e.preventDefault();
        
        const targetId = this.getAttribute('href');
        if (targetId === '#') return;
        
        const targetElement = document.querySelector(targetId);
        if (targetElement) {
            const navbarHeight = document.querySelector('.navbar').offsetHeight;
            const targetPosition = targetElement.getBoundingClientRect().top + window.pageYOffset - navbarHeight;
            
            window.scrollTo({
                top: targetPosition,
                behavior: 'smooth'
            });
        }
    });
});