<script lang="ts">
    import { onMount } from "svelte";
    import ButtonClose from "../Buttons/ButtonClose.svelte";
    import IconClose from "../../icons/IconClose.svelte";

    export let content: Function | undefined = undefined;
    export let time: number = 3000;
    export let open: boolean = false;
    export let error: boolean = false;
    export let success: boolean = false;
    export let warning: boolean = false;
    export let info: boolean = false;

    let notification: HTMLElement | null = null;
    let timeout: number | null = null;

    onMount(() => {
        if (!(notification instanceof HTMLElement)) return;
        document.body.appendChild(notification);
    });

    $: if (open) {
        if (timeout) clearTimeout(timeout);

        timeout = setTimeout(() => {
            open = false;
        }, time);
    }

    /**
     * Cierra la notificación
     */
    function onclick() {
        open = false;

        if (timeout) {
            clearTimeout(timeout);
        }
    }

    $: console.log({ open });
</script>

{#if open}
    <section class="notification notification--file" bind:this={notification}>
        <div
            class="notification__inner"
            class:notification__inner--info={info}
            class:notification__inner--success={success}
            class:notification__inner--warning={warning}
            class:notification__inner--error={error}
        >
            {#if content}
                {@render content()}
            {:else}
                <span
                    >Lorem ipsum dolor sit amet consectetur adipisicing elit.
                    Aliquam, error!</span
                >
            {/if}

            <ButtonClose {onclick}>
                {#snippet content()}
                    <IconClose />
                    <span>Cerrar</span>
                {/snippet}
            </ButtonClose>
        </div>
    </section>
{/if}
