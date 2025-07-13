<script lang="ts">
    import IconUser from "../../icons/IconUser.svelte";
    export let title: string = "Información del usuario";
    export let openMenu: boolean = false;

    $: console.log({ openMenu });

    function onclick(event: MouseEvent): void {
        openMenu = !openMenu;
    }
</script>

<nav class="auth">
    <button class="button button--user" aria-label="Usuario" {title} {onclick}>
        <IconUser />
    </button>
</nav>

{#if openMenu}
    <div class="profile-container">
        <section class="profile"></section>
    </div>
{/if}
