<script lang="ts">
    import { onMount } from "svelte";
    import unknown from "./data.json";
    import type { DataTable, Register } from "./interfaces/DataTable";

    export let show: boolean = false;
    export let action: string | undefined = undefined;
    export let title: string = "Lista de estudiantes";
    export let content: Function | undefined = undefined;

    const data: DataTable = unknown as DataTable;
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

        console.log({ show });
    });

    $: console.log({ action });
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
        </header>
        <table class="table">
            <colgroup>
                {#each Object.entries(data.columns) as [key, label]}
                    <col />
                {/each}
            </colgroup>

            <thead>
                <tr>
                    {#each Object.entries(data.columns) as [key, label]}
                        <th>{label}</th>
                    {/each}
                </tr>
            </thead>

            <tbody>
                {#each data.records as record}
                    <tr>
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
{/if}
