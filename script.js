// script.js
// Simple, lightweight JS: fade-in on scroll, smooth anchors, navbar active detection

document.addEventListener('DOMContentLoaded', () => {

  /* ---------- Fade-in on scroll (IntersectionObserver) ---------- */
  const faders = document.querySelectorAll('.fade-in');
  const appearOptions = { threshold: 0.25, rootMargin: "0px 0px -10px 0px" };

  const appearOnScroll = new IntersectionObserver((entries, observer) => {
    entries.forEach(entry => {
      if(!entry.isIntersecting) return;
      entry.target.classList.add('visible');
      observer.unobserve(entry.target);
    });
  }, appearOptions);

  faders.forEach(el => appearOnScroll.observe(el));


  /* ---------- Navigation Sticky + Active Section Detection ---------- */
  const navLinks = document.querySelectorAll('.navbar a.nav-link');
  const sections = document.querySelectorAll('section[id]');
  
  function updateActiveLink() {
    let currentSection = '';
    
    sections.forEach(section => {
      const sectionTop = section.offsetTop;
      const sectionHeight = section.clientHeight;
      
      if (window.scrollY >= (sectionTop - 150)) {
        currentSection = section.getAttribute('id');
      }
    });
    
    navLinks.forEach(link => {
      link.classList.remove('active');
      
      if (link.getAttribute('href') === '#' + currentSection) {
        link.classList.add('active');
      }
    });
  }
  
  // Smooth scroll au clic sur les liens de navigation
  navLinks.forEach(link => {
    link.addEventListener('click', function(e) {
      e.preventDefault();
      
      const targetId = this.getAttribute('href');
      const targetSection = document.querySelector(targetId);
      
      if (targetSection) {
        const navbarHeight = document.querySelector('.navbar').offsetHeight;
        const targetPosition = targetSection.offsetTop - navbarHeight;
        
        window.scrollTo({
          top: targetPosition,
          behavior: 'smooth'
        });
        
        navLinks.forEach(l => l.classList.remove('active'));
        this.classList.add('active');
      }
    });
  });
  
  window.addEventListener('scroll', updateActiveLink);
  updateActiveLink();


  /* ---------- Subtle hero parallax (mouse move) ---------- */
  const hero = document.getElementById('hero');
  if(hero){
    hero.addEventListener('mousemove', (e) => {
      const rect = hero.getBoundingClientRect();
      const x = (e.clientX - rect.left) / rect.width;
      const y = (e.clientY - rect.top) / rect.height;

      hero.style.setProperty('--mx', (x - 0.5) * 12 + 'px');
      hero.style.setProperty('--my', (y - 0.5) * 8 + 'px');
    });

    hero.addEventListener('mouseleave', () => {
      hero.style.setProperty('--mx', '0px');
      hero.style.setProperty('--my', '0px');
    });
  }


  /* ---------- Lazy load for images ---------- */
  if('loading' in HTMLImageElement.prototype){
    document.querySelectorAll('img').forEach(img => {
      if(!img.hasAttribute('loading')) img.setAttribute('loading','lazy');
    });
  }

});

// Ajouter ce code à votre script.js existant

document.addEventListener('DOMContentLoaded', () => {

  /* ---------- Menu Hamburger Mobile ---------- */
  
  const navbar = document.querySelector('.navbar');
  const navbarUl = navbar.querySelector('ul');
  
  // Vérifier si le bouton existe déjà
  let toggleBtn = navbar.querySelector('.navbar-toggle');
  
  if (!toggleBtn) {
    // Créer le bouton toggle seulement s'il n'existe pas
    toggleBtn = document.createElement('button');
    toggleBtn.className = 'navbar-toggle';
    toggleBtn.setAttribute('aria-label', 'Menu');
    toggleBtn.innerHTML = '<span></span><span></span><span></span>';
    navbar.appendChild(toggleBtn);
  }
  
  // Vérifier si l'overlay existe déjà
  let overlay = document.querySelector('.navbar-overlay');
  
  if (!overlay) {
    // Créer l'overlay seulement s'il n'existe pas
    overlay = document.createElement('div');
    overlay.className = 'navbar-overlay';
    document.body.appendChild(overlay);
  }
  
  // Fonction pour fermer le menu
  const closeMenu = () => {
    toggleBtn.classList.remove('active');
    navbarUl.classList.remove('active');
    overlay.classList.remove('active');
    document.body.style.overflow = '';
  };
  
  // Toggle du menu
  toggleBtn.addEventListener('click', (e) => {
    e.stopPropagation();
    toggleBtn.classList.toggle('active');
    navbarUl.classList.toggle('active');
    overlay.classList.toggle('active');
    document.body.style.overflow = navbarUl.classList.contains('active') ? 'hidden' : '';
  });
  
  // Fermer le menu en cliquant sur l'overlay
  overlay.addEventListener('click', closeMenu);
  
  // Fermer le menu en cliquant sur un lien
  const navLinks = document.querySelectorAll('.navbar a');
  navLinks.forEach(link => {
    link.addEventListener('click', () => {
      if (window.innerWidth <= 768) {
        closeMenu();
      }
    });
  });
  
  // Fermer le menu avec la touche Échap
  document.addEventListener('keydown', (e) => {
    if (e.key === 'Escape' && navbarUl.classList.contains('active')) {
      closeMenu();
    }
  });

});