<script setup lang="ts">
import HeaderPage from "../../components/containment/HeaderPage.vue";
import {computed, inject, ref} from "vue";
import { useDisplay } from 'vuetify'
import DialogDeleteAuthorConfirmation from "../../components/dialog/DialogDeleteAuthorConfirmation.vue";
import DialogDeleteBookConfirmation from "../../components/dialog/DialogDeleteBookConfirmation.vue";
import CurrencyText from "../../components/field/CurrencyText.vue";

const { lgAndUp, mdAndUp } = useDisplay()

const search = ref('');

const items = ref([]);
const totalItems = ref(0);
const lastPage = ref(0);
const currentPage = ref(0);
const dialog = ref(false);
const loading = ref(false);
const deleteId = ref(0);

const itemsPerPage = computed(() => {
    if (lgAndUp.value) {
        return 12;
    } else if (mdAndUp.value) {
        return 6;
    }
    return 4;
});
const loaderItems = computed(() => {
    if (lgAndUp.value) {
        return [0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11];
    } else if (mdAndUp.value) {
        return [0, 1, 2, 3, 4, 5];
    }
    return [0, 1, 2, 3];
});

let timeoutId;

const bookGateway = inject('bookGateway');

function loadingItems(options) {
    loading.value = true;
    deleteId.value = null;
    dialog.value = false;
    if (timeoutId) {
        clearTimeout(timeoutId);
    }

    timeoutId = setTimeout(() =>{
        bookGateway.index(options)
            .then((response) => {
                items.value = response.data;
                totalItems.value = response.meta.total;
                lastPage.value = response.meta.last_page;
                currentPage.value = response.meta.current_page;
            })
            .finally(() => loading.value = false);
    }, 300)
}

function urlImage() {
    const max = 8;
    return 'https://cdn.vuetifyjs.com/docs/images/graphics/games/' + Math.ceil(Math.random() * max) + '.png';
}

</script>

<template>
    <header-page
        title="Livros"
        icon="mdi-bookshelf"
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
                placeholder="Digite o Título, Editora ou Autor"
            ></v-text-field>
        </v-col>
        <v-spacer></v-spacer>
        <v-btn
            prepend-icon="mdi-plus"
            color="secondary"
            :to="{ name: 'books.create' }"
        >
            Novo Livro
        </v-btn>
    </v-row>

    <v-data-iterator
        :items="items"
        :items-length="totalItems"
        :items-per-page="itemsPerPage"
        :loading="loading"
        :search="search"
        @update:options="loadingItems"
        no-filter
    >
        <template v-slot:no-data>
            <v-divider />
            <v-sheet
                class="d-flex align-center justify-center"
                height="70"
                color="transparent"
            >
                Não há dados disponíveis
            </v-sheet>
            <v-divider />
        </template>

        <template v-slot:default="{ items }">
            <v-row dense>
                <v-col
                    v-for="item in items"
                    :key="item.raw.Codl"
                    cols="6"
                    md="4"
                    lg="2"
                >
                    <div class="position-relative">
                        <v-img :src="urlImage()"></v-img>

                        <v-chip
                            color="secondary"
                            class="position-absolute bottom-0 right-0 font-weight-bold"
                            label
                            variant="flat"
                        >
                            <currency-text :value="item.raw.Valor" />
                        </v-chip>
                    </div>

                    <v-card border flat>

                        <v-card-item>
                            <v-card-title>{{ item.raw.Titulo }}</v-card-title>

                            <v-card-subtitle class="d-flex justify-lg-space-between">
                                <div>
                                    <v-icon
                                        icon="mdi-domain"
                                        size="small"
                                    />
                                    <span class="ml-1">{{ item.raw.Editora }}</span>
                                </div>

                                <div>
                                    <v-icon
                                        icon="mdi-calendar"
                                        size="small"
                                    />
                                    <span class="ml-1">{{ item.raw.AnoPublicacao }}</span>
                                </div>
                            </v-card-subtitle>
                        </v-card-item>
                        <v-divider />
                        <v-card-text>
                            <div class="d-flex align-center">
                                <h4 class="mr-2">Autores:</h4>
                                <v-chip-group column>
                                    <v-chip
                                        v-for="item in item.raw.autores"
                                        :key="item.CodAu"
                                        color="secondary"
                                        variant="outlined"
                                        size="x-small"
                                    >
                                        {{ item.Nome }}
                                    </v-chip>
                                </v-chip-group>
                            </div>

                            <v-divider class="my-3"/>

                            <div class="d-flex align-center">
                                <h4 class="mr-2">Assuntos:</h4>
                                <v-chip-group column>
                                    <v-chip
                                        v-for="item in item.raw.assuntos"
                                        :key="item.codAs"
                                        color="secondary"
                                        variant="outlined"
                                        size="x-small"
                                    >
                                        {{ item.Descricao }}
                                    </v-chip>
                                </v-chip-group>
                            </div>


                        </v-card-text>

                        <v-card-actions>
                            <v-row>
                                <v-col cols="6">
                                    <v-btn
                                        block
                                        :prepend-icon="$vuetify.display.mobile ? false : 'mdi-delete'"
                                        color="error"
                                        @click="deleteId = item.raw.Codl"
                                        variant="outlined"
                                    >
                                        <v-icon
                                            v-if="$vuetify.display.mobile"
                                            icon="mdi-delete"
                                        />
                                        <span v-else>Excluir</span>
                                    </v-btn>
                                </v-col>
                                <v-col cols="6">
                                    <v-btn
                                        block
                                        :prepend-icon="$vuetify.display.mobile ? false : 'mdi-pencil'"
                                        color="yellow-darken-4"
                                        :to="{ name: 'books.edit', params: { id: item.raw.Codl } }"
                                        variant="outlined"
                                    >
                                        <v-icon
                                            v-if="$vuetify.display.mobile"
                                            icon="mdi-pencil"
                                        />
                                        <span v-else>Editar</span>
                                    </v-btn>
                                </v-col>
                            </v-row>
                        </v-card-actions>
                    </v-card>
                </v-col>
            </v-row>
        </template>

        <template v-slot:header>
            <div class="d-flex align-center justify-space-between pa-4">
                <div>
                    Total de Livros: {{ totalItems }}
                </div>
                <div class="d-flex align-center">
                    <v-btn
                        :disabled="currentPage === 1"
                        density="comfortable"
                        icon="mdi-arrow-left"
                        variant="tonal"
                        rounded
                        @click="loadingItems({ page: currentPage - 1 , search, itemsPerPage })"
                    ></v-btn>

                    <div class="mx-2 text-caption">
                        Página {{ currentPage }} de {{ lastPage }}
                    </div>

                    <v-btn
                        :disabled="currentPage >= lastPage"
                        density="comfortable"
                        icon="mdi-arrow-right"
                        variant="tonal"
                        rounded
                        @click="loadingItems({ page: currentPage + 1 , search, itemsPerPage })"
                    ></v-btn>
                </div>
            </div>
        </template>

        <template v-slot:loader>
            <v-row>
                <v-col
                    v-for="(_, k) in loaderItems"
                    :key="k"
                    cols="6"
                    md="4"
                    lg="2"
                >
                    <v-skeleton-loader
                        class="border"
                        type="image, article"
                    ></v-skeleton-loader>
                </v-col>
            </v-row>
        </template>
    </v-data-iterator>

    <dialog-delete-book-confirmation
        v-model="deleteId"
        @deleted="loadingItems({ page: 1, search, itemsPerPage })"
        @close="deleteId = null"
    />
</template>
