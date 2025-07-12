<script lang="ts">
    import { onMount, type SvelteComponent } from "svelte";

    export let show: boolean = false;
    export let title: string = "Estudiantes";
    export let content: Function | undefined = undefined;
    onMount(() => {
        title = title.toUpperCase();
    });
</script>

{#if content}
    <div class="icon-graphic">
        <div class="icon-graphic__inner">
            <div class="icon-graphic__icon">
                {@render content()}
            </div>
            {#if show}
                <h2 class="icon-graphic__title">
                    {@render content()}
                    <span>{title}</span>
                </h2>
            {/if}
        </div>
    </div>
{/if}
