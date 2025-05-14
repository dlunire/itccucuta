<script lang="ts">
    import { onMount } from "svelte";

    export let name: string = "file";
    export let multiple: boolean = true;
    export let accept: string | undefined = undefined;

    let inputFile: HTMLInputElement | null = null;

    if (multiple) {
        name = `${name}[]`;
    }

    onMount(() => {
        addEventListener("paste", onpaste);
        return () => window.removeEventListener("paste", onpaste);
    });

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

        inputFile.files = files;
    }
</script>

<form action="" method="post" enctype="multipart/form-data">
    {#if accept}
        <input type="file" {accept} {name} {multiple} bind:this={inputFile} />
    {:else}
        <input type="file" {name} {multiple} bind:this={inputFile} />
    {/if}

    <textarea name="test" id="test" placeholder="Realizar prueba"></textarea>
</form>
