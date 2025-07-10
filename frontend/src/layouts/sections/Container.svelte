<script lang="ts">
    import IconCodigosdelFuturo from "../icons/IconCodigosdelFuturo.svelte";
    import Footer from "./Footer.svelte";
    export let dashboard: boolean = false;
    export let author: string = "David E Luna M (@cdelfuturo)";
</script>

<div class="container">
    <slot>Agregue un contenido o componente aquí</slot>
</div>

<Footer>
    {#if dashboard}
        <div class="footer__inner footer__inner--dashboard">
            <div class="footer__author footer__author--dashboard">
                Desarrollado por <a
                    href="https://github.com/dlunire"
                    class="footer__link footer__link--dashboard"
                    target="_blank"
                >
                    <IconCodigosdelFuturo />
                    <span>{author}</span>
                </a>
            </div>
        </div>
    {:else}
        <div class="footer__inner">
            <div class="footer__author">
                Desarrollado por <a
                    href="https://github.com/dlunire"
                    class="footer__link"
                    target="_blank"
                >
                    <IconCodigosdelFuturo />
                    <span>{author}</span>
                </a>
            </div>
        </div>
    {/if}
</Footer>
