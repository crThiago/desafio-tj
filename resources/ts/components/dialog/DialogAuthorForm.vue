<script setup lang="ts">

import {inject, Ref, ref, watch} from "vue";
import {TopicForm} from "../../types/TopicType";
import {AuthorForm} from "../../types/AuthorType";

const authorGateway = inject("authorGateway");

const props = defineProps({
    author: Object,
});

const emit = defineEmits({
    close: false,
    submitted: false
});

const form: Ref<AuthorForm> = ref({
    CodAu: null,
    Nome: null,
    errors: [],
});

watch(
    props,
    (newValue) => {
        if (newValue) {
            form.value.CodAu = newValue.author.CodAu;
            form.value.Nome = newValue.author.Nome;
            form.value.errors = [];
        }
    }
);


function submit() {
    const data = form.value;
    let response;
    if (data.CodAu) {
        response = authorGateway.update(data.CodAu, data);
    } else {
        response = authorGateway.store(data);
    }

    response
        .then((data) => {
            emit('submitted', data);
        })
        .catch((error) => {
            if (error.response.status === 422) {
                form.value.errors = error.response.data.errors;
            }
        });
}
</script>

<template>
    <v-dialog  max-width="600" @afterLeave="emit('close')">
        <v-form @submit.prevent="submit">
            <v-card>
                <v-card-title>Cadastro de Autor</v-card-title>
                <v-card-text>
                    <v-text-field
                        label="Nome *"
                        v-model="form.Nome"
                        :error-messages="form.errors.Nome"
                        counter="40"
                    />
                </v-card-text>
                <v-card-actions>
                    <v-btn @click="emit('close')" variant="outlined">Cancelar</v-btn>
                    <v-btn type="submit" color="secondary" variant="flat">Salvar</v-btn>
                </v-card-actions>
            </v-card>
        </v-form>
    </v-dialog>
</template>
