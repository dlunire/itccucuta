<script lang="ts">
    /**
     * Componente que maneja el enrutamiento basado en rutas definidas
     * en el archivo `routes.ts`. Este componente se encarga de renderizar
     * el componente correspondiente a la ruta actual y pasarle los parámetros
     * extraídos de la URL como props.
     */
    import { type SvelteComponent } from "svelte";
    import { currentRoute } from "../sources/router";
    import NotFound from "../../pages/NotFound.svelte";
    import { routes } from "../routes";

    let route = $currentRoute;
    let Page = NotFound as typeof SvelteComponent;
    let params: Record<string, string> = {};

    $: console.log({ route, Page, params });

    $: {
        route = $currentRoute;
        Page = NotFound as typeof SvelteComponent;
        params = {};

        for (const r of routes) {
            const match = r.pattern.exec(route);
            if (match) {
                Page = r.component;
                params = r.extractParams(match);
                break;
            }
        }
    }
</script>

<!-- Renderizamos el componente correspondiente a la ruta y le pasamos los parámetros extraídos -->
<svelte:component this={Page as typeof SvelteComponent} {...params} />
