<script setup lang="ts">
import {computed, inject, onMounted, reactive, ref} from "vue";
import BtnIconTooltip from "../buttons/btnIconTooltip.vue";
import DialogAuthorForm from "../dialog/DialogAuthorForm.vue";

const props = defineProps({
    modelValue: Array,
    label: String,
    errorMessages: String
})

const emit = defineEmits(['update:modelValue']);

const authorGateway = inject("authorGateway");
const items = reactive([]);

const internalValue = computed({
    get: () => props.modelValue,
    set: (value) => emit('update:modelValue', value),
});

onMounted(() => {
    authorGateway.index({
        page: 1,
        itemsPerPage: -1
    }).then((response) => {
        items.push(...response.data)
    })
})

const dialog = ref(false)

function addAuthor(author) {
    dialog.value = false;
    items.push(author.data);
}
</script>

<template>
    <v-autocomplete
        :label="props.label"
        :error-messages="props.errorMessages"
        :items="items"
        v-model="internalValue"
        item-title="Nome"
        item-value="CodAu"
        multiple
        clearable
    >
        <template v-slot:append-inner>
            <btn-icon-tooltip
                icon="mdi-plus"
                text="Novo Autor"
                color="secondary"
                @click="dialog = true"
            />
        </template>
    </v-autocomplete>

    <dialog-author-form
        v-model="dialog"
        :author="{}"
        @close="dialog = false"
        @submitted="addAuthor($event)"
    />
</template>
