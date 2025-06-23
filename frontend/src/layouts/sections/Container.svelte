<script>
    import IconCodigosdelFuturo from "../icons/IconCodigosdelFuturo.svelte";
    import Footer from "./Footer.svelte";
</script>

<div class="container">
    <slot>Agregue un contenido o componente aquí</slot>
</div>

<Footer>
    <div class="footer__inner">
        <div class="footer__author">
            Desarrollado por <a
                href="https://github.com/dlunire"
                class="footer__link"
                target="_blank"
            >
                <IconCodigosdelFuturo />
                <span>Códigos del Futuro (@cdelfuturo)</span>
            </a>
        </div>
    </div>
</Footer>
