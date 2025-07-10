<script lang="ts">
    import IconCertificate from "../../icons/IconCertificate.svelte";
    import IconCsv from "../../icons/IconCSV.svelte";
    import IconHelp from "../../icons/IconHelp.svelte";
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
        <span>Agregar certificado</span>
    </button>
    <button
        class="button button--nav"
        aria-label="Editar registro"
        title="Editar registro"
    >
        <IconCertificate />
        <span>Revisar certificados</span>
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
