<script lang="ts">
    import { onMount } from "svelte";
    import ButtonSubmit from "../Buttons/ButtonSubmit.svelte";
    import { upload } from "./lib/upload";

    export let name: string = "file";
    export let multiple: boolean = true;
    export let accept: string | undefined = undefined;
    export let action: string = "/files/upload";

    let inputFile: HTMLInputElement | null = null;
    let form: HTMLFormElement | null = null;

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

        upload(form, function (loaded: number) {
            console.log({ loaded });
        });
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

        const { files, items } = dataTransfer;
        setFiles(inputFile, files, multiple);

        if (form instanceof HTMLElement) {
            form.requestSubmit();
        }
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
        <input type="file" {accept} {name} {multiple} bind:this={inputFile} />
    {:else}
        <input type="file" {name} {multiple} bind:this={inputFile} />
    {/if}

    <textarea name="test" id="test" placeholder="Realizar prueba"></textarea>

    <ButtonSubmit>
        {#snippet content()}
            <span>Enviar archivo</span>
        {/snippet}
    </ButtonSubmit>
</form>

<div
    class="dropzone"
    {ondragenter}
    {ondragleave}
    {ondragover}
    {ondrop}
    role="region"
></div>
