<script lang="ts">
    import IconStudents from "../../icons/IconStudents.svelte";

    let show: boolean = true;
</script>

<section class="content">
    {#if !show}
        <h2 class="content__title">
            <span>Contenido del dashboard</span>
        </h2>
    {/if}

    {#if show}
        <div class="icon-graphic">
            <div class="icon-graphic__inner">
                <div class="icon-graphic__icon">
                    <IconStudents />
                </div>
                <h2 class="icon-graphic__title">
                    <IconStudents />
                    <span>ESTUDIANTES</span>
                </h2>
            </div>
        </div>
    {/if}
</section>
