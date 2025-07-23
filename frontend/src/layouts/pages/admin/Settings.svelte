<script lang="ts">
    import Form from "../../components/Forms/Form.svelte";
    import Icon from "../../components/Graphics/Icon.svelte";
    import IconFolder from "../../icons/IconFolder.svelte";
    import IconSettings from "../../icons/IconSettings.svelte";
    import IconTable from "../../icons/IconTable.svelte";

    let hidden: boolean = true;
</script>

<section class="content content--settings">
    <div class="form-container">
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

                    <label
                        for="document"
                        class="form__label"
                        aria-label="Documento"
                    >
                        <span>Nº de documento:</span>
                        <input
                            type="text"
                            name="document"
                            id="document"
                            placeholder="Por ejemplo, 1.234.567.890"
                            class="form__input"
                        />
                    </label>

                    <label for="date" class="form__label" aria-label="Fecha">
                        <span>Fecha:</span>
                        <input
                            type="date"
                            name="date"
                            id="date"
                            placeholder="Por ejemplo, 21/01/1985"
                            class="form__input"
                        />
                    </label>

                    <label for="date" class="form__label" aria-label="Fecha">
                        <span>Fecha:</span>
                        <input
                            type="text"
                            name="date"
                            id="date"
                            placeholder="Por ejemplo, Curso"
                            class="form__input"
                        />
                    </label>
                </fieldset>

                <div class="form__buttons">
                    <button class="button button--primary">
                        <IconFolder />
                        <span>Establecer campos</span>
                    </button>
                </div>
            {/snippet}
        </Form>
    </div>

    <Icon bind:hidden title="Configuración">
        {#snippet content()}
            <IconSettings />
        {/snippet}
    </Icon>
</section>
