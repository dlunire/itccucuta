<script lang="ts">
    export let open: boolean = false;

    function onclick(event: MouseEvent): void {
        open = !open;
    }

    addEventListener("click", function (event: MouseEvent) {
        const { target: element } = event;
        if (!(element instanceof HTMLElement)) return;

        const { menu } = element.dataset;
        if (typeof menu !== "undefined") return;
        open = false;
    });
</script>

<button
    class="button button--menu"
    class:button--open={open}
    aria-label="Menu"
    data-menu
    {onclick}
>
    <span class:open></span>
    <span class:open></span>
    <span class:open></span>
    <span class:open>
        {open ? "Cerrar" : "Menú"}
    </span>
</button>

<style lang="scss">
    .button {
        --width: 20px;
        span {
            transition: 300ms ease;
            user-select: none;
            pointer-events: none;
            &:not(:last-of-type) {
                display: block;
                position: absolute;
                margin: auto;
                width: var(--width);
                height: 2px;
                background-color: rgba(white, 0.5);
                left: 10px;
                right: auto;
                top: 0;
                bottom: 0;
            }

            &:nth-of-type(2) {
                transform: translateY(-4px);
            }

            &:nth-of-type(3) {
                transform: translateY(4px);
            }

            &:last-of-type {
                padding-left: calc(var(--width) + 5px);
            }
        }

        &--menu {
            height: 30px;
            border-radius: 4px;
            padding: 0 10px;
            border: 1px solid rgba(white, 0.1);
            &:hover {
                background-color: rgba(white, 0.05);
            }
        }

        &--open {
            border-color: rgba(red, 0.3);

            &:hover {
                background-color: rgba(red, 0.1);
            }
        }
    }

    .open {
        &:first-of-type {
            opacity: 0;
        }

        &:nth-of-type(2) {
            transform: rotate(30deg) !important;
        }
        &:nth-of-type(3) {
            transform: rotate(-30deg) !important;
        }

        &:not(:last-of-type) {
            background-color: red !important;
        }

        &:last-of-type {
            color: red;
        }
    }
</style>
