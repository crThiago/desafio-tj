<script setup lang="ts">
import {computed, inject, onMounted, reactive, ref} from "vue";
import BtnIconTooltip from "../buttons/btnIconTooltip.vue";
import DialogTopicForm from "../dialog/DialogTopicForm.vue";

const props = defineProps({
    modelValue: Array,
    label: String,
    errorMessages: String
})

const emit = defineEmits(['update:modelValue']);

const topicGateway = inject("topicGateway");
const items = reactive([]);

const internalValue = computed({
    get: () => props.modelValue,
    set: (value) => {
        console.log(value)
        emit('update:modelValue', value)
    },
});

onMounted(() => {
    topicGateway.index({
        page: 1,
        itemsPerPage: -1
    }).then((response) => {
        items.push(...response.data)
    })
})

const dialog = ref(false)

function addTopic(topic) {
    dialog.value = false;
    items.push(topic.data);
}
</script>

<template>
    <v-autocomplete
        :label="props.label"
        :error-messages="props.errorMessages"
        :items="items"
        v-model="internalValue"
        item-title="Descricao"
        item-value="codAs"
        multiple
        clearable
    >
        <template v-slot:append-inner>
            <btn-icon-tooltip
                icon="mdi-plus"
                text="Novo Assunto"
                color="secondary"
                @click="dialog = true"
            />
        </template>
    </v-autocomplete>

    <dialog-topic-form
        v-model="dialog"
        :topic="{}"
        @close="dialog = false"
        @submitted="addTopic($event)"
    />
</template>
