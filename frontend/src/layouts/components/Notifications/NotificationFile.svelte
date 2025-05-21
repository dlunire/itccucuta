<script lang="ts">
    import { onMount } from "svelte";

    export let content: Function | undefined = undefined;

    let notification: HTMLElement | null = null;

    onMount(() => {
        if (!(notification instanceof HTMLElement)) return;
        document.body.appendChild(notification);
    });
</script>

<section class="notification notification--file" bind:this={notification}>
    <div class="notification__inner notification__inner--info">
        {#if content}
            {@render content()}
        {:else}
            <span
                >Agregue su mensaje aquí Lorem ipsum dolor sit amet consectetur
                adipisicing elit. Ad, ducimus.</span
            >
        {/if}
    </div>
</section>
