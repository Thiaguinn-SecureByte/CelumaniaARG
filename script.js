// Espera a que el DOM esté cargado completamente
document.addEventListener("DOMContentLoaded", function () {
  const toggleBtn = document.querySelector(".menu-toggle");
  const closeBtn = document.querySelector(".close-menu");
  const mobileMenu = document.querySelector(".mobile-menu");

  // Mostrar menú
  toggleBtn.addEventListener("click", () => {
    mobileMenu.classList.add("active");
  });

  // Ocultar menú
  closeBtn.addEventListener("click", () => {
    mobileMenu.classList.remove("active");
  });

  // Ocultar menú al hacer clic en un enlace
  document.querySelectorAll(".mobile-menu a").forEach(link => {
    link.addEventListener("click", () => {
      mobileMenu.classList.remove("active");
    });
  });
});
