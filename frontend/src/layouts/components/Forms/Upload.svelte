<script lang="ts">
    import { onMount } from "svelte";
    import { upload } from "./lib/upload";
    import ButtonPrimary from "../Buttons/ButtonPrimary.svelte";

    export let content: Function | undefined = undefined;
    export let buttonContent: Function | undefined = undefined;
    export let name: string = "file";
    export let multiple: boolean = false;
    export let accept: string | undefined = undefined;
    export let action: string = "/files/upload";

    let inputFile: HTMLInputElement | null = null;
    let form: HTMLFormElement | null = null;
    let progress: number = 0;
    let initialized: boolean = false;

    if (multiple) {
        name = `${name}[]`;
    }

    onMount(() => {
        addEventListener("paste", onpaste);
        return () => window.removeEventListener("paste", onpaste);
    });

    /**
     * Captura el evento de pegado de información
     *
     * @param event
     */
    function onpaste(event: ClipboardEvent): void {
        const { clipboardData } = event;
        if (!clipboardData) return;

        const files: FileList = clipboardData.files;
        const { length } = files;

        if (length > 0) {
            event.preventDefault();
        }

        if (!(inputFile instanceof HTMLInputElement)) {
            return;
        }

        setFiles(inputFile, files, multiple);
        if (length < 1) return;

        if (form instanceof HTMLFormElement) {
            form.requestSubmit();
        }
    }

    /**
     * Asigna uno o varios archivos a un elemento `<input type="file">`.
     *
     * Esta función intenta establecer los archivos proporcionados en el elemento `inputFile`.
     * Si el atributo `multiple` es `true`, se asigna la colección completa; de lo contrario, se asigna solo el primer archivo.
     *
     * **Nota:** Aunque la propiedad `input.files` es de solo lectura según la especificación, los navegadores permiten asignar
     * un objeto `FileList` generado artificialmente mediante `DataTransfer`, por lo que esta operación es posible en la práctica.
     *
     * @param inputFile - Elemento HTML de tipo `input` con `type="file"`.
     * @param files - Lista de archivos a establecer.
     * @param multiple - Indica si se deben permitir múltiples archivos (`true`) o solo uno (`false`).
     */
    function setFiles(
        inputFile: HTMLInputElement,
        files: FileList | File[],
        multiple: boolean = false,
    ): void {
        const dataTransfer = new DataTransfer();

        for (const file of files) {
            dataTransfer.items.add(file);
            if (!multiple) break;
        }

        inputFile.files = dataTransfer.files;
    }

    async function onsubmit(event: SubmitEvent): Promise<void> {
        event.preventDefault();
        const { target: form } = event;
        if (!(form instanceof HTMLFormElement)) return;
        initialized = false;
        progress = 0;

        upload(
            form,
            function (loaded: number) {
                if (!initialized) initialized = true;
                progress = loaded;
            },
            function (done: boolean) {
                if (!(form instanceof HTMLFormElement) || !done) return;
                form.reset();
            },
        );
    }

    function ondragenter(event: DragEvent): void {
        event.preventDefault();
    }

    function ondragover(event: DragEvent): void {
        event.preventDefault();
    }

    function ondragleave(event: DragEvent): void {
        event.preventDefault();
    }

    function ondrop(event: DragEvent): void {
        event.preventDefault();
        const { dataTransfer } = event;
        if (!dataTransfer) return;
        if (!(inputFile instanceof HTMLInputElement)) return;

        const { files } = dataTransfer;
        setFiles(inputFile, files, multiple);

        if (form instanceof HTMLElement) {
            form.requestSubmit();
        }
    }

    /**
     * Hace click sobre el elemento `inputFile`
     *
     * @param event Evento de Mouse.
     */
    function onclick(): void {
        if (!(inputFile instanceof HTMLInputElement)) return;
        inputFile.click();
    }

    /**
     * Solicita el envío del formulario si tiene archivos
     *
     * @param event Evento Change
     */
    function onchange(event: Event): void {
        const { target: input } = event;
        if (!(input instanceof HTMLInputElement)) return;
        if (!(form instanceof HTMLFormElement)) return;

        const { files } = input;
        if (!files) return;

        const { length } = files;
        if (length < 1) return;

        form.requestSubmit();
    }
</script>

<form
    {action}
    method="post"
    enctype="multipart/form-data"
    {onsubmit}
    bind:this={form}
>
    {#if accept}
        <input
            type="file"
            {accept}
            {name}
            {multiple}
            bind:this={inputFile}
            {onchange}
        />
    {:else}
        <input type="file" {name} {multiple} bind:this={inputFile} {onchange} />
    {/if}
</form>

<div
    class="dropzone"
    {ondragenter}
    {ondragleave}
    {ondragover}
    {ondrop}
    role="region"
    style="--progress: {progress}%"
    class:dropzone--copying={initialized}
>
    <div class="dropzone__inner">
        <span>
            {#if content}
                {@render content()}
            {:else}
                <span>Pegue (Ctrl + V) o arrastre archivos aquí</span>
            {/if}
        </span>

        <ButtonPrimary type="button" {onclick}>
            {#snippet content()}
                {#if buttonContent}
                    {@render buttonContent()}
                {:else}
                    <span>Subir archivos</span>
                {/if}
            {/snippet}
        </ButtonPrimary>
    </div>
</div>

<style>
    [type="file"] {
        display: none;
    }

    .dropzone {
        display: flex;
        align-items: center;
        justify-content: center;
    }

    :global(.button) {
        display: flex;
        margin-left: auto;
        margin-right: auto;
        margin-top: 10px;
        margin-bottom: 0;
    }
</style>
