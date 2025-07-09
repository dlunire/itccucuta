import type { SvelteComponent } from "svelte";
import { getFullURL } from "./router";

/**
 * Representa una ruta del sistema de enrutamiento basado en expresiones regulares.
 * 
 * Cada ruta contiene un patrón `RegExp` que se evalúa contra la URL actual,
 * un componente Svelte que se renderiza si la ruta coincide, y una función
 * que permite extraer los parámetros dinámicos definidos en la URL.
 * 
 * Esta interfaz se utiliza junto con la función `route` para generar rutas declarativas.
 *
 * @interface Route
 * @property pattern - Expresión regular utilizada para hacer coincidir la ruta.
 * @property component - Componente Svelte que se mostrará si la ruta coincide.
 * @property extractParams - Función que extrae los parámetros de la ruta desde la coincidencia con la expresión regular.
 */
export interface Route {
    pattern: RegExp;
    component: typeof SvelteComponent;
    extractParams: (match: RegExpExecArray) => Record<string, string>;
}

export interface Params {
    [key: string]: string;
}

/**
 * Crea una definición de ruta para un enrutador tipo SPA utilizando expresiones regulares,
 * permitiendo asociar una ruta con un componente Svelte y extraer parámetros dinámicos.
 *
 * Si no se especifican los nombres de los parámetros (`paramNames`), estos se infieren
 * automáticamente a partir de los segmentos `:param` del patrón de ruta.
 *
 * @param pattern - Ruta con o sin parámetros (e.g., "/profile/:id").
 * @param component - Componente Svelte a renderizar si la ruta coincide.
 * @param paramNames - Opcional. Lista de nombres de parámetros si no se desea inferir automáticamente.
 *
 * @returns Objeto con la expresión regular compilada, el componente, y la lógica para extraer parámetros.
*
* @example Ejemplo
* route('/profile/:id', UserComponent)
* // Coincidirá con '/profile/123' y extraerá { id: '123' }
*/
export function route(pattern: string, component: typeof SvelteComponent, paramNames?: string[]) {
    pattern = getFullURL(pattern);

    const parsed = new URL(pattern);
    const origin = parsed.origin;
    const path = parsed.pathname;

    const names = paramNames ?? [...path.matchAll(/:([^/]+)/g)].map(m => m[1]);
    const pathRegexStr = path.replace(/:([^/]+)/g, '([^/]+)');
    const regex = new RegExp(`^${origin}${pathRegexStr}$`);

    return {
        pattern: regex,
        component,
        extractParams: (match: RegExpExecArray) => {
            const params: Record<string, string> = {};
            names.forEach((name, i) => {
                params[name] = match[i + 1];
            });
            return params;
        }
    };
}

export function getURL(route: string): string {
    return getFullURL(route);
}

export function getParams(route: string) {
    const names = [...route.matchAll(/[:]([^/]+)/g)].map(name => name[1]);
    let params: Params = {}

    const test: string = getURL("/algo/123/otro/contenido");

    console.log({ test })
    for (const name of names) {
        params[name as keyof Params] = name;
    }

    console.log({ params })
}



/**
 * Establece la definición de tipo del componente
 * 
 * @param component Componente a ser procesado
 * @returns 
 */
export function getComponent(component: unknown): typeof SvelteComponent {
    return component as typeof SvelteComponent;
}