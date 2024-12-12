<script setup lang="ts">
import {inject, onMounted, ref, Ref} from "vue";
import HeaderPage from "../../components/containment/HeaderPage.vue";
import { BookForm } from "../../types/BookType";
import {useRoute, useRouter} from "vue-router";
import CurrencyField from "../../components/field/CurrencyField.vue";
import AutocompleteAuthors from "../../components/field/AutocompleteAuthors.vue";
import AutocompleteTopics from "../../components/field/AutocompleteTopics.vue";

const router = useRouter()
const route = useRoute()

const bookGateway = inject('bookGateway');

const form: Ref<BookForm> = ref({
    Codl: null,
    Titulo: null,
    Editora: null,
    AnoPublicacao: null,
    Valor: null,
    Autores: [],
    Assuntos: [],
    errors: [],
});

onMounted(() => {
    if (route.params.id) {
        bookGateway.show(route.params.id).then((response) => {
            form.value = response.data;
            form.value.Assuntos = response.data.Assuntos.map((item: any) => item.codAs);
            form.value.Autores = response.data.Autores.map((item: any) => item.CodAu);
            form.value.errors = [];
        });
    }
});

function submit() {
    const data = form.value;
    let response;
    if (data.Codl) {
        response = bookGateway.update(data.Codl, data);
    } else {
        response = bookGateway.store(data);
    }

    response
        .then((data) => {
            router.push({name: 'books'});
        })
        .catch((error) => {
            if (error.response.status === 422) {
                form.value.errors = error.response.data.errors;
            }
        });
}

</script>

<template>
    <header-page
        title="Cadastro de Livro"
        icon="mdi-bookshelf"
    />

    <v-form @submit.prevent="submit">
        <v-card elevation="0" color="transparent">
            <v-card-text>
                <v-row>
                    <v-col cols="12" md="6" lg="3">
                        <v-text-field
                            label="Título *"
                            v-model="form.Titulo"
                            :error-messages="form.errors.Titulo"
                            counter="40"
                        />
                    </v-col>
                    <v-col cols="12" md="6" lg="3">
                        <v-text-field
                            label="Editora *"
                            v-model="form.Editora"
                            :error-messages="form.errors.Editora"
                            counter="40"
                        />
                    </v-col>
                    <v-col cols="12" sm="6" lg="3">
                        <v-text-field
                            label="Ano de Publicação *"
                            v-model="form.AnoPublicacao"
                            :error-messages="form.errors.AnoPublicacao"
                            type="number"
                            min="0"
                        />
                    </v-col>
                    <v-col cols="12" sm="6" lg="3">
                        <currency-field
                            label="Valor *"
                            v-model="form.Valor"
                            :error-messages="form.errors.Valor"
                            prefix="R$"
                        />
                    </v-col>
                </v-row>
                <v-row>
                    <v-col cols="12" sm="6">
                        <AutocompleteAuthors
                            label="Autores"
                            v-model="form.Autores"
                            :error-messages="form.errors.Autores"
                        />
                    </v-col>
                    <v-col cols="12" sm="6">
                        <AutocompleteTopics
                            label="Assuntos"
                            v-model="form.Assuntos"
                            :error-messages="form.errors.Assuntos"
                        />
                    </v-col>
                </v-row>
            </v-card-text>
            <v-card-actions>
                <v-spacer></v-spacer>
                <v-btn variant="outlined" :to="{ name: 'books'}">Cancelar</v-btn>
                <v-btn type="submit" color="secondary" variant="flat">Salvar</v-btn>
            </v-card-actions>
        </v-card>
    </v-form>
</template>
