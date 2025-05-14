<script lang="ts">
    export let name: string = "file";
    export let multiple: boolean = false;

    if (multiple) {
        name = `${name}[]`;
    }

    function onpaste(event: ClipboardEvent): void {}
</script>

<form action="" method="post" enctype="multipart/form-data">
    <input type="file" {name} {multiple} />
</form>
