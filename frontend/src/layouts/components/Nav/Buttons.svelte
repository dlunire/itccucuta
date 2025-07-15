<script lang="ts">
    import { onDestroy, onMount } from "svelte";
    import { buttonsExists } from "../../../lib/store/store";
    import IconRegister from "../../icons/IconRegister.svelte";
    import IconUpload from "../../icons/IconUpload.svelte";
    onMount(() => {
        buttonsExists.set(true);
    });

    onDestroy(() => {
        buttonsExists.set(false);
    });
</script>

<nav class="nav">
    <button
        class="button button--nav"
        aria-label="Agregar archivo CSV"
        title="Agregar archivo CSV"
    >
        <IconUpload />
        <span>Agregar estudiantes</span>
    </button>
    <button
        class="button button--nav"
        aria-label="Editar registro"
        title="Editar registro"
    >
        <IconRegister />
        <span>Editar registro</span>
    </button>
</nav>
