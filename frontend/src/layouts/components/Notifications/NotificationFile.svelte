<script lang="ts">
    import { onMount } from "svelte";
    import ButtonClose from "../Buttons/ButtonClose.svelte";

    export let content: Function | undefined = undefined;
    export let time: number = 3000;
    export let open: boolean = true;

    let notification: HTMLElement | null = null;
    let timeout: number | null = null;

    onMount(() => {
        if (!(notification instanceof HTMLElement)) return;
        document.body.appendChild(notification);

        timeout = setTimeout(() => {
            open = false;
        }, time);
    });

    /**
     * Cierra la notificación
     */
    function onclick() {
        open = false;

        if (timeout) {
            clearTimeout(timeout);
        }
    }
</script>

{#if open}
    <section class="notification notification--file" bind:this={notification}>
        <div class="notification__inner notification__inner--info">
            {#if content}
                {@render content()}
            {:else}
                <span
                    >Agregue su mensaje aquí Lorem ipsum dolor sit amet
                    consectetur adipisicing elit. Ad, ducimus.</span
                >
            {/if}

            <ButtonClose {onclick}>
                {#snippet content()}
                    <span>Cerrar</span>
                {/snippet}
            </ButtonClose>
        </div>
    </section>
{/if}
