<script lang="ts">
    import { onMount } from "svelte";
    import unknown from "./data.json";
    import type { DataTable, Register } from "./interfaces/DataTable";
    import IconSearchRegister from "../../icons/IconSearchRegister.svelte";
    import Paginate from "../Paginate/Paginate.svelte";
    import ArrowLeft from "../../icons/ArrowLeft.svelte";
    import { asClassComponent } from "svelte/legacy";

    export let show: boolean = false;
    export let action: string | undefined = undefined;
    export let title: string = "Lista de estudiantes";
    export let showNumber: boolean = true;
    export let content: Function | undefined = undefined;

    let data: DataTable = unknown as DataTable;
    //     columns: {
    //         name: "Nombres",
    //         lastname: "Apellidos",
    //         documentNumber: "Nº de documento",
    //         email: "Correo electrónico",
    //     },
    //     records: [
    //         {
    //             name: "Carlos Andrés",
    //             lastname: "Pérez Gómez",
    //             documentNumber: 1234567,
    //             email: "carlos.perez@example.com",
    //         },
    //         {
    //             name: "María Fernanda",
    //             lastname: "Rodríguez Díaz",
    //             documentNumber: 2345678,
    //             email: "maria.fernandez@example.com",
    //         },
    //         {
    //             name: "Luis Alberto",
    //             lastname: "García Torres",
    //             documentNumber: 3456789,
    //             email: "luis.garcia@example.com",
    //         },
    //         {
    //             name: "Ana Sofía",
    //             lastname: "Martínez Rivas",
    //             documentNumber: 4567890,
    //             email: "ana.martinez@example.com",
    //         },
    //         {
    //             name: "Jorge Enrique",
    //             lastname: "Ramírez López",
    //             documentNumber: 5678901,
    //             email: "jorge.ramirez@example.com",
    //         },
    //         {
    //             name: "Camila Julieta",
    //             lastname: "Morales Vega",
    //             documentNumber: 6789012,
    //             email: "camila.morales@example.com",
    //         },
    //     ],
    // };

    onMount(() => {
        if (!data) return;
        const { length } = data.records;
        show = length > 0;
    });

    async function onsubmit(event: SubmitEvent): Promise<void> {
        event.preventDefault();
    }

    function handleOrder(event: MouseEvent): void {
        const { target: button } = event;
        if (!(button instanceof HTMLButtonElement)) return;

        const thead: HTMLTableSectionElement | null = button.closest("thead");
        if (!(thead instanceof HTMLTableSectionElement)) return;

        const otherButtons: NodeListOf<HTMLButtonElement> =
            thead.querySelectorAll("[data-direction]");

        for (const currentButton of otherButtons) {
            if (!(currentButton instanceof HTMLButtonElement)) continue;
            const { index: currentIndex } = currentButton.dataset;
            const { index } = button.dataset;
            if (index == currentIndex) continue;

            currentButton.removeAttribute("data-direction");
        }

        const { direction } = button.dataset;
        button.dataset.direction = direction === "asc" ? "desc" : "asc";
    }

    function orderRegister(direction: string): void {
        if (!direction || typeof direction != "string") {
            throw new TypeError(
                "orderRegister: Se esperaba un argumento tipo «string» en «direction»",
            );
        }

        if (direction != "asc" && direction != "desc") {
            throw new TypeError(
                "orderRegister: Solo se admiten los valores «asc» o «desc» como argumento en «direction»",
            );
        }
    }
</script>

{#if show}
    <div class="table-container">
        <header class="table-container__header">
            <h2 class="table-container__title">
                {#if content}
                    {@render content()}
                {/if}
                <span>{title}</span>
            </h2>

            <div class="table-container__controls">
                <div class="table-container__buttons">
                    <form {action} class="form form--search" {onsubmit}>
                        <div class="form__search">
                            <input
                                type="search"
                                name="query"
                                id="query"
                                placeholder="Criterio de búsqueda"
                                class="form__input form__input--query"
                                autocomplete="off"
                            />
                            <button class="button button--query">
                                <IconSearchRegister />
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </header>
        <div class="table-container__container">
            <div class="table-container__content">
                <table class="table">
                    <colgroup>
                        {#if showNumber}
                            <col />
                        {/if}
                        {#each Object.entries(data.columns) as [key, label]}
                            <col />
                        {/each}
                    </colgroup>

                    <thead class="fixed fixed--panel">
                        <tr>
                            {#if showNumber}
                                <th class="fixed fixed--column">
                                    <span>Nº</span>
                                </th>
                            {/if}
                            {#each Object.entries(data.columns) as [key, label], index}
                                <th data-key={key}>
                                    <button
                                        class="button button--table-header"
                                        onclick={handleOrder}
                                        data-index={index}
                                    >
                                        <span>{label}</span>
                                        <ArrowLeft />
                                        <ArrowLeft />
                                    </button>
                                </th>
                            {/each}
                        </tr>
                    </thead>

                    <tbody>
                        {#each data.records as record, index}
                            <tr>
                                {#if showNumber}
                                    <td class="center fixed fixed--column"
                                        ><span>{index + 1}</span></td
                                    >
                                {/if}
                                {#each Object.keys(data.columns) as item}
                                    <td>
                                        <button
                                            class="button button--table"
                                            aria-label={String(
                                                record[item as keyof Register],
                                            )}
                                        >
                                            {record[item as keyof Register]}
                                        </button>
                                    </td>
                                {/each}
                            </tr>
                        {/each}
                    </tbody>
                </table>
            </div>
        </div>

        <footer class="table-container__footer">
            <div class="table-container__info"></div>
            <div class="table-container__info">
                <Paginate bind:data />
            </div>
        </footer>
    </div>
{/if}
