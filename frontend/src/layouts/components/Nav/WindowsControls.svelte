<script lang="ts">
    import IconRegisterAdd from "../../icons/IconRegisterAdd.svelte";
    import IconTable from "../../icons/IconTable.svelte";
    export let add: boolean = false;
</script>

<nav class="fixed-buttons">
    <button
        class="button button--nav button--options"
        class:button--options-selected={add}
        aria-label="Configuración"
        title="Configuración"
    >
        <IconRegisterAdd />
        <span>Agregar estudiante</span>
    </button>
    <button
        class="button button--nav button--options"
        title="Mostrar registro de estudiantes"
        class:button--options-selected={!add}
    >
        <IconTable />
        <span>Mostrar registro</span>
    </button>
</nav>

<style lang="scss">
    @use "../../../assets/sass/vars" as *;
    .fixed-buttons {
        display: flex;
        align-items: center;
        justify-content: center;
    }
</style>
