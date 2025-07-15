<script lang="ts">
    import IconHelp from "../../icons/IconHelp.svelte";
    import IconRegister from "../../icons/IconRegister.svelte";
    import IconSettings from "../../icons/IconSettings.svelte";
    import IconUpload from "../../icons/IconUpload.svelte";
</script>

<nav class="nav">
    <button
        class="button button--nav"
        aria-label="Agregar archivo CSV"
        title="Agregar archivo CSV"
    >
        <IconUpload />
        <span>Agregar estudiantes</span>
    </button>
    <button
        class="button button--nav"
        aria-label="Editar registro"
        title="Editar registro"
    >
        <IconRegister />
        <span>Editar registro</span>
    </button>
</nav>
