<script lang="ts">
    import Icon from "../../components/Graphics/Icon.svelte";
    import Table from "../../components/Tables/Table.svelte";
    import IconStudents from "../../icons/IconStudents.svelte";

    let show: boolean = true;
</script>

<section class="content">
    <Icon title="Estudiantes" bind:hidden={show}>
        {#snippet content()}
            <IconStudents />
        {/snippet}
    </Icon>

    {#if show}
        <Table bind:show action="/v1/dashboard/query">
            {#snippet content()}
                <IconStudents />
            {/snippet}
        </Table>
    {/if}
</section>
