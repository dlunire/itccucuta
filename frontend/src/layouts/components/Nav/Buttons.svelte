<script lang="ts">
    import IconCsv from "../../icons/IconCSV.svelte";
    import IconHelp from "../../icons/IconHelp.svelte";
    import IconRegister from "../../icons/IconRegister.svelte";
    import IconSettings from "../../icons/IconSettings.svelte";
</script>

<nav class="nav">
    <button
        class="button button--nav"
        aria-label="Agregar archivo CSV"
        title="Agregar archivo CSV"
    >
        <IconCsv />
        <span>Archivo CSV</span>
    </button>
    <button
        class="button button--nav"
        aria-label="Editar registro"
        title="Editar registro"
    >
        <IconRegister />
        <span>Editar registro</span>
    </button>
    <button
        class="button button--nav"
        aria-label="Configuración"
        title="Configuración"
    >
        <IconSettings />
        <span>Configuración</span>
    </button>
    <button class="button button--nav" title="Ayuda">
        <IconHelp />
        <span>Ayuda</span>
    </button>
</nav>
