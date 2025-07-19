<script lang="ts">
    import { onDestroy, onMount } from "svelte";
    import Table from "../components/Tables/Table.svelte";
    import type { DataTable } from "../components/Tables/interfaces/DataTable";
    import { openStudents } from "./store/windows";
    import IconClose from "../icons/IconClose.svelte";

    export let data: DataTable;
    export let title: string = "Agregar estudiantes";

    let open: boolean = false;
    let element: HTMLElement | null = null;

    onMount(() => {
        if (!(element instanceof HTMLElement)) return;
        document.body.appendChild(element);
    });

    function onclick(event: MouseEvent): void {
        const { target: button } = event;
        if (!(button instanceof HTMLButtonElement)) return;
        openStudents.set(false);
    }

    const unsubscribe = openStudents.subscribe((value) => {
        open = value;
    });

    onDestroy(() => {
        unsubscribe();
    });

    $: console.log({ open });

    addEventListener("keydown", function (event: KeyboardEvent) {
        const { key } = event;

        if (key == "Escape") {
            event.preventDefault();
            openStudents.update(() => false);
        }
    });
</script>

{#if open}
    <div class="windows" data-open="" bind:this={element}>
        <header class="windows__header">
            <span>{title}</span>

            <button class="button button--close-window" {onclick}>
                <IconClose />
            </button>
        </header>
        <section class="windows__content modal">
            <div class="modal__upload"></div>
            <div class="modal__table">
                <Table bind:data />
            </div>
        </section>

        <footer class="windows__footer">
            <button class="button button--test" {onclick}>Test</button>
        </footer>
    </div>
{/if}
