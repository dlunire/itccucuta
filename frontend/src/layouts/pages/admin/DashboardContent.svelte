<script lang="ts">
    import Icon from "../../components/Graphics/Icon.svelte";
    import Table from "../../components/Tables/Table.svelte";
    import IconStudents from "../../icons/IconStudents.svelte";

    let show: boolean = true;
</script>

<section class="content">
    <Icon title="Estudiantes" bind:show>
        {#snippet content()}
            <IconStudents />
        {/snippet}
    </Icon>

    {#if show}
        <Table />
    {/if}
</section>
