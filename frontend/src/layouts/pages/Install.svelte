<script lang="ts">
    import ButtonSubmit from "../components/Buttons/ButtonSubmit.svelte";
    import Form from "../components/Forms/Form.svelte";
    import Container from "../sections/Container.svelte";
    import Header from "../sections/Header.svelte";

    async function handleSubmit(event: SubmitEvent): Promise<void> {
        event.preventDefault();

        const { target: form } = event;
        if (!(form instanceof HTMLFormElement)) return;

        console.log({ form });
    }

    function onclick(): void {
        console.log({ test: "Se ha hecho click" });
    }
</script>

<Header>Programa de instalación</Header>

<Container>
    <section class="section section--install">
        <div class="section__inner">
            <h1 class="section__title">Ingrese las credenciales</h1>
            <hr />

            <Form
                action="/install/credentials"
                className="form--clase-01    form--clase-02"
            >
                {#snippet content()}
                    <ButtonSubmit />
                {/snippet}
            </Form>
        </div>
    </section>
</Container>
