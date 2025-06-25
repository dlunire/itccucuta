<script lang="ts">
    import { onMount } from "svelte";
    import { zIndexReverse } from "../../lib/zIndex";
    import ButtonList from "../components/Buttons/ButtonList.svelte";
    import ButtonSubmit from "../components/Buttons/ButtonSubmit.svelte";
    import Form from "../components/Forms/Form.svelte";
    import Container from "../sections/Container.svelte";
    import Header from "../sections/Header.svelte";

    onMount(() => {
        if (container instanceof HTMLElement) zIndexReverse(container);
    });

    let container: HTMLElement | null = null;
</script>

<Header>Programa de instalación</Header>

<Container>
    <section class="section section--install" bind:this={container}>
        <div class="section__inner">
            <h1 class="section__title">Ingrese las credenciales</h1>
            <hr />

            <Form
                action="/install/credentials"
                className="form--clase-01 form--clase-02"
                method="post"
            >
                {#snippet content()}
                    <div class="form__inner">
                        <div class="form__item">
                            <ButtonList
                                required={true}
                                label="Selecione su entorno de ejecución"
                            />
                        </div>

                        <div class="form__item">
                            <ButtonList name="algo" required={true} />
                        </div>
                    </div>

                    <hr />
                    <ButtonSubmit>
                        {#snippet content()}
                            Establecer credenciales
                        {/snippet}
                    </ButtonSubmit>
                {/snippet}
            </Form>
        </div>
    </section>
</Container>

<!-- # Indica si la aplicación debe correr o no en producción:
DL_PRODUCTION: boolean = false

# Tiempo de vida de la sesión (tiempo en segundos):
DL_LIFETIME: integer = 10800

# Servidor de la base de datos:
DL_DATABASE_HOST: string = "localhost"

# Puerto del motor de la base de datos:
DL_DATABASE_PORT: integer = 3306

# Usuario de la base de datos:
DL_DATABASE_USER: string = "david"

# Contraseña de la base de datos:
DL_DATABASE_PASSWORD: string = "entorno2"

# Nombre de la base de datos:
DL_DATABASE_NAME: string = "itccucuta"

# Codificación de caracteres de la base de datos. Si no se define, 
# entonces, el valor por defecto serà `utf8`:
DL_DATABASE_CHARSET: string = "utf8"

# Colación del motor de base de datos. Si no se define, el valor por
# defecto será `utf8_general_ci`:
DL_DATABASE_COLLATION: string = "utf8_general_ci"

# Motor de base de datos. Si no se define esta variable, el valor
# por defecto será `mysql`:
DL_DATABASE_DRIVE: string = "mysql"

# Si la base de datos usa prefijo, entonces debe declararla aquí:
DL_PREFIX: string = "dl_" -->
