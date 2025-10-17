document.addEventListener("DOMContentLoaded", function () {
    const form = document.querySelector("form");
    if (form) {
      form.addEventListener("submit", function (e) {
        const carnet = form.querySelector("input[name='carnet']").value.trim();
        const nombre = form.querySelector("input[name='nombre']").value.trim();
        const apellido = form.querySelector("input[name='apellido']").value.trim();
        const email = form.querySelector("input[name='email']").value.trim();
  
        if (!carnet || !nombre || !apellido || !email) {
          alert("Todos los campos son obligatorios.");
          e.preventDefault();
        }
      });
    }
  });
  