<script lang="ts">
    export let hidden: boolean = false;
    let element: SVGSVGElement | null = null;

    function attribute(
        element: SVGSVGElement | null,
        hidden: boolean = true,
    ): void {
        if (!(element instanceof SVGSVGElement)) return;

        hidden
            ? element.setAttribute("aria-hidden", "true")
            : element.removeAttribute("aria-hidden");
    }

    $: attribute(element, hidden);
</script>

<svg
    viewBox="0 0 24 24"
    fill="none"
    xmlns="http://www.w3.org/2000/svg"
    aria-label="Arrow Left"
    bind:this={element}
>
    <g id="SVGRepo_bgCarrier" stroke-width="0"></g>
    <g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"
    ></g>
    <g id="SVGRepo_iconCarrier">
        <path
            fill-rule="evenodd"
            clip-rule="evenodd"
            d="M15.7071 5.29289C16.0976 5.68342 16.0976 6.31658 15.7071 6.70711L10.4142 12L15.7071 17.2929C16.0976 17.6834 16.0976 18.3166 15.7071 18.7071C15.3165 19.0976 14.6834 19.0976 14.2929 18.7071L8.46963 12.8839C7.98148 12.3957 7.98148 11.6043 8.46963 11.1161L14.2929 5.29289C14.6834 4.90237 15.3165 4.90237 15.7071 5.29289Z"
            fill="#0F1729"
        ></path>
    </g>
</svg>

<style>
    svg {
        min-width: var(--icon-width);
        min-height: var(--icon-height);
        max-width: var(--icon-width);
        max-height: var(--icon-height);
    }

    path {
        fill: var(--icon-color);
    }
</style>
