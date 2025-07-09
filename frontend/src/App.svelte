<script lang="ts">
  import Dashboard from "./layouts/pages/admin/Dashboard.svelte";
  import Router from "./layouts/routers/components/Router.svelte";
  import { getParams } from "./layouts/routers/sources/generator";
  import { getFullURL, getPathname } from "./layouts/routers/sources/router";

  let routes: string[] = [
    getFullURL("/install/credentials"),
    getFullURL("/credentials/check"),
    getFullURL("/create/user"),
    getFullURL("/login"),
  ];

  // Analizando esta ruta
  getParams("/name/:name/product/:id");
</script>

<main>
  {#if routes.includes(getFullURL(getPathname()))}
    <Router />
  {:else}
    <Dashboard />
  {/if}
</main>
