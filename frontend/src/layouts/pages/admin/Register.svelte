<script lang="ts">
    import Icon from "../../components/Graphics/Icon.svelte";
    import IconRegister from "../../icons/IconRegister.svelte";
    import IconSearchRegister from "../../icons/IconSearchRegister.svelte";

    let show: boolean = true;
</script>

<section class="content">
    <Icon bind:show title="Buscador de registro">
        {#snippet content()}
            <IconSearchRegister />
        {/snippet}
    </Icon>
</section>
