/**
 * Permite realizar una petición al servidor utilizando `fetch`.
 * 
 * Retorna un objeto con el código de estado HTTP, un posible valor de `route`, y un mensaje obtenido del cuerpo de la respuesta,
 * intentando detectar las claves comunes como `message`, `success`, `error` o `send`.
 * 
 * Si ocurre un error durante la petición (por ejemplo, fallo de red o respuesta malformada),
 * se captura la excepción y se retorna un objeto con un mensaje de error genérico.
 * 
 * @param action - URL o endpoint al que se enviará la solicitud.
 * @param init - Opciones opcionales para la configuración de la solicitud.
 * @returns 
 */
export async function request(action: string, init?: RequestInit): Promise<unknown> {

    const urlBase: string = getURLBase();
    console.log({ urlBase })
    try {
        const response: Response = await fetch(`${urlBase}${action}`, init);
        const status = response.status;

        const data = await safeJSON(response, {});

        return {
            error: !response.ok,
            code: status,
            route: data.route ?? undefined,
            message: data.message ?? data.success ?? data.error ?? data.send,
            data
        };
    } catch (e) {
        console.error("Request failed:", e);
        return {
            error: true,
            message: "Ocurrió un error al realizar la solicitud.",
        };
    }
}

/**
 * Intenta parsear la respuesta como JSON.
 * Si falla, devuelve `null` o el valor por defecto proporcionado.
 * 
 * @param response - Objeto Response obtenido desde fetch.
 * @param fallback - Valor por defecto si no se puede parsear como JSON.
 * @returns Un objeto JSON o el valor de fallback.
 */
export async function safeJSON<T = unknown>(response: Response, fallback: T | null = null): Promise<any> {
    try {
        return await response.json();
    } catch {
        return fallback;
    }
}

// <link rel="canonical" href="{{ route('') }}" />
export function getURLBase(): string {
    const link: HTMLLinkElement | null = document.querySelector("[rel='canonical']");

    const url: URL = new URL(location.href);
    const { origin } = url;

    if (!(link instanceof HTMLLinkElement)) return origin;
    return link.href.replace(/\/+$/, '');
}