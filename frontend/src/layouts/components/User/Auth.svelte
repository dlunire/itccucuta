<script lang="ts">
    import IconUser from "../../icons/IconUser.svelte";
    export let title: string = "Información del usuario";
    export let openMenu: boolean = false;

    $: console.log({ openMenu });

    let top: number = 0;

    function onclick(event: MouseEvent): void {
        const { target: button } = event;
        if (!(button instanceof HTMLButtonElement)) return;
        openMenu = !openMenu;
        loadSize(button);
    }

    function loadSize(button: HTMLButtonElement): void {
        if (!(button instanceof HTMLButtonElement)) {
            throw TypeError("Se esperaba un botón como argumento en «butto»");
        }

        const header: HTMLElement | null = button.closest("header");
        if (!(header instanceof HTMLElement)) return;

        const size: DOMRect = header.getBoundingClientRect();
        top = size.height + 5;
    }

    addEventListener("click", function (event: MouseEvent) {
        const { target: element } = event;
        if (!(element instanceof HTMLElement)) return;

        const { open } = element.dataset;
        if (open || open === "false") return;
        openMenu = false;
    });

    addEventListener("keydown", function (event: KeyboardEvent) {
        const { key } = event;
        if (key === "Escape") {
            openMenu = false;
        }
    });
</script>

<nav class="auth">
    <button
        class="button button--user"
        aria-label="Usuario"
        {title}
        {onclick}
        data-open={String(openMenu)}
    >
        <IconUser />
    </button>
</nav>

{#if openMenu}
    <div class="profile-container" style="--top: {top}px">
        <section class="profile"></section>
    </div>
{/if}
