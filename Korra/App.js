let colorIndex = 0; // Índice para el ciclo de colores

document.getElementById("change-image").addEventListener("click", function() {
    // Cambio de imagen
        const image = document.getElementById("main-image");
        const images = ["korra1.jpg", "korra2.jpg", "korra3.jpg"];
        const currentImage = image.getAttribute("src");
        let newImage = images[(images.indexOf(currentImage) + 1) % images.length];
        image.setAttribute("src", newImage);

    // Cambio de color del botón
        const button = document.getElementById("change-image");
        const colors = ["#172568", "#356823", "#8b1d0c", "#5497a9"]; // Agua, Tierra, Fuego, Aire
    
    // Cambiar color según el índice
        colorIndex = (colorIndex + 1) % colors.length; // Actualizamos el índice para que cicle entre los colores
        button.style.backgroundColor = colors[colorIndex];

    // Aseguramos que el texto del botón siga siendo visible en el fondo blanco
        if (colors[colorIndex] === "#172568") {
            button.style.color = "#dce6f1"; 
        }else if (colors[colorIndex] === "#356823") {
            button.style.color = "#efefbb"; 
        }else if (colors[colorIndex] === "#8b1d0c") {
            button.style.color = "#ffc9c9"; 
        }else {
            button.style.color = "#dce6f1"; // Texto blanco para los demás colores
        }
});

document.addEventListener("DOMContentLoaded", function () {
    const loginLink = document.querySelector('nav ul li a[href="#login"]');
    const loginSection = document.getElementById("login");
    const closeLoginButton = document.getElementById("close-login");

    // Mostrar el popup cuando se hace clic en "Log in"
    loginLink.addEventListener("click", function (e) {
        e.preventDefault(); // Evita el comportamiento predeterminado del enlace
        loginSection.classList.remove("hidden"); // Muestra el popup
    });

    // Cerrar el popup al hacer clic en el botón "Close"
    closeLoginButton.addEventListener("click", function () {
        loginSection.classList.add("hidden"); // Oculta el popup
    });

    // Cerrar el popup al hacer clic fuera del formulario
    loginSection.addEventListener("click", function (e) {
        if (e.target === loginSection) {
            loginSection.classList.add("hidden");
        }
    });
});

