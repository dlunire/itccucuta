<script>
    import IconHelp from "../../icons/IconHelp.svelte";
    import IconSettings from "../../icons/IconSettings.svelte";
</script>

<nav class="fixed-buttons">
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

<style>
    .fixed-buttons {
        display: flex;
        align-items: center;
        justify-content: center;
    }
</style>
