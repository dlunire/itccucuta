<script lang="ts">
    let { onclick, content, type } = $props();
</script>

<button class="button button--normalize button--primary" {type} {onclick}>
    {@render content()}
</button>
