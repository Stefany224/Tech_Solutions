window.enviarFormularioAuth = function (formId, url, onSuccess) {
    document.getElementById(formId).addEventListener('submit', async function (e) {
        e.preventDefault();

        const errorBox = document.getElementById('mensaje-error');
        errorBox.classList.add('hidden');
        errorBox.innerHTML = '';

        const datos = {};
        for (const el of this.elements) {
            if (el.name) datos[el.name] = el.value;
        }

        try {
            const response = await fetch(url, {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'Accept': 'application/json',
                },
                body: JSON.stringify(datos),
            });

            const data = await response.json();

            if (!response.ok) {
                const mensajes = data.message ? [data.message] : Object.values(data).flat();
                errorBox.innerHTML = mensajes.join('<br>');
                errorBox.classList.remove('hidden');
                return;
            }

            onSuccess(data);

        } catch (error) {
            errorBox.textContent = 'No se pudo conectar con el servidor.';
            errorBox.classList.remove('hidden');
        }
    });
};

document.addEventListener('DOMContentLoaded', function () {
    const btnLogout = document.getElementById('btn-logout');
    const token = localStorage.getItem('token');

     const linkInicio = document.getElementById('link-inicio');
        if (token && linkInicio) {
        linkInicio.href = '/proyectos'; }

    if (token && btnLogout) {
        btnLogout.classList.remove('hidden');

        btnLogout.addEventListener('click', async function () {
            try {
                await fetch('/api/logout', {
                    method: 'POST',
                    headers: {
                        'Authorization': 'Bearer ' + token,
                        'Accept': 'application/json',
                    },
                });
            } catch (error) {
                // aunque falle la llamada al servidor limpiamos el token local
            }

            localStorage.removeItem('token');
            window.location.href = '/';
        });
    }
});

window.protegerPagina = function () {
    if (!localStorage.getItem('token')) {
        window.location.href = '/login';
    }
};

document.addEventListener('DOMContentLoaded', function () {
    const token = localStorage.getItem('token');
    if (!token) return;

    // agregamos el token como campo oculto a los formularios
    document.querySelectorAll('form').forEach(function (form) {
        const inputToken = document.createElement('input');
        inputToken.type = 'hidden';
        inputToken.name = 'token';
        inputToken.value = token;
        form.appendChild(inputToken);
    });
});