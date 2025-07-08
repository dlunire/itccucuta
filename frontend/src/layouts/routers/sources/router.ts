import { writable } from 'svelte/store';
import { getURLBase } from '../../components/Forms/lib/request';

export const currentRoute = writable(getPathname());

/**
 * Navega a una nueva ruta usando el History API.
 * Actualiza el store `currentRoute` sin recargar la página.
 * 
 * @param path Ruta hacia donde se dirigirá el usuario cuando presione el enlace.
 */
export function navigate(path: string) {
    let pathname: string = getPathname();

    let url: string = getFullURL(path);

    if (getFullURL(pathname) !== url) {
        history.pushState({}, '', url);
        currentRoute.set(url);
    }
}

/**
 * Devuelve la URL completa a partir de una ruta relativa.
 * 
 * @param path Ruta relativa
 * @returns 
 */
export function getFullURL(path: string): string {
    path = path.replace(/^\/+|\/+$/, '');
    let url: string = `${getURLBase()}/${path}`;
    return url;
}

/**
 * Devuelve la ruta relativa a partir del objeto Location
 * 
 * @returns 
 */
export function getPathname(): string {
    let location: Location | undefined = undefined;

    if (typeof globalThis != "undefined" && typeof globalThis.location) {
        location = globalThis.location;
    }

    if (typeof window != "undefined" && !location) {
        location = window.location;
    }

    if (!location) {
        throw new Error("No se pudo obtener «location»");
    }

    return location.pathname;
}

// Escucha cambios de historial (botones atrás/adelante del navegador)
window.addEventListener('popstate', () => {
    currentRoute.set(getPathname());
});
