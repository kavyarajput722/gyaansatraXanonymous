AOS.init({
    duration: 800,
    offset: 100,
    easing: 'ease-in-out',
    once: true
  });

  function toggleMenu(el) {
    const menu = document.getElementById('mobileMenu');
    menu.classList.toggle('active');
  }
  window.addEventListener("load", () => {
    const loader = document.getElementById("loader");
    loader.classList.add("fade-out");
  });