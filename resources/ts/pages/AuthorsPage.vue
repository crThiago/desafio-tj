<script setup lang="ts">

import HeaderPage from "../components/containment/HeaderPage.vue";
import {inject, reactive, ref, watch} from "vue";
import {AuthorForm} from "../types/AuthorType";
import DialogAuthorForm from "../components/dialog/DialogAuthorForm.vue";
import BtnEditList from "../components/buttons/btnEditList.vue";
import BtnDeleteList from "../components/buttons/btnDeleteList.vue";
import DialogDeleteAuthorConfirmation from "../components/dialog/DialogDeleteAuthorConfirmation.vue";

const search = ref('');

const items = ref([]);
const totalItems = ref(0);
const loading = ref(false);
let timeoutId;

const headers = [
    { title: 'Nome', sortable: false, key: 'Nome' },
    { title: 'Quantidade Livros', sortable: false, key: 'livros_count', align: 'center'},
    { title: 'Ações', key: 'actions', sortable: false },
]

let itemsPerPage = 15;
const deleteId = ref(0);

const authorGateway = inject('authorGateway');

function loadingItems(options) {
    loading.value = true;
    deleteId.value = null;
    dialog.value = false;
    if (timeoutId) {
        clearTimeout(timeoutId);
    }

    timeoutId = setTimeout(() =>{
        authorGateway.index(options)
            .then((response) => {
                itemsPerPage = options.itemsPerPage;
                items.value = response.data;
                totalItems.value = response.meta.total;
            })
            .finally(() => loading.value = false);
    }, 300)
}

let form: AuthorForm = reactive({
    CodAu: null,
    Nome: '',
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
            CodAu: null,
            Nome: null,
            errors: []
        };
    }
});

</script>

<template>
    <header-page
        title="Autor"
        icon="mdi-account-star"
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
                placeholder="Digite o nome do autor"
            ></v-text-field>
        </v-col>
        <v-spacer></v-spacer>
        <v-btn
            prepend-icon="mdi-plus"
            color="secondary"
            @click="dialog = true"
        >
            Novo Autor
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
            <btn-delete-list @click="deleteId = item.CodAu" />
        </template>
    </v-data-table-server>

    <dialog-author-form
        v-model="dialog"
        :author="form"
        @close="dialog = false"
        @submitted="loadingItems({ page: 1, search: search.value, itemsPerPage })"
    />

    <dialog-delete-author-confirmation
        v-model="deleteId"
        @deleted="loadingItems({ page: 1, search: search.value, itemsPerPage })"
        @close="deleteId = null"
    />
</template>
