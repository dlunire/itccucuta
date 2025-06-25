<script lang="ts">
    export let title: string = "Título de la ventana";
    export let open: boolean = false;
    export let content: Function | null = null;

    addEventListener("keydown", function (event: KeyboardEvent) {
        const { key } = event;
        if (key != "Escape") return;
        open = false;
    });
</script>

{#if open}
    <section class="modal-container" role="dialog" data-open="true">
        <section class="modal fade-in">
            <header class="modal__header">
                <h3 class="modal__title">{title}</h3>
                <button
                    class="button button--windows-close"
                    aria-label="Cerrar"
                >
                </button>
            </header>

            <div class="modal__content">
                {#if content}
                    {@render content()}
                {/if}
            </div>

            <footer class="modal__footer">
                <button class="button button--primary">Salir</button>
            </footer>
        </section>
    </section>
{/if}
