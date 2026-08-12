{{--
    Componente reutilizable: Valor de la UF del día
    Consume el servicio externo https://mindicador.cl/api/uf (JSON público, sin API key)
    100% frontend: la petición se hace con fetch() en JS puro, sin librerías extra.
    Se puede usar varias veces en la misma página (cada instancia tiene su propio id único).

    Uso: <x-uf-widget />
--}}

@php
    // id único para que el script encuentre este widget específico si se usa más de una vez
    $ufWidgetId = 'uf-widget-' . uniqid();
@endphp

<div id="{{ $ufWidgetId }}" class="max-w-xs rounded-xl border border-gray-200 bg-white p-5 shadow-sm">
    <div class="flex items-center justify-between">
        <h3 class="text-sm font-semibold uppercase tracking-wide text-gray-500">
            Valor UF hoy
        </h3>
        <button type="button" data-uf-refresh class="text-gray-400 hover:text-gray-600" title="Actualizar">
            <svg data-uf-icon xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                <path stroke-linecap="round" stroke-linejoin="round" d="M4 4v5h.582m15.418 0a8.001 8.001 0 00-15.356-2M20 20v-5h-.581m0 0a8.003 8.003 0 01-15.357 2" />
            </svg>
        </button>
    </div>

    <div data-uf-loading class="mt-3 animate-pulse text-2xl font-bold text-gray-300">
        Cargando...
    </div>

    <div data-uf-error class="mt-3 hidden">
        <p class="text-sm text-red-500">No se pudo obtener el valor de la UF.</p>
        <button type="button" data-uf-retry class="mt-1 text-sm font-medium text-blue-600 hover:underline">
            Reintentar
        </button>
    </div>

    <div data-uf-contenido class="mt-3 hidden">
        <p data-uf-valor class="text-2xl font-bold text-gray-800"></p>
        <p data-uf-fecha class="mt-1 text-xs text-gray-400"></p>
    </div>
</div>

<script>
    (function () {
        const contenedor = document.getElementById('{{ $ufWidgetId }}');
        if (!contenedor) return;

        const elLoading  = contenedor.querySelector('[data-uf-loading]');
        const elError    = contenedor.querySelector('[data-uf-error]');
        const elContenido = contenedor.querySelector('[data-uf-contenido]');
        const elValor    = contenedor.querySelector('[data-uf-valor]');
        const elFecha    = contenedor.querySelector('[data-uf-fecha]');
        const btnRefresh = contenedor.querySelector('[data-uf-refresh]');
        const btnRetry   = contenedor.querySelector('[data-uf-retry]');
        const icono      = contenedor.querySelector('[data-uf-icon]');

        function mostrarEstado(estado) {
            elLoading.classList.toggle('hidden', estado !== 'cargando');
            elError.classList.toggle('hidden', estado !== 'error');
            elContenido.classList.toggle('hidden', estado !== 'ok');
        }

        function formatearValor(valor) {
            return '$ ' + new Intl.NumberFormat('es-CL', { minimumFractionDigits: 2 }).format(valor);
        }

        function formatearFecha(fechaISO) {
            return new Date(fechaISO).toLocaleDateString('es-CL', {
                day: '2-digit', month: 'long', year: 'numeric'
            });
        }

        async function cargarUf() {
            mostrarEstado('cargando');
            icono.classList.add('animate-spin');

            try {
                const respuesta = await fetch('https://mindicador.cl/api/uf');
                if (!respuesta.ok) throw new Error('Respuesta no válida');

                const datos = await respuesta.json();
                const ufHoy = datos.serie[0];

                elValor.textContent = formatearValor(ufHoy.valor);
                elFecha.textContent = formatearFecha(ufHoy.fecha);
                mostrarEstado('ok');
            } catch (e) {
                mostrarEstado('error');
            } finally {
                icono.classList.remove('animate-spin');
            }
        }

        btnRefresh.addEventListener('click', cargarUf);
        btnRetry.addEventListener('click', cargarUf);

        cargarUf();
    })();
</script>
