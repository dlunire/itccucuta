<script lang="ts">
    import Icon from "../../components/Graphics/Icon.svelte";
    import IconSettings from "../../icons/IconSettings.svelte";

    let show: boolean = false;
</script>

<section class="content">
    <Icon bind:hidden={show} title="Configuración">
        {#snippet content()}
            <IconSettings />
        {/snippet}
    </Icon>
</section>
