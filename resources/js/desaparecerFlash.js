document.addEventListener('DOMContentLoaded', function () {
    const contenedorMensaje = document.getElementById('mensaje-exito');

    if (contenedorMensaje) {
        setTimeout(function () {
            contenedorMensaje.style.display = 'none';

            contenedorMensaje.remove();
        }, 4000);
    }
})

document.addEventListener('DOMContentLoaded', function () {
    const contenedorMensaje = document.getElementById('mensaje-editado');

    if (contenedorMensaje) {
        setTimeout(function () {
            contenedorMensaje.style.display = 'none';

            contenedorMensaje.remove();
        }, 4000);
    }
})

document.addEventListener('DOMContentLoaded', function () {
    const contenedorMensaje = document.getElementById('mensaje-eliminado');

    if (contenedorMensaje) {
        setTimeout(function () {
            contenedorMensaje.style.display = 'none';

            contenedorMensaje.remove();
        }, 4000);
    }
})