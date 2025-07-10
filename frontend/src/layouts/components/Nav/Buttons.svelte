<script lang="ts">
    import IconHelp from "../../icons/IconHelp.svelte";
    import IconSettings from "../../icons/IconSettings.svelte";
</script>

<nav class="nav">
    <button class="button button--settings" aria-label="Configuración">
        <IconSettings />
        <span>Configuración</span>
    </button>
    <button class="button button--help">
        <IconHelp />
        <span>Ayuda</span>
    </button>
</nav>
