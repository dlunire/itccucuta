<script lang="ts">
    import { onMount } from "svelte";
    import { zIndexReverse } from "../../../lib/zIndex";
    import Container from "../../sections/Container.svelte";
    import Header from "../../sections/Header.svelte";
    import IconInstall from "../../icons/IconInstall.svelte";
    import IconHelp from "../../icons/IconHelp.svelte";
    import Windows from "../../windows/Windows.svelte";
    import UserHelp from "../../help/UserHelp.svelte";
    import Sidebar from "../../sections/Dashboard/Sidebar.svelte";
    import Content from "../../sections/Dashboard/Content.svelte";
    import IconSettings from "../../icons/IconSettings.svelte";
    import { navigate } from "../../routers/sources/router";

    onMount(() => {
        if (container instanceof HTMLElement) zIndexReverse(container);
    });

    let container: HTMLElement | null = null;

    let open: boolean = false;
    function onclick(event: MouseEvent): void {
        open = !open;
    }

    function handleSetting(event: MouseEvent): void {
        const { target: button } = event;
        if (!(button instanceof HTMLButtonElement)) return;
        navigate("/dashboard/settings");
    }
</script>

<Header dashboard={true}>
    <h2 class="header__title">
        <IconInstall />
        <span>Panel de administración</span>
    </h2>

    <div class="header__buttons">
        <button
            class="button button--settings"
            aria-label="Configuración"
            onclick={handleSetting}
        >
            <IconSettings />
            <span>Configuración</span>
        </button>
        <button class="button button--help" {onclick}>
            <IconHelp />
            <span>Ayuda</span>
        </button>
    </div>
</Header>

<Container dashboard={true}>
    <section class="section section--dashboard" bind:this={container}>
        <Sidebar />
        <Content dashboard={true} />
    </section>
</Container>

<Windows bind:open title="Usuario del sistema">
    {#snippet contentHeader()}
        <IconHelp />
    {/snippet}

    {#snippet content()}
        <UserHelp />
    {/snippet}
</Windows>
