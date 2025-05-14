<script lang="ts">
    import { onMount } from "svelte";
    import type { Method } from "./Interface/Method";
    import { request } from "./lib/request";
    import type { ResponseServer } from "./Interface/ResponseServer";

    export let method: Method = undefined;
    export let action: string = "/";
    export let className: string = "";

    export let content: Function | undefined = undefined;

    async function onsubmit(event: SubmitEvent): Promise<void> {
        event.preventDefault();

        const { target: form } = event;
        if (!(form instanceof HTMLFormElement)) return;

        const data = (await request(action, {
            credentials: "include",
            method: method ?? "POST",
        })) as ResponseServer;
    }

    let form: HTMLFormElement | null = null;

    onMount(() => {
        if (!(form instanceof HTMLFormElement)) return;
        const classNames: string[] = className.split(/\s+/);
        form.classList.add(...classNames);
    });
</script>

<form action="" method="post" class="form" {onsubmit} bind:this={form}>
    {#if content}
        {@render content()}
    {:else}
        <span>Agregue contenido al formulario</span>
    {/if}
</form>
