import { writable } from 'svelte/store';

export const currentRoute = writable(window.location.pathname);

/**
 * Navega a una nueva ruta usando el History API.
 * Actualiza el store `currentRoute` sin recargar la página.
 */
export function navigate(path: string) {
    if (window.location.pathname !== path) {
        history.pushState({}, '', path);
        currentRoute.set(path);
    }
}

// Escucha cambios de historial (botones atrás/adelante del navegador)
window.addEventListener('popstate', () => {
    currentRoute.set(window.location.pathname);
});
