import type { SvelteComponent } from 'svelte';
import { getURLBase } from '../../components/Forms/lib/request';

/**
 * Representa una ruta del sistema de enrutamiento basado en expresiones regulares.
 *
 * Cada ruta contiene un patrón `RegExp` que se evalúa contra la URL actual,
 * un componente Svelte que se renderiza si la ruta coincide, y una función
 * para extraer los parámetros dinámicos desde la coincidencia con la expresión regular.
 *
 * @interface Route
 */
export interface Route {
    /** Expresión regular utilizada para hacer coincidir la ruta */
    pattern: RegExp;

    /** Componente Svelte que se mostrará si la ruta coincide */
    component: typeof SvelteComponent;

    /**
     * Función que extrae los parámetros dinámicos de la ruta desde el match de `RegExp`
     * @param match Resultado de `RegExp.exec(...)`
     * @returns Objeto con parámetros clave-valor
     */
    extractParams: (match: RegExpExecArray) => Record<string, string>;

    /** [Opcional] Componente auxiliar para la barra de navegación */
    headerComponent?: typeof SvelteComponent;
}

/**
 * Representa un conjunto de parámetros extraídos desde una ruta.
 */
export interface Params {
    [key: string]: string;
}

/**
 * Crea una definición de ruta para un enrutador tipo SPA utilizando expresiones regulares,
 * asociando un patrón de ruta con un componente Svelte.
 *
 * Si no se especifican los nombres de los parámetros (`paramNames`), estos se infieren
 * automáticamente a partir de los segmentos tipo `:param` del patrón de ruta.
 *
 * @param pattern Ruta con o sin parámetros (e.g., "/profile/:id").
 * @param component Componente Svelte a renderizar si la ruta coincide.
 * @param paramNames Opcional. Lista de nombres de parámetros si no se desea inferir automáticamente.
 * @returns Objeto `Route` con la expresión regular compilada, el componente, y la lógica para extraer parámetros.
 *
 * @example
 * ```ts
 * route('/profile/:id', UserComponent)
 * // Coincide con '/profile/123' y extrae { id: '123' }
 * ```
 */
export function route(
    pattern: string,
    component: typeof SvelteComponent,
    paramNames?: string[],
    header?: typeof SvelteComponent
): Route {
    const path = getPathFromPattern(pattern);
    const names = paramNames ?? extractParamNames(path);
    const regex = buildPathRegex(path);

    return {
        pattern: regex,
        component,
        extractParams: match => extractParamsFromMatch(names, match),
        headerComponent: header
    };
}

/**
 * Extrae únicamente el `pathname` desde un patrón de ruta.
 * Si se proporciona una ruta relativa, se considera relativa al host ficticio.
 *
 * @param pattern Ruta en formato string (absoluta o relativa)
 * @returns Solo el `pathname` (ej. "/user/:id")
 */
function getPathFromPattern(pattern: string): string {
    return new URL(pattern, getURLBase()).pathname;
}

/**
 * Extrae los nombres de los parámetros tipo `:id` o `:slug` de un `pathname`.
 *
 * @param path Ruta tipo "/user/:id"
 * @returns Lista de nombres de parámetros extraídos
 */
function extractParamNames(path: string): string[] {
    return [...path.matchAll(/:([^/]+)/g)].map(m => m[1]);
}

/**
 * Construye una expresión regular para hacer coincidir una ruta concreta.
 *
 * @param path Ruta con segmentos dinámicos (ej. "/post/:id")
 * @returns RegExp para evaluar coincidencia con `location.pathname`
 */
function buildPathRegex(path: string): RegExp {
    const pathRegexStr = path.replace(/:([^/]+)/g, '([^/]+)');
    return new RegExp(`^${pathRegexStr}$`);
}

/**
 * Extrae los valores de parámetros desde un resultado de `RegExp.exec()`.
 *
 * @param names Lista de nombres de parámetros
 * @param match Resultado del match (`RegExpExecArray`)
 * @returns Objeto con claves y valores correspondientes a los parámetros
 */
function extractParamsFromMatch(
    names: string[],
    match: RegExpExecArray
): Params {
    const params: Params = {};
    names.forEach((name, i) => {
        params[name] = decodeURIComponent(match[i + 1]);
    });
    return params;
}

/**
 * Convierte un valor desconocido en un tipo `typeof SvelteComponent`.
 *
 * @param component Componente Svelte genérico o dinámico
 * @returns El componente tipado como `typeof SvelteComponent`
 */
export function getComponent(component: unknown): typeof SvelteComponent {
    return component as typeof SvelteComponent;
}
