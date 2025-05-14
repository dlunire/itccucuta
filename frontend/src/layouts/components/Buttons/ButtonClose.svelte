<script lang="ts">
    let { onclick, content } = $props();
</script>

<button class="button button--normalize button--close" type="button" {onclick}>
    {@render content()}
</button>
