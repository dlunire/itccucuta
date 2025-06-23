<script lang="ts">
    import type { ButtonList } from "./Interfaces/ButtonType";

    export const list: ButtonList[] = [
        { label: "Producción" },
        { label: "Desarrollo" },
    ];

    export let production: boolean = false;

    let environmentLabel: string = "Seleccione...";
</script>

<div class="button-list">
    <button
        class="button button--environment"
        aria-label="Entorno de Ejecución"
    >
        <span>{environmentLabel}</span>
    </button>
</div>

<style>
</style>
