// Esto es para el menu desplegable del nav en /inicio (@auth)

import './bootstrap'; // Si tu proyecto usa el bootstrap de Laravel para JS

document.addEventListener('DOMContentLoaded', function() {
    const dropdownButton = document.getElementById('dropdownButton');
    const dropdownMenu = document.getElementById('dropdownMenu');

    if (dropdownButton && dropdownMenu) {
        // Función para alternar la visibilidad del menú
        function toggleDropdown() {
            dropdownMenu.classList.toggle('hidden');
        }

        // Event listener para el botón
        dropdownButton.addEventListener('click', function(event) {
            event.stopPropagation(); // Evita que el clic se propague al documento inmediatamente
            toggleDropdown();
        });

        // Event listener para cerrar el menú cuando se hace clic fuera
        document.addEventListener('click', function(event) {
            // Si el clic no fue dentro del botón y no fue dentro del menú
            if (!dropdownButton.contains(event.target) && !dropdownMenu.contains(event.target)) {
                if (!dropdownMenu.classList.contains('hidden')) { // Si el menú está visible
                    dropdownMenu.classList.add('hidden'); // Ocultarlo
                }
            }
        });

        // Opcional: Cerrar el menú si se presiona la tecla 'Escape'
        document.addEventListener('keydown', function(event) {
            if (event.key === 'Escape' && !dropdownMenu.classList.contains('hidden')) {
                dropdownMenu.classList.add('hidden');
            }
        });
    }
});