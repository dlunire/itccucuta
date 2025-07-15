<script lang="ts">
    import ArrowLeft from "../../icons/ArrowLeft.svelte";
    import type { DataTable } from "../Tables/interfaces/DataTable";

    export let data: DataTable | undefined = undefined;

    let paginate: string = "1 de 3";
</script>

{#if data}
    <nav class="paginate">
        <div class="paginate__info">
            <span>{paginate}</span>
        </div>
        <button
            class="button button--paginate"
            aria-label="Página anterior"
            data-direction="left"
        >
            <ArrowLeft />
        </button>

        <button
            class="button button--paginate"
            aria-label="Siguiente página"
            data-direction="right"
        >
            <ArrowLeft />
        </button>
    </nav>
{/if}
