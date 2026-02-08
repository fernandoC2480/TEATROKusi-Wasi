document.addEventListener("DOMContentLoaded", () => {

  const menuToggle = document.querySelector(".menu-toggle");
  const mobileNav  = document.querySelector(".mobile-nav");
  const submenuLinks = document.querySelectorAll(".mobile-menu .has-submenu > a");

  /* =========================
     ABRIR / CERRAR MENÚ
  ========================= */
  menuToggle.addEventListener("click", () => {
    const isOpen = mobileNav.classList.toggle("open");
    document.body.classList.toggle("menu-open", isOpen);

    /* 🔴 cerrar submenús si se cierra el menú */
    if (!isOpen) {
      closeAllSubmenus();
    }
  });

  /* =========================
     SUBMENÚS (1 click abre, 2 cierra)
  ========================= */
  submenuLinks.forEach(link => {
    link.addEventListener("click", (e) => {
      e.preventDefault();

      const parentLi = link.parentElement;
      const isOpen = parentLi.classList.contains("open");

      /* cerrar todos primero */
      closeAllSubmenus();

      /* si no estaba abierto → abrir */
      if (!isOpen) {
        parentLi.classList.add("open");
      }
    });
  });

  /* =========================
     CERRAR MENÚ AL NAVEGAR
  ========================= */
  const menuLinks = document.querySelectorAll(".mobile-menu a:not(.has-submenu > a)");

  menuLinks.forEach(link => {
    link.addEventListener("click", () => {
      mobileNav.classList.remove("open");
      document.body.classList.remove("menu-open");
      closeAllSubmenus();
    });
  });

  /* =========================
     FUNCIÓN AUXILIAR
  ========================= */
  function closeAllSubmenus() {
    document.querySelectorAll(".mobile-menu .has-submenu.open")
      .forEach(li => li.classList.remove("open"));
  }

});
