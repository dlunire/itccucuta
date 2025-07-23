<script lang="ts">
    import Form from "../../components/Forms/Form.svelte";
    import Icon from "../../components/Graphics/Icon.svelte";
    import IconSettings from "../../icons/IconSettings.svelte";
    import IconTable from "../../icons/IconTable.svelte";

    let show: boolean = false;
</script>

<section class="content">
    <Form action="/dashboard/settings" method="post">
        {#snippet content()}
            <h3 class="form__title">
                <IconTable />
                <span>Configurar columnas</span>
            </h3>
            <fieldset class="form__fieldset fieldset fieldset--settings">
                <legend class="form__legend"
                    >Establezca nombre de columnas</legend
                >
                <label for="name" class="form__label" aria-label="Nombres">
                    <span>Nombres:</span>
                    <input
                        type="text"
                        name="name"
                        id="name"
                        placeholder="Por ejemplo, Cristian"
                        class="form__input"
                    />
                </label>

                <label
                    for="lastname"
                    class="form__label"
                    aria-label="Apellidos"
                >
                    <span>Apellidos:</span>
                    <input
                        type="text"
                        name="lastname"
                        id="lastname"
                        placeholder="Por ejemplo, Pérez Delgado"
                        class="form__input"
                    />
                </label>
            </fieldset>
        {/snippet}
    </Form>

    <Icon bind:hidden={show} title="Configuración">
        {#snippet content()}
            <IconSettings />
        {/snippet}
    </Icon>
</section>
