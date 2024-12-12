<script setup lang="ts">

import {inject, Ref, ref, watch} from "vue";
import {TopicForm} from "../../types/TopicType";

const topicGateway = inject("topicGateway");

const props = defineProps({
    topic: Object,
});

const emit = defineEmits({
    close: false,
    submitted: false
});

const form: Ref<TopicForm> = ref({
    codAs: null,
    Descricao: null,
    errors: [],
});

watch(
    props,
    (newValue) => {
        if (newValue) {
            form.value.codAs = newValue.topic.codAs;
            form.value.Descricao = newValue.topic.Descricao;
            form.value.errors = [];
        }
    }
);


function submit() {
    const data = form.value;
    let response;
    if (data.codAs) {
        response = topicGateway.update(data.codAs, data);
    } else {
        response = topicGateway.store(data);
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
                <v-card-title>Cadastro de Assunto</v-card-title>
                <v-card-text>
                    <v-text-field
                        label="Descrição *"
                        v-model="form.Descricao"
                        :error-messages="form.errors.Descricao"
                        counter="20"
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
