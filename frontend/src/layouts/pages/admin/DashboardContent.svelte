<script lang="ts">
    import Icon from "../../components/Graphics/Icon.svelte";
    import IconStudents from "../../icons/IconStudents.svelte";

    let show: boolean = true;
</script>

<section class="content">
    {#if !show}
        <h2 class="content__title">
            <span>Contenido del dashboard</span>
        </h2>
    {/if}

    <Icon title="Estudiantes" bind:show>
        {#snippet content()}
            <IconStudents />
        {/snippet}
    </Icon>
</section>
