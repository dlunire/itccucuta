<script lang="ts">
    let { onclick = undefined, content = undefined } = $props();
</script>

<button class="button button--normalize button--submit" type="submit">
    {#if content}
        {@render content()}
    {:else}
        <span>Guardar registro</span>
    {/if}
</button>
