<script>
    import MenuItem from "./MenuItem.svelte";
</script>

<ul class="menu">
    <MenuItem href="/dashboard" label="Carga de archivo CSV" />
    <MenuItem
        href="/dashboard/debbug-register"
        label="Corrección de registros"
    />
    <MenuItem href="/dashboard/history" label="Historial de carga" />
    <MenuItem href="/dashboard/register" label="Buscador de registro" />
</ul>
