<script setup lang="ts">
import {inject, reactive, ref, watch} from "vue";
import {TopicForm} from "../types/TopicType";
import DialogTopicForm from "../components/dialog/DialogTopicForm.vue";
import BtnEditList from "../components/buttons/btnEditList.vue";
import BtnDeleteList from "../components/buttons/btnDeleteList.vue";
import DialogDeleteTopicConfirmation from "../components/dialog/DialogDeleteTopicConfirmation.vue";
import HeaderPage from "../components/containment/HeaderPage.vue";

const search = ref('');

const items = ref([]);
const totalItems = ref(0);
const loading = ref(false);
let timeoutId;

const headers = [
    { title: 'Descrição', sortable: true, key: 'Descricao' },
    { title: 'Quantidade Livros', sortable: false, key: 'livros_count', align: 'center'},
    { title: 'Ações', key: 'actions', sortable: false },
]

let itemsPerPage = 15;
const deleteId = ref(0);

const topicGateway = inject('topicGateway');
function loadingItems(options) {
    loading.value = true;
    deleteId.value = null;
    dialog.value = false;
    if (timeoutId) {
        clearTimeout(timeoutId);
    }

    timeoutId = setTimeout(() =>{
        topicGateway.index(options)
            .then((response) => {
                itemsPerPage = options.itemsPerPage;
                items.value = response.data;
                totalItems.value = response.meta.total;
            })
            .finally(() => loading.value = false);
    }, 300)
}


let form: TopicForm = reactive({
    codAs: null,
    Descricao: '',
    errors: []
})

const dialog = ref(false);

function edit(itemEdit) {
    form = itemEdit;
    dialog.value = true;
}

watch(dialog, () => {
    if (!dialog.value) {
        form = {
            codAs: null,
            Descricao: null,
            errors: []
        };
    }
});
</script>

<template>
    <header-page
        title="Assuntos"
        icon="mdi-bookmark-box-multiple"
    />

    <v-row no-gutters>
        <v-col cols="12" sm="3">
            <v-text-field
                v-model="search"
                density="compact"
                color="secondary"
                label="Pesquisar"
                variant="underlined"
                append-inner-icon="mdi-magnify"
                placeholder="Digite a descrição do assunto"
            ></v-text-field>
        </v-col>
        <v-spacer></v-spacer>
        <v-btn
            prepend-icon="mdi-plus"
            color="secondary"
            @click="dialog = true"
        >
            Novo Assunto
        </v-btn>
    </v-row>

    <v-data-table-server
        :headers="headers"
        :items="items"
        :items-length="totalItems"
        :items-per-page-options="[15, 25, 50, 100]"
        :items-per-page="itemsPerPage"
        :loading="loading"
        :search="search"
        @update:options="loadingItems"
        class="bg-transparent"
        density="compact"
    >
        <template v-slot:item.actions="{ item }">
            <btn-edit-list @click="edit(item)" />
            <btn-delete-list @click="deleteId = item.codAs" />
        </template>
    </v-data-table-server>

    <dialog-topic-form
        v-model="dialog"
        :topic="form"
        @close="dialog = false"
        @submitted="loadingItems({ page: 1, search: search.value, itemsPerPage })"
    />

    <dialog-delete-topic-confirmation
        v-model="deleteId"
        @deleted="loadingItems({ page: 1, search: search.value, itemsPerPage })"
        @close="deleteId = null"
    />
</template>
