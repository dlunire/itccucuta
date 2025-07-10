<script lang="ts">
    import { type SvelteComponent } from "svelte";
    import { currentRoute } from "../sources/router";
    import { routes } from "../routes";

    let route = $currentRoute;
    let Header: typeof SvelteComponent | null = null;
    let params: Record<string, string> = {};

    $: {
        route = $currentRoute;
        Header = null;
        params = {};

        for (const r of routes) {
            const match = r.pattern.exec(route);
            if (match && r.headerComponent) {
                Header = r.headerComponent;
                params = r.extractParams(match);
                break;
            }
        }
    }
</script>

{#if Header}
    <svelte:component this={Header} {...params} />
{/if}
