<script setup lang="ts">
import HeaderPage from "../components/containment/HeaderPage.vue";
import {inject, ref} from "vue";
import CurrencyText from "../components/field/CurrencyText.vue";

const headers = [
    { title: 'Livros', sortable: false, key: 'LivroTitulo' },
    { title: 'Editoras', sortable: false, key: 'LivroEditora' },
    { title: 'Ano', sortable: false, key: 'LivroAnoPublicacao' },
    { title: 'Valor', sortable: false, key: 'LivroValor' },
    { title: 'Assuntos', sortable: false, key: 'Assuntos' },
]


const items = ref([]);
const totalItems = ref(0);
const loading = ref(false);
let timeoutId;

let itemsPerPage = 15;
const relatorioGateway = inject('relatorioGateway');

function loadingItems(options) {
    loading.value = true;
    if (timeoutId) {
        clearTimeout(timeoutId);
    }

    timeoutId = setTimeout(() =>{
        relatorioGateway.index(options)
            .then((response) => {
                itemsPerPage = options.itemsPerPage;
                items.value = response.data;
                totalItems.value = response.total;
            })
            .finally(() => loading.value = false);
    }, 300)
}
</script>

<template>
    <header-page
        title="Relatório"
        icon="mdi-table"
    />

    <v-data-table-server
        :headers="headers"
        :group-by="[{ key: 'AutorNome',}]"
        :items="items"
        :items-length="totalItems"
        :items-per-page-options="[15, 25, 50, 100]"
        :items-per-page="itemsPerPage"
        :loading="loading"
        @update:options="loadingItems"
        class="bg-transparent"
        density="compact"
    >
        <template v-slot:header.data-table-group="{ column }">
            <strong class="text-secondary"><v-icon icon="mdi-account-star"/> Autores</strong>
        </template>
        <template v-slot:group-header="{ item, columns, toggleGroup, isGroupOpen }">
            <tr>
                <td :colspan="columns.length" class="text-secondary">
                    <VBtn
                        :icon="isGroupOpen(item) ? '$expand' : '$next'"
                        size="small"
                        variant="text"
                        @click="toggleGroup(item)"
                    ></VBtn>
                    {{ item.value }} ({{ item.items.length }})
                </td>
            </tr>
        </template>
        <template v-slot:item.LivroValor="{ item }">
            <currency-text :value="item.LivroValor" />
        </template>
    </v-data-table-server>
</template>
