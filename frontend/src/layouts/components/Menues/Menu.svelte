<script lang="ts">
    import type { SvelteComponent } from "svelte";
    import MenuItem from "./MenuItem.svelte";
    import IconCsv from "../../icons/IconCSV.svelte";
    import IconRegister from "../../icons/IconRegister.svelte";
    import IconTime from "../../icons/IconTime.svelte";
    import IconSearchRegister from "../../icons/IconSearchRegister.svelte";

    let iconCSV: typeof SvelteComponent = IconCsv as typeof SvelteComponent;
    let iconRegister: typeof SvelteComponent =
        IconRegister as typeof SvelteComponent;

    let iconTime: typeof SvelteComponent = IconTime as typeof SvelteComponent;
    let iconSearchRegister: typeof SvelteComponent =
        IconSearchRegister as typeof SvelteComponent;
</script>

<ul class="menu">
    <MenuItem href="/dashboard" label="Archivos" icon={iconCSV} />
    <MenuItem
        href="/dashboard/debbug-register"
        label="Corrección de registros"
        icon={iconRegister}
    />
    <MenuItem
        href="/dashboard/history"
        label="Historial de carga"
        icon={iconTime}
    />
    <MenuItem
        href="/dashboard/register"
        label="Buscador de registro"
        icon={iconSearchRegister}
    />
</ul>
