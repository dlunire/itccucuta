<script lang="ts">
    import Menu from "../../components/Menues/Menu.svelte";
    import IconDashboard from "../../icons/IconDashboard.svelte";
    export let open: boolean = false;
    export let top: number = 0;
</script>

<aside
    class="sidebar section__column section__column--sidebar"
    data-open={open}
    style="--top: {top}px"
>
    <h2 class="sidebar__title">
        <IconDashboard />
        <span>Menú de navegación</span>
    </h2>

    <div class="sidebar__content">
        <Menu />
    </div>
</aside>
