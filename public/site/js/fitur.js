/* =============================================
   FITUR PAGE — JavaScript
   ============================================= */

document.addEventListener('DOMContentLoaded', () => {
  initAppNav();
  initStickyAppNav();
});

/* --- Sticky App Navigation --- */
function initStickyAppNav() {
  const appNav = document.getElementById('appNav');
  if (!appNav) return;

  const heroSection = document.querySelector('.fitur-hero');
  if (!heroSection) return;

  const heroBottom = heroSection.offsetTop + heroSection.offsetHeight;

  window.addEventListener('scroll', () => {
    if (window.scrollY >= heroBottom - 80) {
      appNav.classList.add('app-nav--sticky');
    } else {
      appNav.classList.remove('app-nav--sticky');
    }
  });

  // Trigger on load
  if (window.scrollY >= heroBottom - 80) {
    appNav.classList.add('app-nav--sticky');
  }
}

/* --- Active App Nav Highlight --- */
function initAppNav() {
  const navLinks = document.querySelectorAll('.app-nav__link');
  const sections = document.querySelectorAll('.app-section');

  if (!navLinks.length || !sections.length) return;

  // Smooth scroll for app nav links
  navLinks.forEach(link => {
    link.addEventListener('click', function(e) {
      e.preventDefault();
      const targetId = this.getAttribute('href').substring(1);
      const targetSection = document.getElementById(targetId);

      if (targetSection) {
        const offset = 160; // navbar + app nav height
        const top = targetSection.getBoundingClientRect().top + window.scrollY - offset;
        window.scrollTo({ top, behavior: 'smooth' });
      }
    });
  });

  // Intersection Observer for active state
  const observer = new IntersectionObserver((entries) => {
    entries.forEach(entry => {
      if (entry.isIntersecting) {
        const id = entry.target.getAttribute('id');
        navLinks.forEach(link => {
          link.classList.remove('active');
          if (link.getAttribute('data-target') === id) {
            link.classList.add('active');
          }
        });
      }
    });
  }, {
    threshold: 0.2,
    rootMargin: '-160px 0px -50% 0px'
  });

  sections.forEach(section => observer.observe(section));
}
